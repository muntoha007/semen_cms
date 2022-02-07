<?php

namespace App\DataTables;

use App\Models\DeliveryOrder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
// use DB;

class DeliveryOrderDatatable extends DataTable
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
                $edit_url = route('delivery-order.edit', $data->id);
                $delete_url = route('delivery-order.destroy', $data->id);
                $assign = route('assign', $data->id);
                $dataid = $data->id;
                if ($data->status == "CREATED") {
                    return view('partials.action-button')->with(
                        compact('edit_url','delete_url', 'assign', 'dataid')
                    );
                } else {
                    return view('partials.action-button')->with(
                        compact('edit_url')
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
    public function query(DeliveryOrder $model)
    {
        // DB::statement(DB::raw('set @rownum=0'));
        return $model->newQuery()
            // ->where('slug','!=','super-admin')
            ->select([
                'delivery_orders.id',
                'delivery_orders.booking_code',
                'delivery_orders.number_reference',
                'delivery_orders.distributor',
                'delivery_orders.store',
                'delivery_orders.status',
                'delivery_orders.booking_date',
                'delivery_orders.expired_date',
                'delivery_orders.created_at',
                'delivery_orders.updated_at',
                DB::raw('row_number() over () AS rownum'),
            ]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('DeliveryOrder-table')
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
            Column::make('booking_code')->title("Kode"),
            Column::make('number_reference')->title('Nomor Ref.'),
            Column::make('distributor'),
            Column::make('store')->title("Toko"),
            Column::make('status'),
            // Column::computed('is_active')->title('Status'),
            Column::make('booking_date')->title('Tgl Booking'),
            Column::make('expired_date')->title('Tgl Kadaluarsa'),
            Column::computed('action')
                ->visible($hasAction)
                ->exportable(false)
                ->printable(true)
                ->width(150)
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
        return 'DeliveryOrder_' . date('YmdHis');
    }
}
