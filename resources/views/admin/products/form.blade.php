<div class="row">
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_ar')</label>
        <input type="text"  class="form-control" @if(isset($product)) value="{{$product->getTranslations('name')['ar']}}" @endif placeholder="{{__('admin.name_ar')}}" name="name_ar">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_en')</label>
        <input type="text"  class="form-control" @if(isset($product)) value="{{$product->getTranslations('name')['en']}}" @endif placeholder="{{__('admin.name_en')}}" name="name_en">
    </div>



    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.details_ar')</label>
        <textarea  class="form-control"  id="tinymce"  name="details_ar"> @if(isset($product)) {!! $product->getTranslations('details')['ar'] !!}" @endif </textarea>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.details_en')</label>
        <textarea class="form-control" id="tinymce"  name="details_en"> @if(isset($product)) {!! $product->getTranslations('details')['en']  !!} @endif </textarea>
    </div>



    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.category')</label>
        <select class="select2 form-control" name="product_category_id">
            <option value="">@lang('admin.choose')</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}" @if(isset($product) && $product->product_category_id  == $category->id) selected @endif>{{$category->getTranslations('name')['ar']}}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.price')</label>
        <input type="number" class="form-control" name="price" @if(isset($product)) value="{{$product->price}}" @endif>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.qty')</label>
        <input type="number" class="form-control" name="qty" @if(isset($product)) value="{{$product->qty}}" @endif>
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
