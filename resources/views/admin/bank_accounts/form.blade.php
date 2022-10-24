<div class="row">

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.bank_name')</label>
        <input type="text"  class="form-control" @if(isset($bankAccount)) value="{{$bankAccount->bank_name}}" @endif placeholder="{{__('admin.bank_name')}}" name="bank_name">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.account_number')</label>
        <input type="text"  class="form-control" @if(isset($bankAccount)) value="{{$bankAccount->account_number}}" @endif placeholder="{{__('admin.account_number')}}" name="account_number">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.account_iban')</label>
        <input type="text"  class="form-control" @if(isset($bankAccount)) value="{{$bankAccount->account_iban}}" @endif placeholder="{{__('admin.account_iban')}}" name="account_iban">
    </div>
    <div class="form-group col-md-6 mb-2">
        <label for="projectinput4">@lang('admin.swift_code')</label>
        <input type="text"  class="form-control" @if(isset($bankAccount)) value="{{$bankAccount->swift_code}}" @endif placeholder="{{__('admin.swift_code')}}" name="swift_code">
    </div>

    <div class="form-group col-md-6 mb-2">
        <label for="projectinput3">@lang('admin.status')</label>
        <select class="select2 form-control" name="status">

            <option value="active" @if(isset($area) && $area->status =="active") selected @endif >@lang('admin.active')</option>
            <option value="in_active" @if(isset($area) && $area->status =="in_active") selected @endif>@lang('admin.in_active')</option>

        </select>
    </div>
</div>
