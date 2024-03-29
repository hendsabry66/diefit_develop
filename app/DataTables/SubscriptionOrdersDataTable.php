<?php

namespace App\DataTables;

use App\Models\SubscriptionOrder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubscriptionOrdersDataTable extends DataTable
{
    /**
     * Custom page to print
     *
     * @var string
     */
    protected $printPreview = 'admin.layouts.datatable.print';
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->escapeColumns([])
            ->addColumn('check', 'admin.orders.subscription.datatables.check')
            ->editColumn('status.name', function ($q) {
                return $q->status->getTranslations('name')['ar'];
            })
            ->editColumn('subscription_price', function ($q) {
                return $q->subscriptionPrice->price + $q->delivery_cost + $q->subscriptionPrice->subscription->specialist_price;
            })

            ->rawColumns(['action','status'])
            ->addColumn('actions', 'admin.orders.subscription.datatables.actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SubscriptionOrder $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SubscriptionOrder $model)
    {
        $query = $model->newQuery();


        $query->when(request('status'), function ($q, $status) {
            return $q->where('status_id', 6)->where('payment','bank_transfer');
        });
        $query->with('user')->with('status')->With('subscriptionPrice')->select('subscription_orders.*');
        return $query->orderBy('id', 'desc');



       // return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom'          => 'Blfrtip',
                'lengthMenu'   => [[10, 25, 50, -1], [10, 25, 50, 'All records']],
                'buttons' => ['csv', 'excel', 'print', 'reset', 'reload'],
                'order' => [
                    1, 'asc'
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['name' => 'check', 'data' => 'check', 'title' => '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" id="check_all"/><span></span></label> ', 'exportable' => false, 'printable' => false, 'orderable' => false, 'searchable' => false],
            ['name' => 'id', 'data' => 'id', 'title' => 'الرقم التسلسلى'],
            ['name' => 'user.name', 'data' => 'user.name', 'title' => 'اسم المستخدم'],
            ['name' => 'status.name', 'data' => 'status.name', 'title' => 'حالة الطلب '],
//            ['name' => 'address.name', 'data' => 'address.name', 'title' => 'العنوان '],
            ['name' => 'subscription_price', 'data' => 'subscription_price', 'title' => 'السعر الاجمالي '],
            ['name' => 'actions', 'data' => 'actions', 'title' => 'التحكم', 'exportable' => false, 'printable' => false, 'orderable' => false, 'searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SubscriptionOrders_' . date('YmdHis');
    }
}
