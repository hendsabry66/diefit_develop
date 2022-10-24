@extends('admin.layouts.master')
@section('breadcrumb')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <h3 class="content-header-title mb-0 d-inline-block"> @lang('admin.teamMembers')</h3>
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}"> @lang('admin.dashboard')</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('teamMembers.index')}}"> @lang('admin.teamMembers')</a>
                    </li>
                    <li class="breadcrumb-item active">  @lang('admin.addTeamMembers')
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <section id="horizontal-form-layouts">
        <div class="row match-height">
            <div class=" col-sm-12">
                <div class="card" style="height: 399.797px;">
                    <div class="card-content">
                        <div class="card-body">
                            @if(!empty($teamMember->image))
                                <img class=" img-fluid mb-1" width="100" src="{{$teamMember->image}}" alt="Card image cap">
                            @endif
                            <h4 class="card-title"># {{$teamMember->id}} </h4>
                            <p><span>@lang('admin.name') :- </span> {{ $teamMember->getTranslations('name')['ar'] }} - {{ $teamMember->getTranslations('name')['en'] }}</p>
                            <p class="card-text"><span>@lang('admin.details_ar')</span>{!!  $teamMember->getTranslations('details')['ar'] !!}</p>
                            <p class="card-text"><span>@lang('admin.details_en')</span>{!!  $teamMember->getTranslations('details')['en'] !!}</p>

                            <a href="{{route('teamMembers.edit',$teamMember->id)}}" class="btn btn-outline-teal">@lang('admin.edit')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

@endsection
