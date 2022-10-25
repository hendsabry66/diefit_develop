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
        <label for="projectinput4">@lang('admin.specialist_price')</label>
        <input type="number" class="form-control" @if(isset($subscription))
        value="{{$subscription->specialist_price}}" @endif placeholder="{{__('admin.specialist_price')}}"
               name="specialist_price">
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.period')</label>
        <input type="number" class="form-control" name="period" @if(isset($subscription))
        value="{{ $subscription->period }}" @endif>
    </div>


    <div class="mb-2 col-lg-12">
        <div class="row align-items-end">
            <div class="form-group col-md-4 mb-2">
                <label for="projectinput3">@lang('admin.foodTypes')</label>
                <select class="select2 form-control" name="food_types[0][]" multiple>
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
                <button onclick="add();return false;" class="btn btn-primary">اضف</button>
            </div>
        </div>
    </div>
    <div class="next-index" style="display: none;">1</div>

    <div class="col-lg-12" id="wrapper"></div>

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
