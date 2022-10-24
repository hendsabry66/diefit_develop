<div class="row">
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.area')</label>
        <select class="select2 form-control" name="area_id">
            @foreach($areas as $area)
                <option value="{{$area->id}}">{{$area->getTranslations('name')['ar']}} - {{$area->getTranslations('name')['en']}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.city_ar')</label>
        <input type="text"  class="form-control" @if(isset($city)) value="{{$city->getTranslations('name')['ar']}}" @endif placeholder="{{__('admin.city_ar')}}" name="name_ar">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.city_en')</label>
        <input type="text"  class="form-control" @if(isset($city)) value="{{$city->getTranslations('name')['en']}}" @endif placeholder="{{__('admin.city_en')}}" name="name_en">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.status')</label>
        <select class="select2 form-control" name="status">

            <option value="active" @if(isset($city) && $city->status =="active") selected @endif >@lang('admin.active')</option>
            <option value="in_active" @if(isset($city) && $city->status =="in_active") selected @endif>@lang('admin.in_active')</option>

        </select>
    </div>
</div>
