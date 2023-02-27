<div class="row">
    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.title_ar')</label>
        <input name="title_ar" value="@if(isset($slider)) {{$slider->getTranslations('title')['ar'] }} @endif" class="form-control" />
    </div>
    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.title_en')</label>
        <input name="title_en" value="@if(isset($slider)) {{$slider->getTranslations('title')['ar'] }} @endif" class="form-control" />
    </div>


    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.btn_name_en')</label>
        <input name="btn_name_en" value="@if(isset($slider)) {{$slider->getTranslations('btn_name')['ar'] }} @endif" class="form-control" />
    </div>

    <div class="form-group col-md-12 mb-2">
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

    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.description_ar')</label>
        <textarea name="description_ar" id="tinymce">@if(isset($slider)) {!! $slider->getTranslations('description')['ar'] !!} @endif </textarea>
    </div>
    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.description_en')</label>
        <textarea name="description_en" id="tinymce">@if(isset($slider)) {!! $slider->getTranslations('description')['en'] !!} @endif </textarea>
    </div>
    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.background')</label>
        <input type="color" name="background" value="@if(isset($slider)) {{$slider->background}} @endif " />
    </div>
    <div class="form-group col-md-12 mb-2">
        <select name="page_type" class="form-control">
            <option value="article">article</option>
            <option value="video">video</option>
            <option value="store">store</option>
            <option value="resturant">resturant</option>
            <option value="subscription">subscription</option>
        </select>
    </div>



</div>
