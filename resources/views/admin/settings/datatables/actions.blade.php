<div class="btn-group">
    <button class="btn btn-xs btn-actions dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">@lang('admin.control') </button>
    <ul class="dropdown-menu custom-dropdown-menu" role="menu">
        <li><a href="{{ route('cities.show', $id) }}"><i class="fa fa-eye fa-fw"></i></a>@lang('admin.show')</li>
        <li><a href="{{ route('cities.edit', $id) }}"><i class="fa fa-edit fa-fw"></i></a>@lang('admin.edit')</li>
        <li><a href="#" class="delete_confirmation" data-toggle="modal" data-target="#deleteModal" data-action="{{ route('cities.destroy', $id) }}"><i class="fa fa-trash fa-fw"></i>@lang('admin.delete')</a></li>
    </ul>
</div>
