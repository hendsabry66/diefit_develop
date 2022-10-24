
@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.settings')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item active">@lang('admin.settings')
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <section id="basic-tabs-components">
        <div class="row match-height">
            <div class="col-xl-12 col-lg-12">
                <div class="card">

                    <div class="card-content">
                        <div class="card-body">

                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="public_setting" href="#public_setting" aria-expanded="true"> اعدادات عامة </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="social_setting" href="#social_setting" aria-expanded="false">اعدادات تواصل الاجتماعي </a>
                                </li>
                            </ul>
                            <div class="tab-content px-1 pt-1">

                                    <div role="tabpanel" class="tab-pane active" id="public_setting" aria-expanded="true" aria-labelledby="base-tab1">
                                        <form method="POST" class="ajaxForm" action="{{ route('settings.update', 1) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                            @csrf
                                            @include('admin.settings.public_form',['public_settings'=>$public_settings])
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-actions">
                                                        <button type="submit" class="btn btn-success">حفظ</button>
                                                        <button type="reset" class="btn btn-danger"> الغاء</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="social_setting" aria-labelledby="base-tab2">
                                        <form method="POST" class="ajaxForm" action="{{ route('settings.update', 2) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                            @csrf

                                            @include('admin.settings.social_form',['social_settings'=>$social_settings])
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-actions">
                                                        <button type="submit" class="btn btn-success">حفظ</button>
                                                        <button type="reset" class="btn btn-danger"> الغاء</button>
                                                    </div>
                                                </div>
                                            </div>
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
