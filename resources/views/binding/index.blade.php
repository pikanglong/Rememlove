@extends('layouts')

@section('template')
    <div class="mdui-container mundb-standard-container">
        <div class="mdui-row" style="margin-top: 80px">
            <div class="mdui-col-xs-12 mdui-col-sm-1 mdui-col-md-2"></div>
            <div class="mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-8 mdui-textfield mdui-textfield-floating-label mdui-textfield-not-empty">
                <label class="mdui-textfield-label">用户绑定邮箱或昵称</label>
                <input class="mdui-textfield-input" id="account-search" type="text">
            </div>
        </div>
        <div class="mdui-row">
            <div class="mdui-col-xs-12 mdui-col-sm-1 mdui-col-md-2"></div>
            <div class="mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-8">
                <ul class="mdui-list">
                    <li class="mdui-list-item mdui-ripple">
                        <div class="mdui-list-item-avatar"><img src="avatar1.jpg"/></div>
                        <div class="mdui-list-item-content">
                            <div class="mdui-list-item-title">SomeOne</div>
                            <div class="mdui-list-item-text mdui-list-item-one-line">男 24岁 南京</div>
                        </div>
                    </li>
                    <li class="mdui-list-item mdui-ripple">
                        <div class="mdui-list-item-avatar"><img src="avatar1.jpg"/></div>
                        <div class="mdui-list-item-content">
                            <div class="mdui-list-item-title">SomeOne</div>
                            <div class="mdui-list-item-text mdui-list-item-one-line">男 24岁 南京</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
