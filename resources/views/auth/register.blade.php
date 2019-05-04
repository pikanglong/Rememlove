@extends('layouts')

@section('template')

<style>
    .form-control:focus,
    .form-control:hover {
        border-bottom-width: 2px;
    }

    form .form-group:last-of-type {
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

    .was-validated input[type="checkbox"].form-control:invalid+span+span {
        color: #f44336!important;
    }

    label[for="agreement"] {
        display: inline-block;
    }
</style>
<div class="container mundb-standard-container">
    <div class="row justify-content-sm-center">
        <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="text-center" style="margin-top:10vh;margin-bottom:20px;">
                <h1 style="padding:20px;display:inline-block;">记恋</h1>
                <p>记录恋爱每一步</p>
            </div>
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs nav-justified nav-tabs-material" id="accountTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="false">登录</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="register-tab" data-toggle="tab" role="tab" aria-controls="register" aria-selected="true">注册</a>
                        </li>
                        <div class="nav-tabs-indicator" id="nav-tabs-indicator" style="left: 50%;"></div>
                    </ul>
                </div>
                <div class="tab-content" id="accountTabContent">
                    <div class="tab-pane fade show active" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <form class="needs-validation" method="POST" action="{{ route('register') }}" id="register_form" novalidate>
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="email" class="mdui-textfield-label">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="mdui-textfield-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="mdui-textfield-label">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="mdui-textfield-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="mdui-textfield-label">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="mdui-textfield-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="mdui-textfield-label">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="mdui-textfield-input" name="password_confirmation" required autocomplete="new-password">
                                </div>
                                <div class="mdui-typo-caption-opacity mdui-m-b-3">注册即代表已阅读并同意隐私条款和服务条款</div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-danger">注册</button>
                            </div>
                        </form>
                    </div>
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
            location.href="/login";
        })
        $('#register-tab').on('click', function (e) {
            e.preventDefault();
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
