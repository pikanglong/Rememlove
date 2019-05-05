@extends('layouts')

@section('template')

<style>
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
                        <div class="mdui-textfield @error('email') mdui-textfield-invalid @enderror">
                            <label for="email" class="mdui-textfield-label">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="mdui-textfield-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="mdui-textfield-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mdui-textfield @error('password') mdui-textfield-invalid @enderror">
                            <label for="password" class="mdui-textfield-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="mdui-textfield-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="mdui-textfield-error">
                                    {{ $message }}
                                </div>
                            @enderror
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
                            <p>还没有账号？<a href="/register">马上注册</a></p>
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
