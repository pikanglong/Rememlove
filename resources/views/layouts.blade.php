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
    <link rel="manifest" href="/manifest.json" />
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
<body class="@auth mdui-drawer-body-left @endauth mdui-appbar-with-toolbar mdui-theme-primary-red mdui-theme-accent-pink page">
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
    <link rel="stylesheet" href="/static/css/animate.min.css">
    <link rel="stylesheet" href="/static/mdui/css/mdui.min.css">
    <link rel="stylesheet" href="/static/fonts/MDI-WXSS/MDI.css">
    <link rel="stylesheet" href="/static/fonts/Devicon/devicon.css">
    <header class="mdui-appbar navbar-app mdui-appbar-fixed mdui-appbar-scroll-hide">
        <div class="mdui-toolbar mdui-color-theme">
            @auth
                <a href="javascript:;" class="mdui-btn mdui-btn-icon" mdui-drawer="{target: '#drawer'}"><i class="mdui-icon material-icons">menu</i></a>
            @endauth
        <a class="mdui-typo-headline" href="/">
            <img src="/static/img/logo.png" height="30"> 记恋
        </a>
        <a href="" class="mdui-typo-title">{{ $page_title }}</a>
        <div class="mdui-toolbar-spacer"></div>
        @guest
        <a href="/login" class="mdui-btn">登录</a>
        @else
        {{-- <div class="mdui-textfield mdui-textfield-expandable mdui-float-right">
            <button class="mdui-textfield-icon mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">search</i></button>
            <input class="mdui-textfield-input" type="text" placeholder="Search"/>
            <button class="mdui-textfield-close mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">close</i></button>
        </div> {{ Auth::user()->avatar }} --}}
                <a class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-menu="{target: '#ucenter'}">
                    <avatar style="width:100%;height: 100%">
                        <img src="{{ asset(Auth::user()->avatar) }}" alt="avatar">
                    </avatar>
                </a>

                    <ul class="mdui-menu" id="ucenter">
                        <li class="mdui-menu-item" disabled>
                            <a class="mdui-ripple">{{Auth::user()["name"]}}</a>
                        </li>
                        <li class="mdui-divider"></li>
                        <li class="mdui-menu-item">
                            <a  class="mdui-ripple"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="mdui-icon material-icons">exit_to_app</i> 退出登录
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>

        @endguest
                <script>
                    window.addEventListener("load", function () {
                        $('.dropdown-header').click(function (e) {
                            e.stopPropagation();
                        });
                    }, false);
                </script>
        </div>
    </header>
    @auth
    <div class="mdui-drawer" id="drawer">
            <ul class="mdui-list">
              <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">move_to_inbox</i>
                <a class="mdui-list-item-content" href="/membox/square">广场</a>
              </li>
              <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">book</i>
                <a class="mdui-list-item-content" href="/membox/index">回忆宝箱</a>
              </li>
              <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">send</i>
                <a class="mdui-list-item-content" href="/checkin/">打卡</a>
              </li>

              <li class="mdui-subheader">发现</li>
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">adjust</i>
                    <a class="mdui-list-item-content" href="/binding/index">绑定</a>
                </li>
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">message</i>
                    <a class="mdui-list-item-content" href="/message/index">消息</a>
                </li>
                <li class="mdui-subheader">账户</li>
              <li class="mdui-list-item mdui-ripple">
                <i class="mdui-list-item-icon mdui-icon material-icons">account_circle</i>
                <a class="mdui-list-item-content" href="/account/dashboard">我</a>
              </li>
            </ul>
    </div>
    @endauth
    @yield('template')
    <div id="fullview" class="hide">
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
