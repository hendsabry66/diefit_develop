<div class="row">
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.title_ar')</label>
        <input type="text"  class="form-control" @if(isset($article)) value="{{$article->getTranslations('title')['ar']}}" @endif placeholder="{{__('admin.title_ar')}}" name="title_ar">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.title_en')</label>
        <input type="text"  class="form-control" @if(isset($article)) value="{{$article->getTranslations('title')['en']}}" @endif placeholder="{{__('admin.title_en')}}" name="title_en">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.short_description_ar')</label>
        <textarea  class="form-control" id="tinymce" name="short_description_ar">  @if(isset($article)) {!! $article->getTranslations('short_description')['ar'] !!} @endif </textarea>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.short_description_en')</label>
        <textarea class="form-control"  id="tinymce" name="short_description_en"> @if(isset($article)) {!! $article->getTranslations('short_description')['en'] !!}" @endif  </textarea>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.details_ar')</label>
        <textarea  class="form-control"  id="tinymce"  name="details_ar"> @if(isset($article)) {!! $article->getTranslations('details')['ar'] !!}" @endif </textarea>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.details_en')</label>
        <textarea class="form-control" id="tinymce"  name="details_en"> @if(isset($article)) {!! $article->getTranslations('details')['en']  !!} @endif </textarea>
    </div>



    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.category')</label>
        <select class="select2 form-control" name="article_category_id">
            <option value="">@lang('admin.choose')</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}" @if(isset($article) && $article->article_category_id  == $category->id) selected @endif>{{$category->getTranslations('name')['ar']}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.user')</label>
        <select class="select2 form-control" name="user_id">
            <option value="">@lang('admin.choose')</option>
            @foreach($users as $user)
                <option value="{{$user->id}}" @if(isset($article) && $article->user_id  == $user->id) selected @endif>{{$user->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.status')</label>
        <select class="select2 form-control" name="status">

            <option value="active" @if(isset($article) && $article->status =="active") selected @endif >@lang('admin.active')</option>
            <option value="in_active" @if(isset($article) && $article->status =="in_active") selected @endif>@lang('admin.in_active')</option>

        </select>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.image')</label>
        <input type="file" name="image" multiple class="form-control">
    </div>
</div>
