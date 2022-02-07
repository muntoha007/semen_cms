<?php

namespace App\DataTables;

use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
// use DB;

class WarehouseDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('is_active', function ($data) {
                if ($data->is_active == 1) {
                    return 'Active';
                } else {
                    return 'Inactive';
                }
            })->editColumn('created_at', function ($data) {
                return $data->created_at->format('Y-m-d'); // human readable format
            })
            ->editColumn('updated_at', function ($data) {
                if ($data->updated_at != null){
                    return $data->updated_at->format('Y-m-d'); // human readable format
                }
            })
            ->addColumn('action', function ($data) {
                $edit_url = route('warehouse.edit', $data->id);
                $delete_url = route('warehouse.destroy', $data->id);

                return view('partials.action-button')->with(
                    compact('edit_url','delete_url')
                );
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Warehouse $model)
    {
        // var_dump($this->id);
        return $model->newQuery()
            // ->where('slug','!=','super-admin')
            ->select([
                'warehouses.id',
                'warehouses.name',
                'warehouses.address',
                'warehouses.phone',
                'warehouses.longitude',
                'warehouses.latitude',
                'warehouses.province_id',
                'warehouses.regency_id',
                'warehouses.is_active',
                'warehouses.created_at',
                'warehouses.updated_at',
                'region_provinces.name as province',
                'region_regencies.name as regency',
                DB::raw('row_number() over () AS rownum'),
            ])->join('region_provinces', 'region_provinces.id', '=', 'warehouses.province_id')
            ->join('region_regencies', 'region_regencies.id', '=', 'warehouses.regency_id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('Warehouse-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('<"row"<"col-sm-6"l><"col-sm-6"f>> <"row"<"col-sm-12"tr>> <"row"<"col-sm-5"i><"col-sm-7"p>>')
            ->orderBy(1)
            ->responsive(true)
            ->processing(true)
            ->serverSide(true)
            ->autoWidth(false)
            ->stateSave(true)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $hasAction = isHasAnyActionColumn();
        return [
            Column::make('rownum')
                ->title('#')
                ->searchable(false),
            Column::make('name')->title("Nama"),
            Column::make('phone')->title("Nomor HP"),
            Column::make('province')->title("Provinsi"),
            Column::make('regency')->title("Kecamatan"),
            Column::make('address')->title("Alamat"),
            Column::computed('is_active')->title('Status'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
            Column::computed('action')
                ->visible($hasAction)
                ->exportable(false)
                ->printable(true)
                ->width(100)
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Warehouse_' . date('YmdHis');
    }
}
