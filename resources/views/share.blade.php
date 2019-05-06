@extends('layouts')

@section('template')
    <div class="mdui-container">
        <div class="mdui-row">
            <div class="mdui-col-xs-12 mdui-col-sm-1 mdui-col-md-2"></div>
            <div class="mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-8">
                <div class="mdui-card" style="margin-top:8px; margin-bottom:8px">
                    <div class="mdui-card-header mdui-p-a-1">
                        <img class="mdui-card-header-avatar" src="{{asset($m->user->avatar)}}"/>
                        <div class="mdui-card-header-title">{{$m -> user->name}}</div>
                        <div class="mdui-card-header-subtitle">{{$m -> created_at}}
                            @if(strtotime($m -> new_time_see) >= time())
                                <i class="MDI clock"></i>{{$m -> time_see_remained}}对方可见
                            @endif
                        </div>
                    </div>
                    <div class="mdui-card-content mdui-p-l-1 mdui-p-t-0 mdui-p-b-0">
                        {{$m -> contents}}
                    </div>
                    <div class="mdui-card-media mdui-p-l-1 mdui-m-b-3 mdui-p-r-1">
                        <div class="mdui-row">
                            @foreach($m->pic as $p)
                                <div class="mdui-col-sm-4 mdui-p-a-1" onclick="show('{{asset('static/img/membox/'.$p) }}');">
                                    <img class="app-pic mdui-img-fluid mdui-img-rounded" src="{{asset('static/img/membox/'.$p) }}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mdui-card-actions card-buttom">
                        <div class="mdui-chip">
                            <span class="mdui-chip-icon"><i class="MDI heart"></i></span>
                            <span class="mdui-chip-title">喜欢</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection