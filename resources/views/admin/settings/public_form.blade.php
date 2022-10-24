@forelse($public_settings as $setting)
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group has-feedback @error($setting->key) has-error @enderror">
                <label for="{{ $setting->key }}">{{ $setting->name }} @if($setting->type == 'text') @endif</label>
                <div class="input-container">
                    @if($setting->type == 'string')
                        <input type="text" class="form-control" placeholder="{{ $setting->name }}" name="{{ $setting->key }}" id="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}">
                    @elseif($setting->type == 'number')
                        <input type="number" class="form-control" placeholder="{{ $setting->name }}" name="{{ $setting->key }}" id="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}">
                    @elseif($setting->type == 'file')
                        <input type="file" class="form-control" name="{{ $setting->key }}">
                       <img src="{{\Request::root().'/uploads/setting/'.$setting->value}}">
                    @elseif($setting->type == 'text')
                        <textarea name="{{ $setting->key }}" class="form-control" placeholder="{{ $setting->name }}" id="{{ $setting->key }}" cols="30" rows="10">{{ old($setting->key, $setting->value) }}</textarea>


 @elseif($setting->type == 'checkbox')
{{--                        <label for="store">طرق الدفع الخاصه بالمتجر </label>--}}

                        <select name="{{ $setting->key }}[]" id="{{ $setting->key }}" class="form-control" multiple>

                            <option value="bank_transfer" @if(in_array("bank_transfer", json_decode($setting->value))) selected @endif >bank_transfer</option>
                            <option value="visa" @if(in_array("visa", json_decode($setting->value))) selected @endif >visa</option>
                            <option value="card" @if(in_array("card", json_decode($setting->value))) selected @endif >card</option>
                            <option value="madi" @if(in_array("madi", json_decode($setting->value))) selected @endif >madi</option>
                        </select>
{{--                        <select name="store_payment[]" id="store_payment" class="form-control" multiple>--}}

{{--                            <option value="bank_transfer" @if(in_array("bank_transfer", json_decode($setting->value))) selected @endif >bank_transfer</option>--}}
{{--                            <option value="visa" @if(in_array("visa", json_decode($setting->value))) selected @endif >visa</option>--}}
{{--                            <option value="card" @if(in_array("card", json_decode($setting->value))) selected @endif >card</option>--}}
{{--                            <option value="madi" @if(in_array("madi", json_decode($setting->value))) selected @endif >madi</option>--}}
{{--                        </select>--}}
{{--                        <select name="store_payment[]" id="store_payment" class="form-control" multiple>--}}

{{--                            <option value="bank_transfer" @if(in_array("bank_transfer", json_decode($setting->value))) selected @endif >bank_transfer</option>--}}
{{--                            <option value="visa" @if(in_array("visa", json_decode($setting->value))) selected @endif >visa</option>--}}
{{--                            <option value="card" @if(in_array("card", json_decode($setting->value))) selected @endif >card</option>--}}
{{--                            <option value="madi" @if(in_array("madi", json_decode($setting->value))) selected @endif >madi</option>--}}
{{--                        </select>--}}


                    @endif
                </div>
                @error($setting->key)<span class="help-block"> <strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>
    </div>
@empty
@endforelse
