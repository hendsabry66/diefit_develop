
<div class="row">
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.subscriptions')</label>
        <select name="subscription_id" class="form-control">
            <option value="">@lang('admin.select')</option>
            @foreach($subscriptions as $subscription)

            <option value="{{$subscription->id}}">{{$subscription->getTranslations('name')['en']}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.periods')</label>
        <select name="subscription_delivery_id" class="form-control">
            <option value="">@lang('admin.select')</option>
        </select>
    </div>
    <div id="block"></div>
</div>
