<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>{{$page_title}} | {{$site_title}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="alternate icon" type="image/png" href="/favicon.png">
    <style>
        loading>div {
            text-align: center;
        }

        loading p {
            font-weight: 300;
        }

        loading {
            display: flex;
            z-index: 999;
            position: fixed;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            justify-content: center;
            align-items: center;
            background: #f5f5f5;
            transition: .2s ease-out .0s;
            opacity: 1;
        }

        .lds-ellipsis {
            display: inline-block;
            position: relative;
            width: 64px;
            height: 64px;
        }

        .lds-ellipsis div {
            position: absolute;
            top: 27px;
            width: 11px;
            height: 11px;
            border-radius: 50%;
            background: rgba(0, 0, 0, .54);
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }

        .lds-ellipsis div:nth-child(1) {
            left: 6px;
            animation: lds-ellipsis1 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(2) {
            left: 6px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(3) {
            left: 26px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(4) {
            left: 45px;
            animation: lds-ellipsis3 0.6s infinite;
        }

        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }
            100% {
                transform: scale(1);
            }
        }

        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(0);
            }
        }

        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(19px, 0);
            }
        }
    </style>
</head>
<body class="mdui-drawer-body-left mdui-appbar-with-toolbar mdui-theme-primary-red mdui-theme-accent-pink page">
    <loading>
        <div>
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <p>正在加载中</p>
        </div>
    </loading>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/static/fonts/Roboto/roboto.css">
    <link rel="stylesheet" href="/static/fonts/Montserrat/montserrat.css">
    {{-- <link rel="stylesheet" href="/static/css/bootstrap-material-design.min.css"> --}}
    {{-- <link rel="stylesheet" href="/static/css/wemd-color-scheme.css"> --}}
    <link rel="stylesheet" href="/static/css/animate.min.css">
    <link rel="stylesheet" href="/static/mdui/css/mdui.min.css">
    <link rel="stylesheet" href="/static/fonts/MDI-WXSS/MDI.css">
    <link rel="stylesheet" href="/static/fonts/Devicon/devicon.css">
    {{-- <div class="mundb-background-container">
        <img src="">
    </div> --}}
    <header class="mdui-appbar navbar-app mdui-appbar-fixed mdui-appbar-scroll-hide">
        <div class="mdui-toolbar mdui-color-theme">
        <a href="javascript:;" class="mdui-btn mdui-btn-icon" mdui-drawer="{target: '#drawer'}"><i class="mdui-icon material-icons">menu</i></a>
        <a class="mdui-typo-headline" href="/">
            <img src="/static/img/logo.png" height="30"> 记恋
        </a>
        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> --}}
        <a href="" class="mdui-typo-title">{{ $page_title }}</a>
        <div class="mdui-toolbar-spacer"></div>
        @guest
        <a href="/login" class="mdui-btn">登录</a>
        @else
        <div class="mdui-textfield mdui-textfield-expandable mdui-float-right">
            <button class="mdui-textfield-icon mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></button>
            <input class="mdui-textfield-input" type="text" placeholder="Search"/>
            <button class="mdui-textfield-close mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">close</i></button>
        </div>
        <a href="javascript:;" class="mdui-fab-mini">
        <avatar style="height:100%">
                <img src="https://pbs.twimg.com/profile_images/1038959697833779201/R3fnbkfD_400x400.jpg" alt="avatar">
        </avatar>
        </a>


        {{-- TODO
        添加一个临时的logout
        后期转移到头像下拉栏中 --}}
        <a  class="dropdown-item text-danger"
        href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <i class="MDI exit-to-app text-danger"></i> {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>


        @endguest
        {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item />">
                    <a class="nav-link @if ($navigation === "Home") active @endif" href="/">首页 <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav mundb-nav-right">
                <li class="nav-item mundb-no-shrink />">
                @guest
                <a class="nav-link @if ($navigation === "Account") active @endif" href="/account">登录</a>
                @else
                <li class="nav-item dropdown mundb-btn-ucenter">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()["name"] }}</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header"><div><h6>{{ Auth::user()["name"] }}<br/><small>{{ Auth::user()->sid }}</small></h6></div></div>
                        <div class="dropdown-divider"></div>
                        <a  class="dropdown-item text-danger"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="MDI exit-to-app text-danger"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest --}}
                    <script>
                        window.addEventListener("load", function () {
                        $('.dropdown-header').click(function (e) {
                            e.stopPropagation();
                            });
                        }, false);
                    </script>
                </li>
            </ul>
        </div>
    </div>
    </header>
    <div class="mdui-drawer " id="drawer">
            <ul class="mdui-list">
              <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">move_to_inbox</i>
                <div class="mdui-list-item-content">圈子</div>
              </li>
              <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">star</i>
                <div class="mdui-list-item-content">回忆宝箱</div>
              </li>
              <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">send</i>
                <div class="mdui-list-item-content">打卡</div>
              </li>
              <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">drafts</i>
                <div class="mdui-list-item-content">日常</div>
              </li>
              <li class="mdui-subheader">发现</li>
              <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">email</i>
                    <div class="mdui-list-item-content">趋势</div>
                </li>
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">email</i>
                    <div class="mdui-list-item-content">绑定对方</div>
                </li>
                <li class="mdui-subheader">账户</li>
              <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">email</i>
                <div class="mdui-list-item-content">我</div>
              </li>
              <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">about</i>
                <div class="mdui-list-item-content">关于</div>
              </li>
            </ul>
    </div>
    @yield('template')
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
    <div class="mdui-bottom-nav mdui-bottom-nav-text-auto mdui-color-blue-grey mundb-footer">
    {{-- <footer class="  d-print-none footer-app"> --}}
        <p>&copy;2019 记恋</p>
    {{-- </footer> --}}
    </div>
    <script src="/static/library/jquery/dist/jquery.min.js"></script>
    {{-- <script src="/static/js/popper.min.js"></script>
    <script src="/static/js/snackbar.min.js"></script>
    <script src="/static/js/bootstrap-material-design.js"></script> --}}
    <script src="/static/mdui/js/mdui.min.js"></script>
    <script>
            window.addEventListener("load",function() {
                $('loading').css({"opacity":"0","pointer-events":"none"});
                mdui.mutation()
            }, false);
    </script>
</body>
</html>
