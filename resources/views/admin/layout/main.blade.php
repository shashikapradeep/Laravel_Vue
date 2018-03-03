<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Module</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/admin/app.css">
</head>
<body>
@extends('admin.layout.header')
<div id="appAdmin">
    <ul class="nav nav-pills">
        <router-link tag="li" to="/admin/" exact>
            <a>Home</a>
        </router-link>

        <router-link tag="li" to="/admin/graph" exact>
            <a>Graph</a>
        </router-link>

        <router-link tag="li" to="/admin/about" exact>
            <a>About</a>
        </router-link>
    </ul>
    <br/>
    <router-view></router-view>
</div>
@extends('admin.layout.footer')

{{--<script src="/js/Admin/vendor.js"></script>--}}

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="/js/admin/app.js"></script>
</body>
</html>
