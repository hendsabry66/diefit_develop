<div class="row">
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.title_ar')</label>
        <input name="title_ar" value="@if(isset($slider)) {{$slider->getTranslations('title')['ar'] }} @endif" class="form-control" />
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.title_en')</label>
        <input name="title_en" value="@if(isset($slider)) {{$slider->getTranslations('title')['ar'] }} @endif" class="form-control" />
    </div>


    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.btn_name_en')</label>
        <input name="btn_name_en" value="@if(isset($slider)) {{$slider->getTranslations('btn_name')['ar'] }} @endif" class="form-control" />
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.btn_name_ar')</label>
        <input name="btn_name_ar" value="@if(isset($slider)) {{$slider->getTranslations('btn_name')['ar'] }} @endif" class="form-control" />
    </div>




    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.image')</label>
        <input type="file" name="image" class="form-control">
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.link_btn')</label>
        <input type="text"  class="form-control" @if(isset($slider)) value="{{$slider->link_btn}}" @endif placeholder="{{__('admin.link')}}" name="link_btn">
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.description_ar')</label>
        <textarea name="description_ar" id="tinymce">@if(isset($slider)) {!! $slider->getTranslations('description')['ar'] !!} @endif </textarea>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.description_en')</label>
        <textarea name="description_en" id="tinymce">@if(isset($slider)) {!! $slider->getTranslations('description')['en'] !!} @endif </textarea>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.background')</label>
        <input type="color" name="background" value="@if(isset($slider)) {{$slider->background}} @endif " class="form-control" />
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.page_type')</label>
        <select name="page_type" class="form-control">
            <option value="home" @if(isset($slider) && $slider->page_type == 'home' ) selected @endif >home</option>

            <option value="article" @if(isset($slider) && $slider->page_type == 'article' ) selected @endif >article</option>
            <option value="video" @if(isset($slider) && $slider->page_type == 'video' ) selected @endif >video</option>
            <option value="store" @if(isset($slider) && $slider->page_type == 'store' ) selected @endif >store</option>
            <option value="resturant" @if(isset($slider) && $slider->page_type == 'resturant' ) selected @endif >resturant</option>
            <option value="subscription" @if(isset($slider) && $slider->page_type == 'subscription' ) selected @endif >subscription</option>
        </select>
    </div>



</div>
