<div class="row">

    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.name')</label>
        <input type="text"  class="form-control" @if(isset($role)) value="{{$role->name}}" @endif placeholder="{{__('admin.name')}}" name="name">
    </div>
    <div class="form-group col-md-12 mb-2">
        <label for="projectinput3">@lang('admin.permissions')</label>
        <br>
        @foreach ($permission as $value)
            {!! Form::label('permission', __('permission.'.$value->name) )!!}
            @if(isset($role))
                {!! Form::checkbox('permission[]', $value->id,in_array($value->id, $rolePermissions) ? true : false) !!}


            @else
                {!! Form::checkbox('permission[]', $value->id, null) !!}
            @endif
            <br>
        @endforeach


    </div>
</div>
