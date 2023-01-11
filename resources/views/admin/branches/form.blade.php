<div class="row">
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_ar')</label>
        <input type="text"  class="form-control" @if(isset($branch)) value="{{ $branch->getTranslations('name')['ar'] }}" @endif placeholder="{{__('admin.name_ar')}}" name="name_ar">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_en')</label>
        <input type="text"  class="form-control" @if(isset($branch)) value="{{$branch->getTranslations('name')['en']}}" @endif placeholder="{{__('admin.name_en')}}" name="name_en">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.address_ar')</label>
        <input type="text"  class="form-control" @if(isset($branch)) value="{{ $branch->getTranslations('address')['ar'] }}" @endif placeholder="{{__('admin.address_ar')}}" name="address_ar">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.address_en')</label>
        <input type="text"  class="form-control" @if(isset($branch)) value="{{$branch->getTranslations('address')['en']}}" @endif placeholder="{{__('admin.address_en')}}" name="address_en">
    </div>


    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.city')</label>
        <select class="select2 form-control" name="city_id">
            @foreach($cities as $city)
                <option value="{{$city->id}}">{{$city->getTranslations('name')['ar']}} - {{$city->getTranslations('name')['en']}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.district')</label>
        <select class="select2 form-control" name="district_id[]" multiple>
            @foreach($districts as $district)
                <option value="{{$district->id}}" @if(isset($branch)) @if(in_array($district->id ,$selectedDistricts)) selected @endif @endif>{{$district->getTranslations('name')['ar']}} - {{$district->getTranslations('name')['en']}}</option>
            @endforeach
        </select>
    </div>

</div>
