<div class="row">

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_ar')</label>
        <input type="text"  class="form-control" @if(isset($area)) value="{{$area->getTranslations('name')['ar']}}" @endif placeholder="{{__('admin.name')}}" name="name_ar">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_en')</label>
        <input type="text"  class="form-control" @if(isset($area)) value="{{$area->getTranslations('name')['en']}}" @endif placeholder="{{__('admin.name')}}" name="name_en">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.status')</label>
        <select class="select2 form-control" name="status">

            <option value="active" @if(isset($area) && $area->status =="active") selected @endif >@lang('admin.active')</option>
            <option value="in_active" @if(isset($area) && $area->status =="in_active") selected @endif>@lang('admin.in_active')</option>

        </select>
    </div>
</div>
