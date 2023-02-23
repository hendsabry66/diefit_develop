<div class="row">
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_ar')</label>
        <input type="text"  class="form-control" @if(isset($extra)) value="{{$extra->getTranslations('name')['ar']}}" @endif placeholder="{{__('admin.name_ar')}}" name="name_ar">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_en')</label>
        <input type="text"  class="form-control" @if(isset($extra)) value="{{$extra->getTranslations('name')['en']}}" @endif placeholder="{{__('admin.name_en')}}" name="name_en">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.numberOfCalories')</label>
        <input type="number" class="form-control" name="numberOfCalories" @if(isset($extra)) value="{{$extra->numberOfCalories}}" @endif>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.fat_percentage')</label>
        <input type="number" class="form-control" name="fat_percentage" @if(isset($extra)) value="{{$extra->fat_percentage}}" @endif>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.carbohydrate_percentage')</label>
        <input type="number" class="form-control" name="carbohydrate_percentage" @if(isset($extra)) value="{{$extra->carbohydrate_percentage}}" @endif>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.protein_percentage')</label>
        <input type="number" class="form-control" name="protein_percentage" @if(isset($extra)) value="{{$extra->protein_percentage}}" @endif>
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.saturated_fat')</label>
        <input type="number" min="1" class="form-control" name="saturated_fat" @if(isset($food)) value="{{$food->saturated_fat}}" @endif>
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.trans_fats')</label>
        <input type="number" min="1" class="form-control" name="trans_fats" @if(isset($food)) value="{{$food->trans_fats}}" @endif>
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.cholestrol')</label>
        <input type="number" min="1" class="form-control" name="cholestrol" @if(isset($food)) value="{{$food->cholestrol}}" @endif>
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.sodium')</label>
        <input type="number" min="1" class="form-control" name="sodium" @if(isset($food)) value="{{$food->sodium}}" @endif>
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.fiber')</label>
        <input type="number" min="1" class="form-control" name="fiber" @if(isset($food)) value="{{$food->fiber}}" @endif>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.sugars')</label>
        <input type="number" min="1" class="form-control" name="sugars" @if(isset($food)) value="{{$food->sugars}}" @endif>
    </div>

    <div class="allPrices col-12">
        @if(isset($extra->values))
            @foreach($extra->values as $key => $value)
                <div class="row defOnePrice">
                <div class="form-group col-md-6 mb-2">
                    <label for="projectinput3">@lang('admin.price') </label>
                    <input type="number" class="form-control" name="price[]" value="{{$value->price}}">
                </div>
                <div class="form-group col-md-6 mb-2">
                    <label for="projectinput3">@lang('admin.value')</label>
                    <input type="text" class="form-control" name="value[]" value="{{$value->value}}" >
                </div>
                </div>
            @endforeach
        @endif
{{--      <div class="row defOnePrice">--}}
{{--      <div class="form-group col-md-6 mb-2">--}}
{{--        <label for="projectinput3">@lang('admin.price')</label>--}}
{{--        <input type="number" class="form-control" name="price[]" value="" >--}}
{{--    </div>--}}
{{--    <div class="form-group col-md-6 mb-2">--}}
{{--        <label for="projectinput3">@lang('admin.value')</label>--}}
{{--        <input type="text" class="form-control" name="value[]" value="" >--}}
{{--    </div>--}}
{{--      </div>--}}
  </div>

{{--    <div class="form-group col-12 mb-2">--}}
{{--  <button type="button" class="btn btn-block btn-primary addNewPrice">اضافة</button>--}}
{{--  </div>--}}


</div>
