<div class="row">
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.city')</label>
        <select class="select2 form-control" name="city_id">
            @foreach($cities as $city)
                <option value="{{$city->id}}">{{$city->getTranslations('name')['ar']}} - {{$city->getTranslations('name')['en']}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.district_ar')</label>
        <input type="text"  class="form-control" @if(isset($district)) value="{{$district->getTranslations('name')['ar']}}" @endif placeholder="{{__('admin.district_ar')}}" name="name_ar">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.district_en')</label>
        <input type="text"  class="form-control" @if(isset($district)) value="{{$district->getTranslations('name')['en']}}" @endif placeholder="{{__('admin.district_en')}}" name="name_en">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.status')</label>
        <select class="select2 form-control" name="status">

            <option value="active" @if(isset($district) && $district->status =="active") selected @endif >@lang('admin.active')</option>
            <option value="in_active" @if(isset($district) && $district->status =="in_active") selected @endif>@lang('admin.in_active')</option>

        </select>
    </div>


</div>
