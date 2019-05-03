@extends('layouts')

@section('template')
<div class="container mundb-standard-container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h3 class="text-center">美好回忆</h3>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-head">
                    <div class="media">
                        <avatar style="height:2.5rem;">
                            <img src="https://pbs.twimg.com/profile_images/1038959697833779201/R3fnbkfD_400x400.jpg" alt="avatar">
                        </avatar>
                        <div class="media-body ml-2">
                            <strong>2019年5月3日</strong><br>
                            <small>China</small>
                        </div>
                        <div class="float-right">
                            <p class="text-info"><i class="MDI clock"></i>3天后对方可见</p>
                        </div>
                </div>
                </div>
                <div class="card-body p-3">
                    sdjfhadskjlgh adfkgj
                    <div class="row">
                        <div class="col-4 p-1">
                            <img class="app-pic" src="https://scontent-sin2-2.cdninstagram.com/vp/1f007179d5a5b56f03dc3eaa1288fd8d/5D5A80B1/t51.2885-15/sh0.08/e35/p640x640/58409400_2258306290894954_4539551133726795669_n.jpg?_nc_ht=scontent-sin2-2.cdninstagram.com" alt="">
                        </div>

                    </div>
                <div class="card-footer p-1">
                    <button type="button" class="float-right btn btn-primary bmd-btn-fab" style="top:-2.5rem">
                        <i class="MDI share"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-secondary" id="like" onclick=""><i class="MDI heart"></i>喜欢</button>
                    <button type="button" class="btn btn-sm btn-secondary" id="like" onclick=""><i class="MDI comment"></i>评论</button>
                    <p><a href="">某人：</a>adskfhj</p>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
