@forelse($social_settings as $setting)
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
                        <ul>
                            @if($setting->getMedia()->last())
                                <li><a href="{{ $setting->getMedia()->last()->links['full_url'] }}" target="_blank">{{ $setting->getMedia()->last()->links['full_url'] }}</a></li>
                            @endif
                        </ul>
                    @elseif($setting->type == 'text')
                        <textarea name="{{ $setting->key }}" class="form-control" placeholder="{{ $setting->name }}" id="{{ $setting->key }}" cols="30" rows="10">{{ old($setting->key, $setting->value) }}</textarea>
                    @endif
                </div>
                @error($setting->key)<span class="help-block"> <strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>
    </div>
@empty
@endforelse
