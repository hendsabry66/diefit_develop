
<div class="row">
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_ar')</label>
        <input type="text" class="form-control" @if(isset($subscription))
        value="{{ $subscription->getTranslations('name')['ar'] }}" @endif placeholder="{{__('admin.name_ar')}}"
               name="name_ar">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.name_en')</label>
        <input type="text" class="form-control" @if(isset($subscription))
        value="{{$subscription->getTranslations('name')['en']}}" @endif placeholder="{{__('admin.name_en')}}"
               name="name_en">
    </div>
    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.details_ar')</label>
        <textarea name="details_ar"
                  id="tinymce">@if(isset($subscription)) {!! $subscription->getTranslations('details')['ar'] !!} @endif </textarea>
    </div>
    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.details_en')</label>
        <textarea name="details_en"
                  id="tinymce">@if(isset($subscription)) {!! $subscription->getTranslations('details')['en'] !!} @endif </textarea>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.has_specialist')</label>
        <select name="has_specialist" class="form-control select-specialist">
            <option value="1" @if(isset($subscription)) @if($subscription->has_specialist== 1) selected @endif @endif >@lang('admin.yes')</option>
            <option value="0" @if(isset($subscription)) @if($subscription->has_specialist== 0) selected @endif @endif>@lang('admin.no')</option>
        </select>
    </div>
    <div class="form-group col-md-6 mb-2 action-for-specialist">
        <label for="projectinput4">@lang('admin.specialist_price_for_session')</label>
        <input type="number" class="form-control" @if(isset($subscription))
        value="{{$subscription->specialist_price_for_session}}" @endif placeholder="{{__('admin.specialist_price_for_session')}}"
               name="specialist_price_for_session">
    </div>
    <div class="form-group col-md-6 mb-2 action-for-specialist">
        <label for="projectinput4">@lang('admin.suggested_session_number')</label>
        <input type="number" class="form-control" @if(isset($subscription))
        value="{{$subscription->suggested_session_number}}" @endif placeholder="{{__('admin.suggested_session_number')}}"
               name="suggested_session_number">
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">مده اشتراك العميل </label>
        <input type="number" class="form-control" name="period" @if(isset($subscription))
        value="{{ $subscription->period }}" @endif>
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.has_calories')</label>
        <select name="has_calories" class="form-control select-calories">
            <option value="1" @if(isset($subscription)) @if($subscription->has_calories== 1) selected @endif @endif>@lang('admin.yes')</option>
            <option value="0" @if(isset($subscription)) @if($subscription->has_calories== 0) selected @endif @endif>@lang('admin.no')</option>
        </select>

    </div>


        @if(isset($subscription))
            @if(!empty($subscription->calories))
            @foreach(json_decode($subscription->calories) as $calorie)
                <div class="form-group col-md-6 mb-2 action-for-calories">
                    <label for="projectinput4">@lang('admin.calories')</label>
                    <input type="number" class="form-control" name="calories[]" value="{{ $calorie }}">
                    <div class="list-of-calories"></div>
                    <button type="button" class="add-new-calories btn btn-primary">+</button>
                </div>
            @endforeach
                @else
                <div class="form-group col-md-6 mb-2 action-for-calories">
                    <label for="projectinput4">@lang('admin.calories')</label>
                    <input type="number" class="form-control" name="calories[]">
                    <div class="list-of-calories"></div>
                    <button type="button" class="add-new-calories btn btn-primary">+</button>
                </div>
            @endif
            @else
        <div class="form-group col-md-6 mb-2 action-for-calories">
            <label for="projectinput4">@lang('admin.calories')</label>
            <input type="number" class="form-control" name="calories[]" >
            <div class="list-of-calories"></div>
            <button type="button" class="add-new-calories btn btn-primary">+</button>
        </div>
        @endif



    {{--    <div class="form-group col-md-6 mb-2">--}}
    {{--        <label for="projectinput4">@lang('admin.has_quantities')</label>--}}
    {{--        <select name="has_quantities" class="form-control">--}}
    {{--            <option value="1">@lang('admin.yes')</option>--}}
    {{--            <option value="0">@lang('admin.no')</option>--}}
    {{--        </select>--}}
    {{--    </div>--}}

    {{--    <div class="form-group col-md-6 mb-2">--}}
    {{--        <label for="projectinput4">@lang('admin.quantities')</label>--}}
    {{--        <input type="number" class="form-control" name="quantities" @if(isset($subscription))--}}
    {{--        value="{{ $subscription->quantities }}" @endif>--}}
    {{--    </div>--}}

    {{--    <div class="form-group col-md-6 mb-2">--}}
    {{--        <label for="projectinput4">@lang('admin.food_type')</label>--}}
    {{--        <input type="radio"  value="without" name="food_type"> @lang('admin.without')--}}
    {{--        <input type="radio"  value="gram" name="food_type"> @lang('admin.gram')--}}
    {{--        <input type="radio"  value="calory" name="food_type"> @lang('admin.calory')--}}
    {{--    </div>--}}

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.has_meals')</label>
        <select name="has_meals" class="form-control select-meals">
            <option value="1">@lang('admin.yes')</option>
            <option value="0">@lang('admin.no')</option>
        </select>
    </div>

    <div class="form-group col-md-12 mb-2 action-for-meals">
        <label for="projectinput4">@lang('admin.foods')</label>
        <select class="select-foods hidden">
            <option value="1">@lang('admin.choose')</option>
            @foreach($foods as $food)
                <option value="{{$food->id}}">{{$food->name}}</option>
            @endforeach

        </select>
        <button type="button" class="add-new-food btn btn-primary">اضافة</button>
        {{--        <input type="number" class="form-control" name="meals" @if(isset($subscription))--}}
        {{--        value="{{ $subscription->meals }}" @endif>--}}
    </div>
    <div class="col-md-12 mb-2 list-of-foods action-for-meals"></div>


    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">عدد ايام توصيل المطبخ</label>
        <input type="number" class="form-control" name="number_of_delivery_days" @if(isset($subscription))
        value="{{ $subscription->number_of_delivery_days }}" @endif>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.price')</label>
        <input type="number" class="form-control" name="price" @if(isset($subscription))
        value="{{ $subscription->price }}" @endif>
    </div>

    {{--    <div class="mb-2 col-lg-12">--}}
    {{--        <div class="row align-items-end">--}}
    {{--            <div class="form-group col-md-4 mb-2">--}}
    {{--                <label for="projectinput3">@lang('admin.foodTypes')</label>--}}
    {{--                <select class="select2 form-control" name="food_types[0][]" multiple>--}}
    {{--                    <option value="">@lang('admin.choose')</option>--}}

    {{--                    @foreach($foodTypes as $foodType)--}}

    {{--                        <option value="{{$foodType->id}}" @if(isset($subscription) && in_array($foodType->id ,--}}
    {{--                        $foodTypesSelected) )) selected--}}
    {{--                            @endif>{{$foodType->getTranslations('name')['ar']}}</option>--}}
    {{--                    @endforeach--}}
    {{--                </select>--}}
    {{--            </div>--}}

    {{--            <div class="form-group col-md-4 mb-2">--}}
    {{--                <label for="projectinput4">@lang('admin.price')</label>--}}
    {{--                <input type="number" class="form-control" name="price[]" @if(isset($subscription))--}}
    {{--                value="{{ $subscription->subscriptionPrices[0]->price }}" @endif>--}}
    {{--            </div>--}}
    {{--            <div class="col-auto form-group">--}}
    {{--                <button onclick="add();return false;" class="btn btn-primary">اضف</button>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <div class="next-index" style="display: none;">1</div>--}}

    {{--    <div class="col-lg-12" id="wrapper"></div>--}}

