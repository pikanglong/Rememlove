@extends('layouts')

@section('template')
<div id="aaa" class="mdui-container-fluid mundb-standard-container">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <div class="mdui-row mdui-justify-content-center">
            <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-4 mdui-col-lg-3 mdui-col-xl-2">
                <div class="mdui-card" style="margin-top:8px; margin-bottom:8px">
                    <div class="mdui-card-content mdui-m-a-1 mdui-p-a-0">
                        <div class="mdui-card-header mdui-p-a-1">
                            <img class="mdui-card-header-avatar" src="{{asset(Auth::user()->avatar)}}"/>
                            <div class="mdui-card-header-title">{{Auth::user()->name}}</div>
                            <div class="mdui-card-header-subtitle">
                                <select id="time-view" class="mdui-select">
                                    <option value="1">对方直接可见</option>
                                    <option value="2">1小时后对方可见</option>
                                    <option value="3">6小时后对方可见</option>
                                    <option value="4">12小时后对方可见</option>
                                    <option value="5">1天后对方可见</option>
                                    <option value="6">私密</option>
                                </select>
                            </div>
                        </div>
                        <button class="mdui-fab mdui-float-right mdui-color-theme-accent" style="top: -3rem;" onclick="submitmem();">
                            <i class="mdui-icon material-icons">check</i>
                        </button>
                    </div>
                    <div class="mdui-card-content">
                        <div class="mdui-textfield">
                            <textarea id="mem-text" class="mdui-textfield-input" placeholder="今天有什么新鲜事？"></textarea>
                        </div>
                    </div>
                    <div class="mdui-card-media mdui-p-l-1">
                        <div id="pic-list" class="mdui-row-xs-3 mdui-row-sm-4 mdui-row-md-5 mdui-row-lg-6 mdui-row-xl-7 mdui-grid-list">
                            {{--                        <div class="mdui-col">--}}
                            {{--                            <div class="mdui-grid-tile">--}}
                            {{--                                <img class="app-pic mdui-img-fluid mdui-img-rounded" src="" alt="">--}}
                            {{--                            </div>--}}
                            {{--                        </div>--}}
                        </div>
                        <input type="file" style="display: none;" id="pic_upload" accept="image/*" ref="input" onchange="SelectedImg(this.files)" multiple>
                    </div>
                    <div class="mdui-card-actions ">
                        <button class="mdui-btn mdui-color-theme-accent " onclick="$('#pic_upload').click()">
                            <i class="mdui-icon material-icons">image</i>上传图片
                        </button>
                        <button class="mdui-btn mdui-ripple mdui-color-theme" mdui-dialog="{target: '#encrypt'}">设置密码</button>
                    </div>
                    <div class="mdui-dialog" id="encrypt">
                        <div class="mdui-dialog-title">加密你的美好回忆</div>
                        <div class="mdui-dialog-content">请输入密码和提示。
                            <div class="mdui-textfield">
                                <input name="mem-pass" id="mem-pass" type="text" class="mdui-textfield-input" placeholder="设置密令" >
                            </div>
                            <div class="mdui-textfield">
                                <input name="mem-pass-tip" id="mem-pass-tip" type="text" class="mdui-textfield-input" placeholder="密令提示" >
                            </div>
                        </div>
                        <div class="mdui-dialog-actions">
                            <button class="mdui-btn mdui-ripple">取消</button>
                            <button class="mdui-btn mdui-ripple">确定</button>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($membox as $m)
            <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-4 mdui-col-lg-3 mdui-col-xl-2">
                @if(strtotime($m -> new_time_see) < time() )
                <div class="mdui-card" style="margin-top:8px; margin-bottom:8px">
                    <div class="mdui-card-header mdui-p-a-1">
                        <img class="mdui-card-header-avatar" src=""/>
                        <div class="mdui-card-header-title">{{$m -> username}}</div>
                        <div class="mdui-card-header-subtitle">{{$m -> created_at}}</div>
                    </div>
                    <div class="mdui-card-content mdui-p-l-1 mdui-p-t-0 mdui-p-b-0">
                        {{$m -> contents}}
                    </div>
                    <div class="mdui-card-media mdui-p-l-1">
                        <div class="mdui-row">
                            <div class="mdui-col-sm-4 mdui-p-a-1" onclick="show();">
                                <img class="app-pic mdui-img-fluid mdui-img-rounded" src="https://scontent-sin2-2.cdninstagram.com/vp/1f007179d5a5b56f03dc3eaa1288fd8d/5D5A80B1/t51.2885-15/sh0.08/e35/p640x640/58409400_2258306290894954_4539551133726795669_n.jpg?_nc_ht=scontent-sin2-2.cdninstagram.com" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="mdui-card-actions card-buttom">
                        <div class="mdui-chip">
                            <span class="mdui-chip-icon"><i class="MDI heart"></i></span>
                            <span class="mdui-chip-title">喜欢</span>
                        </div>
                        <div class="mdui-chip">
                            <span class="mdui-chip-icon"><i class="MDI comment"></i></span>
                            <span class="mdui-chip-title">评论</span>
                        </div>
                        <div class="mdui-chip">
                            <span class="mdui-chip-icon"><i class="MDI share"></i></span>
                            <span class="mdui-chip-title">分享</span>
                        </div>
                        <button class="mdui-btn mdui-btn-icon mdui-float-right mdui-color-theme" onclick="show();">
                            <i class="mdui-icon material-icons">chevron_right</i>
                        </button>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
@endsection
