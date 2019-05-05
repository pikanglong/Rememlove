@extends('layouts')

@section('template')
    <div class="mdui-container mundb-standard-container">
        <div class="mdui-m-a-5 mdui-text-center">
            <div class="mdui-card cardsize">
                <div class="mdui-center mdui-m-t-1" style="max-width: 10rem">
                    <avatar style="width:98%">
                        <img src="https://scontent-sin2-2.cdninstagram.com/vp/fbaa80544aa8e7be95668e1344fbb3b4/5D5E6E38/t51.2885-19/s320x320/54732379_639022049871378_1829252946760564736_n.jpg?_nc_ht=scontent-sin2-2.cdninstagram.com" alt="avatar">
                    </avatar>
                </div>
                <div class="mdui-typo-display-1 mdui-m-t-3">对方名字</div>
                <div class="mdui-typo-body-2-opacity">24岁 男 南京</div>
                <button class="mdui-center mdui-btn mdui-btn-raised mdui-color-theme mdui-m-a-5">绑定他</button>
                @guest
                    <div class="mdui-card-actions mdui-typo mdui-text-center card-buttom mdui-p-b-0">
                        <p>你需要「记恋」账号才能与他绑定 <a href="/register">马上注册</a></p>
                    </div>
                @endguest
            </div>
        </div>
    </div>
@endsection
