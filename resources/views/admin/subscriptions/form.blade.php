
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
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.details_ar')</label>
        <textarea name="details_ar"
                  id="tinymce">@if(isset($subscription)) {!! $subscription->getTranslations('details')['ar'] !!} @endif </textarea>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.details_en')</label>
        <textarea name="details_en"
                  id="tinymce">@if(isset($subscription)) {!! $subscription->getTranslations('details')['en'] !!} @endif </textarea>
    </div>
</div>

<h4 class="form-section"><i class="fa fa-clipboard"></i> المختص </h4>
<div class="row">
    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.has_specialist')</label>
        <select name="has_specialist" class="form-control select-specialist">
            <option> يوجد مختص </option>
            <option value="1" @if(isset($subscription)) @if($subscription->has_specialist== 1) selected @endif @endif >@lang('admin.yes')</option>
            <option value="0" @if(isset($subscription)) @if($subscription->has_specialist== 0) selected @endif @endif>@lang('admin.no')</option>
        </select>
    </div>
    @if(isset($subscription) && $subscription->has_specialist ==1)
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
    @else
        <div class="form-group col-md-6 mb-2 action-for-specialist" style="display: none">
            <label for="projectinput4">@lang('admin.specialist_price_for_session')</label>
            <input type="number" class="form-control" placeholder="{{__('admin.specialist_price_for_session')}}"
                   name="specialist_price_for_session">
        </div>
        <div class="form-group col-md-6 mb-2 action-for-specialist" style="display: none">
            <label for="projectinput4">@lang('admin.suggested_session_number')</label>
            <input type="number" class="form-control" placeholder="{{__('admin.suggested_session_number')}}"
                   name="suggested_session_number">
        </div>
    @endif

</div>
<h4 class="form-section"><i class="fa fa-clipboard"></i> السعرات الحراريه </h4>
<div class="row">
    <div class="form-group col-md-12 mb-2">
        <label for="projectinput4">@lang('admin.has_calories')</label>
        <select name="has_calories" class="form-control select-calories">
            <option value="1" @if(isset($subscription)) @if($subscription->has_calories== 1) selected @endif @endif>@lang('admin.yes')</option>
            <option value="0" @if(isset($subscription)) @if($subscription->has_calories== 0) selected @endif @endif>@lang('admin.no')</option>
        </select>

    </div>
    <div class="form-group col-md-12 mb-2 action-for-calories">
        <label for="projectinput4">@lang('admin.calories')</label>
        <button type="button" class="add-new-calories col-md-2 btn btn-primary">+</button>

        @if(isset($subscription) && $subscription->has_calories ==1)
            @foreach(json_decode($subscription->calories) as $calorie)
                <div class="row mt-1 mb-1 one-new-calories">
                    <div class="col-11">
                        <input type="number" class="form-control" name="calories[]" value="{{$calorie}}">
                    </div>
                    <div class="col-1">
                        <button type="button" class="remove-calories btn btn-danger"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            @endforeach
        @else
            <input type="number" class="form-control" name="calories[]" style="display: none">
        @endif
    </div>

    <div class="list-of-calories form-group col-md-12 mb-2">

    </div>
</div>
<h4 class="form-section"><i class="fa fa-clipboard"></i> الوجبات</h4>
<div class="row">
    <div class="form-group col-md-12 one-food-type">
        <h5>بدون وقت</h5>
        <button type="button" class="add-new-food btn btn-primary" data-food-type="0">+</button>
        <div class="col-md-12 mb-2 list-of-foods action-for-meals foods-type-0 text-left"></div>
    </div>
    @foreach($foodTypes as $foodType)
        <div class="form-group col-md-12 one-food-type">
            <h5>{{$foodType->name}}</h5>
            <button type="button" class="add-new-food btn btn-primary" data-food-type="{{$foodType->id}}">+</button>
            <div class="col-md-12 mb-2 list-of-foods action-for-meals foods-type-{{$foodType->id}} text-left"></div>
        </div>
    @endforeach

    <select class="select-foods hidden">
        <option value="">@lang('admin.choose')</option>
        @foreach($foods as $food)
            <option value="{{$food->id}}">{{$food->name}}</option>
        @endforeach

    </select>

</div>
<h4 class="form-section"><i class="fa fa-clipboard"></i> مدة التوصيل </h4>
<div class="row">
    @if(isset($subscription) && !empty($subscription->subscriptionDelivery))
        <div class="col-md-12">
            @foreach($subscription->subscriptionDelivery as $delivery)
                <div class="row one-new-delivery">
                    <div class="form-group col-md-5 mb-2">
                        <label for="projectinput4">عدد ايام توصيل المطبخ</label>
                        <input type="number" class="form-control" name="number_of_delivery_days[]" value="{{$delivery->number_of_delivery_days}}" >
                    </div>
                    <div class="form-group col-md-5 mb-2">
                        <label for="projectinput4">مده اشتراك العميل </label>
                        <input type="number" class="form-control" name="period[]" value="{{$delivery->period}}" >
                    </div>
                    <button type="button" class="remove-delivery btn btn-danger col-md-2 mb-2">-</button>
                </div>

            @endforeach
        </div>
    @else
        <div class="form-group col-md-5 mb-2">
            <label for="projectinput4">عدد ايام توصيل المطبخ</label>
            <input type="number" class="form-control" name="number_of_delivery_days[]" >
        </div>
        <div class="form-group col-md-5 mb-2">
            <label for="projectinput4">مده اشتراك العميل </label>
            <input type="number" class="form-control" name="period[]" >
        </div>
    @endif

    <button type="button" class="add-new-delivery btn btn-primary col-md-2 mb-2">اضافة</button>
    <div class="list-of-delivery col-md-12"></div>
</div>
<h4 class="form-section"><i class="fa fa-clipboard"></i> السعر</h4>
<div class="row">
    <div class="form-group col-md-12 mb-2">
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
