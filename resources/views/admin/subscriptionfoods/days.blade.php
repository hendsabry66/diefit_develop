<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        @for($i=1; $i<=$period; $i++)
            <li  role="presentation" class="nav-item nav-link @if($i ==1) active @endif">
                <a href="#day_{{$i}}" aria-controls="day_{{$i}}" role="tab" data-toggle="tab" class="nav-link">day_{{$i}}</a>
            </li>
        @endfor
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        @for($i=1; $i<=$period; $i++)
            <input type="hidden" name="days[]" value="{{$i}}">
            <div role="tabpanel" class="tab-pane @if($i ==1) active @endif" id="day_{{$i}}">
                <div class="row">
                    @foreach($foodTypes as $foodType)

                        <div class="form-group col-md-12">
                            <label for="projectinput4">{{$foodType->getTranslations('name')['ar']}}</label>
                            <input type="hidden"  class="form-control"  value="{{$foodType->id}}"  name="foodType_id[{{$i}}][]">
                        </div>

                        <div class="form-group col-md-12">

                            <select class="form-control" name="foods[{{$i}}][{{$foodType->id}}][]"  style="    width: 100% !important;" multiple>
                                <option value="">@lang('admin.choose')</option>
                                @foreach($foods as $food)
                                    <option value="{{$food->id}}">{{$food->getTranslations('name')['ar']}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>
            </div>
        @endfor
    </div>

</div>
