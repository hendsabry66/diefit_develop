<div class="row">
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.title_ar')</label>
        <input type="text"  class="form-control" @if(isset($page)) value="{{ $page->getTranslations('title')['ar'] }}" @endif placeholder="{{__('admin.title_ar')}}" name="title_ar">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.title_en')</label>
        <input type="text"  class="form-control" @if(isset($page)) value="{{$page->getTranslations('title')['en']}}" @endif placeholder="{{__('admin.title_en')}}" name="title_en">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.image')</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.status')</label>
        <select class="select2 form-control" name="status">

            <option value="active" @if(isset($page) && $page->status =="active") selected @endif >@lang('admin.active')</option>
            <option value="in_active" @if(isset($page) && $page->status =="in_active") selected @endif>@lang('admin.in_active')</option>

        </select>
    </div>
    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.details_ar')</label>
        <textarea name="details_ar" id="tinymce">@if(isset($page)) {!! $page->getTranslations('details')['ar'] !!} @endif </textarea>
    </div>
    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.details_en')</label>
        <textarea name="details_en" id="tinymce">@if(isset($page)) {!! $page->getTranslations('details')['en'] !!} @endif </textarea>
    </div>


</div>
