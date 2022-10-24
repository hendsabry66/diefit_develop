<div class="row">
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.value_ar')</label>
        <input type="text"  class="form-control" @if(isset($productSpecification)) value="{{$productSpecification->getTranslations('value')['ar']}}" @endif placeholder="{{__('admin.value_ar')}}" name="value_ar">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.value_en')</label>
        <input type="text"  class="form-control" @if(isset($productSpecification)) value="{{$productSpecification->getTranslations('value')['en']}}" @endif placeholder="{{__('admin.value_en')}}" name="value_en">
    </div>


    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.category')</label>
        <select class="select2 form-control" name="product_specification_category_id">
            <option value="">@lang('admin.choose')</option>
            @foreach($productSpecificationCategories as $productSpecificationCategory)
                <option value="{{$productSpecificationCategory->id}}" @if(isset($productSpecification) && $productSpecification->product_specification_category_id  == $productSpecificationCategory->id) selected @endif>{{$productSpecificationCategory->getTranslations('name')['ar']}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.product')</label>
        <select class="select2 form-control" name="product_id">
            <option value="">@lang('admin.choose')</option>
            @foreach($products as $product)
                <option value="{{$product->id}}" @if(isset($productSpecification) && $productSpecification->product_id  == $product->id) selected @endif>{{$product->getTranslations('name')['ar']}}</option>
            @endforeach
        </select>
    </div>



</div>
