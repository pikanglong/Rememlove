@extends('layouts')

@section('template')

<link rel="stylesheet" href="/static/fonts/Raleway/raleway.css">

<style>
    paper-card {
        display: block;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 30px;
        border-radius: 4px;
        transition: .2s ease-out .0s;
        color: #7a8e97;
        background: #fff;
        padding: 1rem;
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.15);
        margin-bottom: 2rem;
    }

    paper-card:hover {
        box-shadow: rgba(0, 0, 0, 0.15) 0px 0px 40px;
    }

    a:hover{
        text-decoration: none!important;
    }

    h5{
        margin-bottom: 1rem;
        font-weight: bold;
    }

    .cm-progressbar-container{
        margin: 1rem 0;
    }

    .cm-countdown{
        font-family: 'Montserrat';
        font-size: 3rem;
        text-align: center;
        color: rgba(0, 0, 0, 0.42);
    }
</style>

<div class="container mundb-standard-container">
    <div class="row">
        这是未登录时的首页
    </div>
</div>

<script>
    window.addEventListener("load",function() {
        $('loading').css({"opacity":"0","pointer-events":"none"});
    }, false);
</script>

@endsection
