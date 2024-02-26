@extends('restaurant/layouts/resturant_layout')

@section('content')
<h2>Menu items: <span>{{$resturantStatistic->count_menu_items}}/{{$limits->max_menu_items}}</span></h2>
<h2>Media: <span>{{$resturantStatistic->count_media}}/{{$limits->max_media}}</span></h2>
<h2>Qrcode Scans: <span>{{$resturantStatistic->count_scans}}/{{$limits->max_scans}}</span></h2>

@endsection
