
<div class="row">
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.subscriptions')</label>
        <select name="subscription_id" class="form-control">
            <option value="">@lang('admin.select')</option>
            @foreach($subscriptions as $subscription)

                <option value="{{$subscription->id}}" @if($subscriptionFoodType->subscription_id == $subscription->id) selected @endif >{{$subscription->getTranslations('name')['en']}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.periods')</label>
        <select name="subscription_delivery_id" class="form-control">
            <option value="">@lang('admin.select')</option>
            @foreach($subscription_delivery as $value)
                <option value="{{$value->id}}" @if($subscriptionFoodType->subscription_delivery_id == $value->id) selected @endif >{{$value->period}}</option>
            @endforeach

        </select>
    </div>
    <div id="block">
        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                @for($i=1; $i<=$selected_subscription_delivery->period; $i++) <li role="presentation" class="nav-item">
                    <a href="#day_{{$i}}" aria-controls="day_{{$i}}" role="tab" data-toggle="tab" class="nav-link  @if($i ==1) selected active @endif">day_{{$i}}</a>
                </li>
                @endfor
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                @for($i=1; $i<=$selected_subscription_delivery->period; $i++) <input type="hidden" name="days[]" value="{{$i}}">
                <div role="tabpanel" class="tab-pane fade @if($i ==1) show active @endif" id="day_{{$i}}">
                    <div class="row">
                        @foreach($foodTypes as $foodType)

                            <div class="form-group col-md-4">
                                <label class="form-label" for="projectinput4">{{$foodType->getTranslations('name')['ar']}}</label>
                                <input type="hidden" class="form-control" value="{{$foodType->id}}" name="foodType_id[{{$i}}][]">
                                <select class="form-control" name="foods[{{$i}}][{{$foodType->id}}][]" style="    width: 100% !important;" multiple>

                                    <option value="">@lang('admin.choose')</option>
                                    @foreach($foods as $food)
                                        <option value="{{$food->id}}" @if(in_array($food->id,SubscriptionFoods($subscriptionFoodType->id, $i, $foodType->id))) selected @endif>{{$food->getTranslations('name')['ar']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endfor
            </div>

        </div>
    </div>
</div>
<script>
    let navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(navLink => {
        navLink.addEventListener('click',()=>{
            navLink.classList.add('selected')
        })
    });
</script>
