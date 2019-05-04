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
                            <div class="mdui-col-sm-4 mdui-p-a-1">
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
</div>
<div id="aa" class="hide" style="background-color:bisque">

</div>
<script>
    function show(){
        $('#aaa').addClass('blur');
        $('#aa').removeClass('hide');
        $('#aa').addClass('showdiv animated bounceInRight');
        console.log('aaa');
    }
</script>
@endsection