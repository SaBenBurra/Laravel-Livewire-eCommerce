<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="{{asset('vendor/panel/css/fontawesome-all.min.css')}}"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('vendor/panel/css/sb-admin-2.min.css')}}"/>
    @yield('custom-css')

    <title>{{$title}}</title>

    @livewireStyles
</head>
<body id="page-top">