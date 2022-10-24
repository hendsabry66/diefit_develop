<div class="row">
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_ar')</label>
        <input type="text"  class="form-control" @if(isset($teamMember)) value="{{ $teamMember->getTranslations('name')['ar'] }}" @endif placeholder="{{__('admin.name_ar')}}" name="name_ar">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.title_en')</label>
        <input type="text"  class="form-control" @if(isset($teamMember)) value="{{$teamMember->getTranslations('name')['en']}}" @endif placeholder="{{__('admin.name_en')}}" name="name_en">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.image')</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.details_ar')</label>
        <textarea name="details_ar" id="tinymce">@if(isset($teamMember)) {!! $teamMember->getTranslations('details')['ar'] !!} @endif </textarea>
    </div>
    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.details_en')</label>
        <textarea name="details_en" id="tinymce">@if(isset($teamMember)) {!! $teamMember->getTranslations('details')['en'] !!} @endif </textarea>
    </div>


</div>
