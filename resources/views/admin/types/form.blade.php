<div class="row">

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.price')</label>
        <input type="text"  class="form-control" @if(isset($type)) value="{{$type->price}}" @endif placeholder="{{__('admin.price')}}" name="price">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.value')</label>
        <input type="text"  class="form-control" @if(isset($type)) value="{{$type->value}}" @endif placeholder="{{__('admin.value')}}" name="value">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.food_type')</label>
        <select class="select2 form-control" name="food_type">

            <option value="calory" @if(isset($type) && $type->food_type =="calory") selected @endif >@lang('admin.calory')</option>
            <option value="gram" @if(isset($type) && $type->food_type =="gram") selected @endif>@lang('admin.gram')</option>

        </select>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.status')</label>
        <select class="select2 form-control" name="status">

            <option value="active" @if(isset($type) && $type->status =="active") selected @endif >@lang('admin.active')</option>
            <option value="in_active" @if(isset($type) && $type->status =="in_active") selected @endif>@lang('admin.in_active')</option>

        </select>
    </div>
</div>
