<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">

  @if(App::isLocale('ar'))
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
 <link rel="stylesheet" href="{{asset('/dist/css/adminlte.ar.css')}}">
  @endif
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

@notifyCss
 
  <link rel="stylesheet" href="{{asset('/plugins/datatables/jquery.dataTables.css')}}">


 <style>
   
   nav{
        z-index: 0 !important;
    position: relative !important;
   }

   .relative {
        z-index: 1 !important;
    position: relative !important;
   }

 </style>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
