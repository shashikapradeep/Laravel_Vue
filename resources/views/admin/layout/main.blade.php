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

    <link rel="stylesheet" href="/css/admin/app.css">
</head>
<body>
@extends('admin.layout.header')
<div id="appAdmin">
    <router-link to="/admin/" exact>Home</router-link>
    <router-link to="/admin/about" exact>About</router-link>

    <router-view></router-view>
</div>
@extends('admin.layout.footer')

{{--<script src="/js/Admin/vendor.js"></script>--}}
<script src="/js/admin/app.js"></script>
</body>
</html>
