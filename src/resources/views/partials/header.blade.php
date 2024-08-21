<!doctype html>
<html lang="uk" data-bs-theme="dark" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{\Illuminate\Support\Facades\Vite::asset("resources/images/favicon/favicon.png")}}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{$title ?? "Fast Realtor"}}</title>
</head>
<body>
<div id="app">

