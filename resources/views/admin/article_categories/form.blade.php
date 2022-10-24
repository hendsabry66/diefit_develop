<div class="row">

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_ar')</label>
        <input type="text"  class="form-control" @if(isset($articleCategory)) value="{{$articleCategory->getTranslations('name')['ar']}}" @endif placeholder="{{__('admin.name')}}" name="name_ar">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_en')</label>
        <input type="text"  class="form-control" @if(isset($articleCategory)) value="{{$articleCategory->getTranslations('name')['en']}}" @endif placeholder="{{__('admin.name')}}" name="name_en">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.category')</label>
        <select class="select2 form-control" name="parent_id">
            <option value=""> @lang('admin.category')</option>
            @foreach($categories as $_category)
                <option value="{{$_category->id}}" @if(isset($articleCategory) && $articleCategory->parent_id  == $_category->id) selected @endif>{{$_category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.image')</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.status')</label>
        <select class="select2 form-control" name="status">

            <option value="active" @if(isset($articleCategory) && $articleCategory->status =="active") selected @endif >@lang('admin.active')</option>
            <option value="in_active" @if(isset($articleCategory) && $articleCategory->status =="in_active") selected @endif>@lang('admin.in_active')</option>

        </select>
    </div>

</div>
