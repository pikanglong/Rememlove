@extends('layouts')

@section('template')

<style>
    .cardsize{
        width: 25rem;
        justify-content: center;
        margin: auto;
    }
    .mdui-textfield-input:focus,
    .mdui-textfield-input:hover {
        border-bottom-width: 2px;
    }

    form .mdui-textfield:last-of-type {
        margin-bottom: 0;
    }

    .alert>p {
        margin-bottom: 0;
    }

    .card {
        margin-bottom: 20vh;
        overflow: hidden;
        display: block;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 30px;
        border-radius: 4px;
        transition: .2s ease-out .0s;
        color: #7a8e97;
        background: #fff;
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.15);
    }

    .card .card-header {
        padding: 0;
    }

    .card .card-header>ul {
        margin: 0;
    }

    .card .card-header>ul .nav-link {
        padding: 1rem;
        border: none!important;
    }

    .card .card-header .nav-tabs .nav-link.active {
        color: #ff4081;
    }

    .nav-tabs-material .nav-tabs-indicator {
        background-color: #ff4081;
        bottom: -1px;
        display: block;
        width: 50%;
        height: .15rem;
        position: absolute;
        transition: .2s ease-out .0s;
    }

    #accountTab {
        position: relative;
    }

    .card-footer {
        border: none;
    }

    .checkbox {
        margin-top: 1rem;
    }

    form {
        margin-bottom: 0;
    }

    input {
        box-shadow: none!important;
    }

    .was-validated input[type="checkbox"].mdui-textfield-input:invalid+span+span {
        color: #f44336!important;
    }

    label[for="agreement"] {
        display: inline-block;
    }
</style>

<div class="mdui-container mundb-standard-container">
    <div class="cardsize">
            <div class="mdui-text-center" style="margin-top:10vh;margin-bottom:20px;">
                <div class="mdui-typo-display-3" style="color:#ff4081;padding:20px;display:inline-block;">「记恋」</div>
                <div class="mdui-typo-display-1-opacity">记录恋爱每一步</div>
            </div>
            <div class="mdui-card @if($errors !== [] )animated shake @endif">
                <form class="needs-validation" action="{{ route('login') }}" method="post" id="login_form" novalidate>
                    @csrf
                    <div class="mdui-card-content">
                        <div class="mdui-textfield">
                            <label for="email" class="mdui-textfield-label">电子邮件地址</label>
                            <input type="email" name="email" class="mdui-textfield-input{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" id="email" required>
                            @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                            @endif
                            </div>
                                <div class="mdui-textfield">
                                    <label for="password" class="mdui-textfield-label">密码</label>
                                    <input type="password" name="password" class="mdui-textfield-input{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="mdui-card-actions mdui-text-right">
                                <div class="mdui-typo mdui-float-left mdui-m-l-3">
                                    <p><a href="{{ route('password.request') }}">忘记密码</a></p>
                                </div>
                                <button type="submit" class="mdui-fab mdui-ripple mdui-color-theme-accent" style="top:2rem;z-index:10">
                                    <i class="mdui-icon material-icons">chevron_right</i>
                                </button>
                            </div>
                        </form>
                        <div class="mdui-card-actions mdui-typo mdui-text-center card-buttom mdui-p-b-0">
                            <p>还没有账号？<a href="/login">马上注册</a></p>
                        </div>
                    </div>
                </div>
            </div>
</div>
<script>
    window.addEventListener("load",function() {
        $('loading').css({"opacity":"0","pointer-events":"none"});

        $('#login-tab').on('click', function (e) {
            e.preventDefault();
        })
        $('#register-tab').on('click', function (e) {
            e.preventDefault();
            location.href="/register";
        })

        $('input:-webkit-autofill').each(function(){
            if ($(this).val().length !== "") {
                console.log($(this).siblings('label'));
                $(this).siblings('label').addClass('active');
                $(this).parent().addClass('is-filled');
            }
        });

    }, false);

</script>

@endsection
