@extends('admin.layouts.master')
@include('admin.layouts.datatable.datatable')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">

                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-head">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-group">
                                        <a href="{{ route('products.create') }}" class="btn btn-success">@lang('admin.addNewProduct') <i class="fa fa-plus"></i></a>

                                        <a href="#" class="bulk_delete_confirmation btn btn-danger" id="sample_editable_1_new" data-toggle="modal" data-target="#bulkDeleteModal" data-action="{{ route('products.bulk-delete') }}">
                                           @lang('admin.multiDelete')
                                            <i class="icon-trash"></i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body table-responsive datatable-table">
                                    {!!
                                        $dataTable->table([
                                            'class' => 'dataTable table table-striped table-bordered table-hover w-100 dataTables_wrapper ',
                                        ], true)
                                    !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{--    bulck delete--}}
    <div id="bulkDeleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:50px;">
        <div class="modal-dialog" style="margin-top:50px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">تحذير</h4> </div>
                <div class="modal-body">
                    <p class="sure_statement">هل انت متاكد انك تريد الحذف ؟</p>
                    <p class="message_statement" style="display: none;">يجب عليك اختيار عنصر واحد على الاقل</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('products.bulk-delete') }}"  class="ajaxForm" method="post" id="bulk_delete_modal">
                        @csrf
                        <button type="submit" class="btn btn-success waves-effect">تأكيد</button>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">الغاء</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
