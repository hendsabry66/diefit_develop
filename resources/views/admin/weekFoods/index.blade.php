@extends('admin.layouts.master')
@section('content')
    <section id="basic-tabs-components">
        <div class="row match-height">
            <div class="col-xl-12 col-lg-12">
                <div class="card">

                    <div class="card-content">
                        <div class="card-body">

                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="day_1" href="#day_1" aria-expanded="true">  day1 </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="day_2" href="#day_2" aria-expanded="false">  day2 </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="day_3" href="#day_3" aria-expanded="false">  day3 </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="day_4" href="#day_4" aria-expanded="false">  day4 </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab5" data-toggle="tab" aria-controls="day_5" href="#day_5" aria-expanded="false">  day5 </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab6" data-toggle="tab" aria-controls="day_6" href="#day_6" aria-expanded="false">  day6 </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab7" data-toggle="tab" aria-controls="day_7" href="#day_7" aria-expanded="false">  day7 </a>
                                </li>
                            </ul>
                            <div class="tab-content px-1 pt-1">

                                <div role="tabpanel" class="tab-pane active" id="day_1" aria-expanded="true" aria-labelledby="base-tab1">
                                    <form action="{{url('admin/weekFoods')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="day" value="1">
                                        @include('admin.weekFoods.form', ['day' => 1])
                                        <button type="submit" class="btn btn-primary">@lang('admin.save')</button>
                                    </form>
                                </div>
                                <div class="tab-pane" id="day_2" aria-labelledby="base-tab2">
                                    <form action="{{url('admin/weekFoods')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="day" value="2">
                                        @include('admin.weekFoods.form', ['day' => 2])
                                        <button type="submit" class="btn btn-primary">@lang('admin.save')</button>
                                    </form>
                                </div>
                                <div class="tab-pane" id="day_3" aria-labelledby="base-tab2">
                                    <form action="{{url('admin/weekFoods')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="day" value="3">
                                        @include('admin.weekFoods.form', ['day' => 3])
                                        <button type="submit" class="btn btn-primary">@lang('admin.save')</button>
                                    </form>
                                </div>
                                <div class="tab-pane" id="day_4" aria-labelledby="base-tab2">
                                    <form action="{{url('admin/weekFoods')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="day" value="4">
                                        @include('admin.weekFoods.form', ['day' => 4])
                                        <button type="submit" class="btn btn-primary">@lang('admin.save')</button>
                                    </form>
                                </div>
                                <div class="tab-pane" id="day_5" aria-labelledby="base-tab2">
                                    <form action="{{url('admin/weekFoods')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="day" value="5">
                                        @include('admin.weekFoods.form', ['day' => 5])
                                        <button type="submit" class="btn btn-primary">@lang('admin.save')</button>
                                    </form>
                                </div>
                                <div class="tab-pane" id="day_6" aria-labelledby="base-tab2">
                                    <form action="{{url('admin/weekFoods')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="day" value="6">
                                        @include('admin.weekFoods.form', ['day' => 6])
                                        <button type="submit" class="btn btn-primary">@lang('admin.save')</button>
                                    </form>
                                </div>
                                <div class="tab-pane" id="day_7" aria-labelledby="base-tab2">
                                    <form action="{{url('admin/weekFoods')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="day" value="7">
                                        @include('admin.weekFoods.form', ['day' => 7])
                                        <button type="submit" class="btn btn-primary">@lang('admin.save')</button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   @endsection
