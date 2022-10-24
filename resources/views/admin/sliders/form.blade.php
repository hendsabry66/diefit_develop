<div class="row">

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.image')</label>
        <input type="file" name="image" class="form-control">
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.link')</label>
        <input type="text"  class="form-control" @if(isset($slider)) value="{{$slider->link}}" @endif placeholder="{{__('admin.link')}}" name="link">
    </div>

    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.text_ar')</label>
        <textarea name="text_ar" id="tinymce">@if(isset($slider)) {!! $slider->getTranslations('text')['ar'] !!} @endif </textarea>
    </div>
    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.text_en')</label>
        <textarea name="text_en" id="tinymce">@if(isset($slider)) {!! $slider->getTranslations('text')['en'] !!} @endif </textarea>
    </div>


</div>
