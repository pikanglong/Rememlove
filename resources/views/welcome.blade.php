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
    margin: auto;
    width: 20rem;
    margin-bottom: 2rem;
}
.reg-form{
    margin: 0;
}
</style>

<div class="container-fluid mundb-standard-container">
    <div class="row">
        <div class="col-12 col-md-6">
        <div class="main-left text-center">
            <h1 style="color:#ff4081;padding:20px;display:inline-block;">记恋</h1>
            <h4>记录恋爱每一步</h4>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card reg-card justify-content-sm-center animated bounceInRight">
                <div class="card-header text-center">
                    <h5>现在就加入吧！</h5>
                </div>
                <form class="reg-form needs-validation" method="POST" action="{{ route('register') }}" id="register_form" novalidate>
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email" class="bmd-label-floating">昵称</label>
                                <input type="email" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="register_nick_name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email" class="bmd-label-floating">电子邮件地址</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="register_email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password" class="bmd-label-floating">密码</label>
                                <input type="password" name="password" class="form-control" id="register_password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label for="agreement">
                                        <input class="form-control" type="checkbox" name="agreement" id="agreement" required="">
                                        <span class="checkbox-decorator">
                                            <span class="check"></span>
                                            <div class="ripple-container"></div>
                                        </span>
                                        <span>我已阅读并同意隐私条款和服务条款</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-outline-danger">注册</button>
                        <p>已有账号？</p><button type="submit" class="btn btn-outline-success">马上登录</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
