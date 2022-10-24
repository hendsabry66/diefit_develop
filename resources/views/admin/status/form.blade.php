<div class="row">

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_ar')</label>
        <input type="text"  class="form-control" @if(isset($status)) value="{{$status->getTranslations('name')['ar']}}" @endif placeholder="{{__('admin.name')}}" name="name_ar">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_en')</label>
        <input type="text"  class="form-control" @if(isset($status)) value="{{$status->getTranslations('name')['en']}}" @endif placeholder="{{__('admin.name')}}" name="name_en">
    </div>

</div>
