<!DOCTYPE html>
<html @if(App::getLocale() == 'ar') lang="ar" dir="rtl" @else lang="en" dir="ltr" @endif>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{asset('web/assets/images/Logo.png')}}">
    @if(App::getLocale() == 'en')
    <link rel="stylesheet" href="{{asset('web/assets/css/bootstrap.min.css')}}">
    @else
    <link rel="stylesheet" href="{{asset('web/assets/css/bootstrap.rtl.min.css')}}">
    @endif
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{asset('web/assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/css/style.css')}}">

    @if(App::getLocale() == 'en')
    <link rel="stylesheet" href="{{asset('web/assets/css/style.ltr.css')}}">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.34/sweetalert2.min.css">

    <title>
        {{settings()['site_name']}}
        @yield('title')
    </title>
</head>

<body id="body_site">
