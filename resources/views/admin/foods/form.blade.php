<div class="row">
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_ar')</label>
        <input type="text"  class="form-control" @if(isset($food)) value="{{$food->getTranslations('name')['ar']}}" @endif placeholder="{{__('admin.name_ar')}}" name="name_ar">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_en')</label>
        <input type="text"  class="form-control" @if(isset($food)) value="{{$food->getTranslations('name')['en']}}" @endif placeholder="{{__('admin.name_en')}}" name="name_en">
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.ingredients_ar')</label>
        <textarea  class="form-control" id="tinymce" name="ingredients_ar">  @if(isset($food)) {!! $food->getTranslations('ingredients')['ar'] !!} @endif </textarea>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.ingredients_en')</label>
        <textarea class="form-control"  id="tinymce" name="ingredients_en"> @if(isset($food)) {!! $food->getTranslations('ingredients')['en'] !!}" @endif  </textarea>
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.details_ar')</label>
        <textarea  class="form-control"  id="tinymce"  name="details_ar"> @if(isset($food)) {!! $food->getTranslations('details')['ar'] !!}" @endif </textarea>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.details_en')</label>
        <textarea class="form-control" id="tinymce"  name="details_en"> @if(isset($food)) {!! $food->getTranslations('details')['en']  !!} @endif </textarea>
    </div>



    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.category')</label>
        <select class="select2 form-control" name="food_category_id">
            <option value="">@lang('admin.choose')</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}" @if(isset($food) && $food->food_category_id  == $category->id) selected @endif>{{$category->getTranslations('name')['ar']}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.extra')</label>
        <select class="select2 form-control" name="extras[]" multiple>
            <option value="">@lang('admin.choose')</option>
            @foreach($extras as $extra)
                <option value="{{$extra->id}}">{{$extra->getTranslations('name')['ar']}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.price')</label>
        <input type="number" class="form-control" name="price" @if(isset($food)) value="{{$food->price}}" @endif>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.qty')</label>
        <input type="number" class="form-control" name="qty" @if(isset($food)) value="{{$food->qty}}" @endif>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.numberOfCalories')</label>
        <input type="number" class="form-control" name="numberOfCalories" @if(isset($food)) value="{{$food->numberOfCalories}}" @endif>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.fat_percentage')</label>
        <input type="number" class="form-control" name="fat_percentage" @if(isset($food)) value="{{$food->fat_percentage}}" @endif>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.carbohydrate_percentage')</label>
        <input type="number" class="form-control" name="carbohydrate_percentage" @if(isset($food)) value="{{$food->carbohydrate_percentage}}" @endif>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.protein_percentage')</label>
        <input type="number" class="form-control" name="protein_percentage" @if(isset($food)) value="{{$food->protein_percentage}}" @endif>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.status')</label>
        <select name="status" class="form-control">
            <option value="restaurant" @if(isset($food) && $food->status == 'restaurant') selected @endif>@lang('admin.restaurant')</option>
            <option value="subscription" @if(isset($food) && $food->status == 'subscription') selected @endif >@lang('admin.subscription')</option>
            <option value="both" @if(isset($food) && $food->status == 'both') selected @endif>@lang('admin.both')</option>
        </select>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.image')</label>
        <input type="file" name="image" multiple class="form-control">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.images')</label>
        <input type="file" name="images[]" multiple class="form-control">
    </div>


</div>
