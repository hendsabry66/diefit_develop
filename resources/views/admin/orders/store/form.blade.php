<div class="row">


    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.status')</label>
        <select class="select2 form-control" name="status">
            @foreach($statuses as $status)
                <option value="{{$status->id}}" @if($status->id == $order->status_id) selected @endif>{{$status->getTranslations('name')['ar']}}</option>
            @endforeach

        </select>
    </div>
</div>
