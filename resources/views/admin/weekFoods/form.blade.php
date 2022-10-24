<div class="row">
    @foreach($foodTypes as $foodType)

    <div class="form-group col-md-12">
        <label for="projectinput4">{{$foodType->getTranslations('name')['ar']}}</label>
        <input type="hidden"  class="form-control"  value="{{$foodType->id}}"  name="foodType_id[]">
    </div>

        <div class="form-group col-md-12">
            <label for="projectinput3">@lang('admin.foods')</label>
            <select class=" select2 form-control" name="foods{{$foodType->id}}[]"  style="    width: 100% !important;" multiple>
                <option value="">@lang('admin.choose')</option>
                @foreach($foods as $food)
                    <option value="{{$food->id}}"  @if(in_array($food->id, $foodType->weekFoods()->where('day',$day)->pluck('food_id')->toArray())) selected @endif>{{$food->getTranslations('name')['ar']}}</option>
                @endforeach
            </select>
        </div>
    @endforeach
</div>