</div>

<script>
    var dummy = `
    <div class="row align-items-end" id="em1">
            <div class="form-group col-md-4 mb-2">
                <label for="projectinput3">@lang('admin.foodTypes')</label>
                <select class="select-ajax form-control" name="food_types[getNextIndex][]" multiple>
                    <option value="">@lang('admin.choose')</option>

                    @foreach($foodTypes as $foodType)

    <option value="{{$foodType->id}}" @if(isset($subscription) && in_array($foodType->id ,
                        $subscription->foodTypes()->pluck('food_type_id')->toArray()) )) selected
                        @endif>{{$foodType->getTranslations('name')['ar']}}</option>
                    @endforeach
    </select>
</div>

<div class="form-group col-md-4 mb-2">
    <label for="projectinput4">@lang('admin.price')</label>
                <input type="number" class="form-control" name="price[]" @if(isset($subscription))
    value="{{ $subscription->price }}" @endif>
            </div>
            <div class="col-auto form-group">
                <button onclick="remove('em1');return false;" class="btn btn-danger">حذف</button>
            </div>
        </div>`;

    function add() {
        var getNextIndex = jQuery('.next-index').text();
        var dummy2 = dummy.replace("getNextIndex", getNextIndex);
        document.getElementById('wrapper').innerHTML += dummy2;
        jQuery('#wrapper .row:last-child .select-ajax').select2();
        jQuery('.next-index').text(Number(getNextIndex) + 1);
    }

    function remove(e) {
        var getNextIndex = jQuery('.next-index').text();
        jQuery('.next-index').text(Number(getNextIndex) - 1);
        document.getElementById(e).remove();
    }
</script>
