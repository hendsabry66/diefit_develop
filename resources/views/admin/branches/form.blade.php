<div class="row">
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_ar')</label>
        <input type="text"  class="form-control" @if(isset($branch)) value="{{ $branch->getTranslations('name')['ar'] }}" @endif placeholder="{{__('admin.name_ar')}}" name="name_ar">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.title_en')</label>
        <input type="text"  class="form-control" @if(isset($branch)) value="{{$branch->getTranslations('name')['en']}}" @endif placeholder="{{__('admin.name_en')}}" name="name_en">
    </div>
    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.details_ar')</label>
        <textarea name="details_ar" id="tinymce">@if(isset($branch)) {!! $branch->getTranslations('details')['ar'] !!} @endif </textarea>
    </div>
    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.details_en')</label>
        <textarea name="details_en" id="tinymce">@if(isset($branch)) {!! $branch->getTranslations('details')['en'] !!} @endif </textarea>
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.latitude')</label>
        <input type="number" min="1"  class="form-control" @if(isset($branch)) value="{{$branch->latitude}}" @endif placeholder="{{__('admin.latitude')}}" name="latitude">
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.longitude')</label>
        <input type="number" min="1"  class="form-control" @if(isset($branch)) value="{{$branch->longitude}}" @endif placeholder="{{__('admin.longitude')}}" name="longitude">
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.city')</label>
        <select class="select2 form-control" name="city_id">
            @foreach($cities as $city)
                <option value="{{$city->id}}">{{$city->getTranslations('name')['ar']}} - {{$city->getTranslations('name')['en']}}</option>
            @endforeach
        </select>
    </div>

</div>
