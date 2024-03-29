<div class="btn-group">
    <button class="btn btn-xs btn-actions dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">@lang('admin.control') </button>
    <ul class="dropdown-menu custom-dropdown-menu" role="menu">
        <li><a href="{{ route('subscriptionFoods.show', $id) }}"><i class="fa fa-eye fa-fw"></i>@lang('admin.show')</a></li>
        <li><a href="{{ route('subscriptionFoods.edit', $id) }}"><i class="fa fa-edit fa-fw"></i>@lang('admin.edit')</a></li>
        <li><a href="#" class="delete_confirmation" data-toggle="modal" data-target="#deleteModal_{{$id}}" data-action="{{ route('subscriptions.destroy', $id) }}"><i class="fa fa-trash fa-fw"></i>@lang('admin.delete')</a></li>
    </ul>
</div>

{{--model--}}
<div id="deleteModal_{{$id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top:50px;">
    <div class="modal-dialog" style="margin-top:50px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">تحذير</h4> </div>
            <div class="modal-body">
                <p>هل انت متاكد انك تريد الحذف ؟</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('subscriptionFoods.destroy', $id) }}" class="ajaxForm" method="post" id="delete_modal">
                    @method('delete')
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
