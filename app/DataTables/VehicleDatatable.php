<?php

namespace App\DataTables;

use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
// use DB;

class VehicleDatatable extends DataTable
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
                if ($data->updated_at != null) {
                    return $data->updated_at->format('Y-m-d'); // human readable format
                }
            })
            ->addColumn('action', function ($data) {
                $edit_url = route('vehicle.edit', $data->id);
                $delete_url = route('vehicle.destroy', $data->id);
                $vehicle_driver = route('driver-vehicle.store');
                $vid = $data->id;
                $delete_assign = route('driver-vehicle.destroy', $data->id);

                if ($data->vehicle_id == null) {
                    return view('partials.action-button')->with(
                        compact('edit_url', 'delete_url', 'vehicle_driver', 'vid')
                    );
                } else {
                    return view('partials.action-button')->with(
                        compact('edit_url', 'delete_assign')
                    );
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Vehicle $model)
    {
        // DB::statement(DB::raw('set @rownum=0'));
        return $model->newQuery()
            // ->where('slug','!=','super-admin')
            ->select([
                'vehicles.id',
                'vehicles.brand',
                'vehicles.production_year',
                'vehicles.plate_number',
                'vehicles.date_kir',
                'vehicles.date_plate',
                'vehicles.capacity',
                'vehicles.type',
                'vehicles.status',
                'vehicles.is_active',
                'vehicles.created_at',
                'vehicles.updated_at',
                'driver_vehicles.vehicle_id',
                DB::raw('row_number() over () AS rownum'),
            ])->leftJoin('driver_vehicles', 'vehicles.id', '=', 'driver_vehicles.vehicle_id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('Vehicle-table')
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
            Column::make('brand')->title("Merk"),
            Column::make('type')->title("Tipe"),
            Column::make('plate_number')->title("Nomor Plate"),
            Column::make('production_year')->title("Tahun Produksi"),
            Column::make('date_plate')->title("Tanggal Plate"),
            Column::make('date_kir')->title("Tanggal Kir"),
            Column::computed('is_active')->title('Aktif'),
            Column::computed('status')->title('Status'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
            Column::computed('action')
                ->visible($hasAction)
                ->exportable(false)
                ->printable(true)
                ->width(160)
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
        return 'Vehicle_' . date('YmdHis');
    }
}
