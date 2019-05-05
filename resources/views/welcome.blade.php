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
    .caption-data {
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 20;
    text-align: center;
}
.main-left{
    margin-top:20vh;
    margin-bottom: 2rem;
}
.reg-card{
    justify-content: center;
    width: 20rem;
    margin-bottom: 2rem;
}
.reg-form{
    margin: 0;
}
</style>
<div class="mdui-container-fluid mundb-standard-container">
    <div class="mdui-row">
        <div class="mdui-col-12 mdui-col-md-6">
        <div class="main-left mdui-text-center">
            <div class="mdui-typo-display-4" style="color:#ff4081;padding:20px;display:inline-block;">「记恋」</div>
            <div class="mdui-typo-display-2-opacity">记录恋爱每一步</div>
        </div>
        </div>
        <div class="mdui-col-12 mdui-col-md-6">
            <div id="card" class="mdui-card reg-card mdui-center">
                <div class="mdui-card-header mdui-text-center">
                    <h3>现在就加入吧！</h3>
                </div>
                <form class="mdui-m-a-3 needs-validation" method="POST" action="{{ route('register') }}" id="register_form" novalidate>
                    @csrf
                    <div class="mdui-card-body mdui-p-3">
                        <div class="mdui-textfield @error('name') mdui-textfield-invalid @enderror">
                            <label for="name" class="mdui-textfield-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="mdui-textfield-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <div class="mdui-textfield-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mdui-textfield @error('email') mdui-textfield-invalid @enderror">
                            <label for="email" class="mdui-textfield-label">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="mdui-textfield-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <div class="mdui-textfield-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mdui-textfield @error('password') mdui-textfield-invalid @enderror">
                            <label for="password" class="mdui-textfield-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="mdui-textfield-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <div class="mdui-textfield-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mdui-textfield">
                                <label for="password_confirmation" class="mdui-textfield-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="mdui-textfield-input" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="mdui-typo-caption-opacity mdui-m-b-3">注册即代表已阅读并同意隐私条款和服务条款</div>
                    </div>
                    <div class="mdui-text-center">
                        <button id="submit" type="submit" class="mdui-btn mdui-btn-raised mdui-color-theme-accent">注册</button>
                    </div>
                    </form>
                <div class="mdui-card-footer mdui-text-center card-buttom mdui-p-b-3">
                    <div class="mdui-typo-subheading-opacity mdui-m-a-3 mdui-p-t-3">已有账号？</div>
                    <button class="mdui-btn mdui-btn-raised mdui-color-theme" onclick="window.location.href='/login'">马上登录</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        window.addEventListener("load", function () {
            $('#card').addClass("animated fadeInDown")
        })
    </script>
@endsection
