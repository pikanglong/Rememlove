@extends('layouts')

@section('template')
<div id="aaa" class="mdui-container-fluid mundb-standard-container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h3 class="mdui-text-center">美好回忆</h3>
    <div class="mdui-row mdui-justify-content-center">
        <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-4 mdui-col-lg-3 mdui-col-xl-2">
            <div class="mdui-card">
                <div class="mdui-card-header mdui-p-a-1">
                    <img class="mdui-card-header-avatar" src="https://pbs.twimg.com/profile_images/1038959697833779201/R3fnbkfD_400x400.jpg"/>
                    <div class="mdui-card-header-title">User Name</div>
                    <div class="mdui-card-header-subtitle">2019年5月4日 China <i class="MDI clock"></i>3天后对方可见</div>
                </div>
                <div class="mdui-card-content mdui-p-l-1 mdui-p-t-0 mdui-p-b-0">
                    好！
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
            </div>
        </div>
    </div>
<div class="mdui-fab-wrapper" id="exampleFab" mdui-fab="{trigger: 'hover'}">
        <button class="mdui-fab mdui-ripple mdui-color-theme-accent">
          <!-- 默认显示的图标 -->
          <i class="mdui-icon material-icons">add</i>

          <!-- 在拨号菜单开始打开时，平滑切换到该图标，若不需要切换图标，则可以省略该元素 -->
          <i class="mdui-icon mdui-fab-opened material-icons">add</i>
        </button>
        <div class="mdui-fab-dial">
          <button class="mdui-fab mdui-fab-mini mdui-ripple mdui-color-pink" onclick="{{ route('logout') }}"><i class="mdui-icon material-icons">backup</i></button>
          <button class="mdui-fab mdui-fab-mini mdui-ripple mdui-color-red"><i class="mdui-icon material-icons">bookmark</i></button>
          <button class="mdui-fab mdui-fab-mini mdui-ripple mdui-color-orange"><i class="mdui-icon material-icons">access_alarms</i></button>
          <button class="mdui-fab mdui-fab-mini mdui-ripple mdui-color-blue"><i class="mdui-icon material-icons">touch_app</i></button>
        </div>
</div>
<div id="pic_view" class="hide"><button class="mdui-btn mdui-btn-icon mdui-float-left mdui-color-theme" onclick="hide_pic_view();">
            <i class="mdui-icon material-icons">chevron_left</i>
        </button>
        <img class="app-pic mdui-img-fluid mdui-img-rounded" src="https://scontent-sin2-2.cdninstagram.com/vp/1f007179d5a5b56f03dc3eaa1288fd8d/5D5A80B1/t51.2885-15/sh0.08/e35/p640x640/58409400_2258306290894954_4539551133726795669_n.jpg?_nc_ht=scontent-sin2-2.cdninstagram.com" alt="">
</div>
<script>
    function show(){
        $('#fullview').removeClass('hide');
        $('#fullview').addClass('showdiv');
        $('#pic_view').removeClass('hide');
        $('#pic_view').addClass('showdiv2 animated slideInDown');
    }
    function hide_pic_view(){
        $('#fullview').removeClass('showdiv');
        $('#fullview').addClass('hide');
        $('#pic_view').addClass('hide');
        $('#pic_view').removeClass('showdiv2 animated slideInDown');
    }
</script>
@endsection
