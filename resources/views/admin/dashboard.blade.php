@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                <div class="pb-1">
                                    <div class="clearfix mb-1">
                                        <i class="icon-star font-large-1 blue-grey float-left mt-1"></i>
                                        <span class="font-large-2 text-bold-300 info float-right">{{$products}}</span>
                                    </div>
                                    <div class="clearfix">
                                        <span class="text-muted">المنتجات</span>
{{--                                        <span class="info float-right"><i class="ft-arrow-up info"></i> 16.89%</span>--}}
                                    </div>
                                </div>
{{--                                <div class="progress mb-0" style="height: 7px;">--}}
{{--                                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
                            </div>
                            <div class="col-lg-3 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                <div class="pb-1">
                                    <div class="clearfix mb-1">
                                        <i class="icon-user font-large-1 blue-grey float-left mt-1"></i>
                                        <span class="font-large-2 text-bold-300 danger float-right">{{$users}}</span>
                                    </div>
                                    <div class="clearfix">
                                        <span class="text-muted">المستخدمين</span>
{{--                                        <span class="danger float-right"><i class="ft-arrow-up danger"></i> 5.14%</span>--}}
                                    </div>
                                </div>
{{--                                <div class="progress mb-0" style="height: 7px;">--}}
{{--                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
                            </div>
                            <div class="col-lg-3 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                <div class="pb-1">
                                    <div class="clearfix mb-1">
                                        <i class="icon-shuffle font-large-1 blue-grey float-left mt-1"></i>
                                        <span class="font-large-2 text-bold-300 success float-right">{{$areas}}</span>
                                    </div>
                                    <div class="clearfix">
                                        <span class="text-muted">المناطق</span>
{{--                                        <span class="success float-right"><i class="ft-arrow-down success"></i> 2.24%</span>--}}
                                    </div>
                                </div>
{{--                                <div class="progress mb-0" style="height: 7px;">--}}
{{--                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="pb-1">
                                    <div class="clearfix mb-1">
                                        <i class="icon-wallet font-large-1 blue-grey float-left mt-1"></i>
                                        <span class="font-large-2 text-bold-300 warning float-right">{{$cities}}</span>
                                    </div>
                                    <div class="clearfix">
                                        <span class="text-muted">المدن</span>
{{--                                        <span class="warning float-right"><i class="ft-arrow-up warning"></i> 43.84%</span>--}}
                                    </div>
                                </div>
{{--                                <div class="progress mb-0" style="height: 7px;">--}}
{{--                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                <div class="pb-1">
                                    <div class="clearfix mb-1">
                                        <i class="icon-star font-large-1 blue-grey float-left mt-1"></i>
                                        <span class="font-large-2 text-bold-300 info float-right">{{$districts}}</span>
                                    </div>
                                    <div class="clearfix">
                                        <span class="text-muted">الاحياء</span>
{{--                                        <span class="info float-right"><i class="ft-arrow-up info"></i> 16.89%</span>--}}
                                    </div>
                                </div>
{{--                                <div class="progress mb-0" style="height: 7px;">--}}
{{--                                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
                            </div>
                            <div class="col-lg-3 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                <div class="pb-1">
                                    <div class="clearfix mb-1">
                                        <i class="icon-user font-large-1 blue-grey float-left mt-1"></i>
                                        <span class="font-large-2 text-bold-300 danger float-right">{{$branches}}</span>
                                    </div>
                                    <div class="clearfix">
                                        <span class="text-muted">الفروع</span>
{{--                                        <span class="danger float-right"><i class="ft-arrow-up danger"></i>{{$branches}}</span>--}}
                                    </div>
                                </div>
{{--                                <div class="progress mb-0" style="height: 7px;">--}}
{{--                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
                            </div>
                            <div class="col-lg-3 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                <div class="pb-1">
                                    <div class="clearfix mb-1">
                                        <i class="icon-shuffle font-large-1 blue-grey float-left mt-1"></i>
                                        <span class="font-large-2 text-bold-300 success float-right">{{$articles}}</span>
                                    </div>
                                    <div class="clearfix">
                                        <span class="text-muted">المقالات</span>
{{--                                        <span class="success float-right"><i class="ft-arrow-down success"></i> 2.24%</span>--}}
                                    </div>
                                </div>
{{--                                <div class="progress mb-0" style="height: 7px;">--}}
{{--                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="pb-1">
                                    <div class="clearfix mb-1">
                                        <i class="icon-wallet font-large-1 blue-grey float-left mt-1"></i>
                                        <span class="font-large-2 text-bold-300 warning float-right">{{$videos}}</span>
                                    </div>
                                    <div class="clearfix">
                                        <span class="text-muted">الفيديوهات</span>
{{--                                        <span class="warning float-right"><i class="ft-arrow-up warning"></i> 43.84%</span>--}}
                                    </div>
                                </div>
{{--                                <div class="progress mb-0" style="height: 7px;">--}}
{{--                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Sales stats -->

@endsection
