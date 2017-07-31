<?php

if (!isset(Auth::user()->name)) {
    header("Location:/");
}
?>

<link rel="stylesheet" href="{{ URL::asset('css/tinycarousel.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/jquery.simpleLens.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/jquery.simpleGallery.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('css/layout.css') }}" />

<link rel="stylesheet" href="{{ URL::asset('css/reponsive.css') }}" />