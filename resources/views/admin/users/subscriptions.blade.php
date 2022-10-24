@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.users')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('users.index')}}"> @lang('admin.users')</a>
                    </li>
                    <li class="breadcrumb-item active">  @lang('admin.mySubscription')
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <section id="horizontal-form-layouts">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <table class="table table-striped table-bordered table-hover w-100 dataTables_wrapper">
                        <tr>
                            <th>اليوم </th>
                            @foreach($foodTypes as $foodType)
                            <th>{{\App\Models\FoodType::find($foodType)->name}} </th>
                            @endforeach

                        </tr>
                        @foreach($array as $key=>$value)


                            <tr>
                                @php $day = explode('/', $key); @endphp
                                <td>{{$day[1]}} </br> {{$day[2]}}</td>
                                @foreach($value as $v)
                                    <td>{{\App\Models\Food::find($v[0])->name}}</td>
                                @endforeach


                            </tr>
                        @endforeach

</table>
                </div>
            </div>
        </div>
    </section>
@endsection
