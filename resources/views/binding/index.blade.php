@extends('layouts')

@section('template')
    @if(!$binding_id)
    <div class="mdui-container mundb-standard-container">
        <div class="mdui-row" style="padding-top: 5rem;">
            <div class="mdui-col-xs-12 mdui-col-sm-1 mdui-col-md-2"></div>
            <div class="mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-8 mdui-typo-headline-opacity mdui-text-center">
                还没有绑定Ta哦
            </div>
        </div>

        <div class="mdui-panel" style="margin-top: 6rem;" mdui-panel>
            <span class="mdui-typo-caption-opacity mdui-p-b-1">现在就绑一个开始发粮食吧 : </span>
            <div class="mdui-panel-item">
                <div class="mdui-panel-item-header">
                    通过邀请码
                    <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                </div>
                <div class="mdui-panel-item-body">
                    <span class="mdui-typo-caption-opacity">我的邀请码:</span>
                    <div class="mdui-row">
                        <div class="mdui-col-xs-12 mdui-col-sm-2 mdui-col-md-4"></div>
                        <div class="mdui-col-xs-12 mdui-col-sm-8 mdui-col-md-4">
                            <img src="{{ $invite_QRcode ?? '' }}">
                        </div>
                    </div>
                    <div class="mdui-row">
                        <div class="mdui-col-xs-12 mdui-col-sm-2 mdui-col-md-4"></div>
                        <div class="mdui-col-xs-12 mdui-col-sm-8 mdui-col-md-4">
                            <span id="invite-code-display" class="mdui-textfield-input mdui-text-center mdui-typo-body-2">{{ $invite_code ?? '' }}</span>
                            <br>
                        </div>
                    </div>
                    <div class="mdui-row">
                        <div class="mdui-col-xs-12 mdui-col-sm-2 mdui-col-md-4"></div>
                        <div class="mdui-col-xs-12 mdui-col-sm-8 mdui-col-md-4">
                            <button id="invite-code-new" class="mdui-btn mdui-btn-block mdui-color-theme-accent">点击刷新邀请码</button>
                        </div>
                    </div>
                    <br>
                    <form id="invite-code-form" method="POST">
                        <div class="mdui-textfield mdui-textfield-floating-label">
                            <label class="mdui-textfield-label">Ta的邀请码</label>
                            <input id="invite-code" class="mdui-textfield-input" type="text" required/>
                            <div class="mdui-textfield-error">邀请码不能为空</div>
                        </div>

                        <div class="mdui-text-center">
                            <button type="submit" class="mdui-btn mdui-btn-raised mdui-color-theme-accent">提交</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mdui-panel-item">
                <div class="mdui-panel-item-header">
                    通过搜索用户以发送邀请
                    <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                </div>
                <div class="mdui-panel-item-body">
                    <div class="mdui-row">
                        <div class="mdui-col-xs-12 mdui-col-sm-1 mdui-col-md-2"></div>
                        <div class="mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-8 mdui-textfield mdui-textfield-floating-label mdui-textfield-not-empty">
                            <form id="search-user-form" action="post">
                                <label class="mdui-textfield-label">通过邮箱或用户名搜索用户</label>
                                <input class="mdui-textfield-input" id="account-search" type="text">
                            </form>
                        </div>-
                    </div>
                    <div class="mdui-row">
                        <div class="mdui-col-xs-12 mdui-col-sm-1 mdui-col-md-2"></div>
                        <div class="mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-8">
                            <ul class="mdui-list" id="search-result-list">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            window.addEventListener("load",function() {
                $('#search-user-form').on('submit',function(e){
                    e.preventDefault();
                    var search_key = $('#account-search').val();
                    if(search_key == ''){
                        mdui.alert('搜索关键词不能为空哦','注意',function(){},{
                            confirmText : '我知道了'
                        });
                        return;
                    }
                    $('#search-result-list').html('');
                    $.ajax({
                        url : '{{ route("binding_searchUser") }}',
                        type : 'POST',
                        data : {
                            search_key : search_key
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success : function(result){
                            if(result.ret == 200){
                                result.data.forEach(user => {
                                    $('#search-result-list').append(`
                                        <li class="mdui-list-item mdui-ripple user-item" data-user-id="${user.id}">
                                        <div class="mdui-list-item-avatar"><img src="${user.avatar}"/></div>
                                        <div class="mdui-list-item-content">
                                            <div class="mdui-list-item-title">${user.name}</div>
                                            <div class="mdui-list-item-text mdui-list-item-one-line">${user.email}</div>
                                        </div>
                                    </li>
                                    `);
                                });

                                $('.user-item').on('click',function(){
                                    var user_id = $(this).data('user-id');
                                    $.ajax({
                                        url : '{{ route("binding_sendInvite") }}',
                                        type : 'POST',
                                        data : {
                                            user_id : user_id,
                                        },
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success : function(result){
                                            if(result.ret == 200){
                                                mdui.alert('邀请消息已成功发送给对方','成功',function(){},{
                                                    confirmText : '太棒了'
                                                });
                                            }else{
                                                mdui.alert(result.desc,'注意',function(){},{
                                                    confirmText : '我知道了'
                                                });
                                            }
                                        }
                                    });
                                });
                            }else{
                                mdui.alert(result.desc,'注意',function(){},{
                                    confirmText : '我知道了'
                                });
                            }
                        }
                    });
                });

                $('#invite-code-form').on('submit',function(e){
                    e.preventDefault();
                    var invite_code = $('#invite-code').val();
                    $.ajax({
                        url : '{{ route("binding_queryCode") }}',
                        type : 'POST',
                        data : {
                            invite_code : invite_code
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success : function(result){
                            if(result.ret == 200){
                                window.location = result.data;
                            }else{
                                mdui.alert(result.desc,'注意',function(){},{
                                    confirmText : '我知道了'
                                });
                            }
                        }
                    });
                });

                $('#invite-code-new').on('click',function(){
                    $.ajax({
                        url : '{{ route("binding_newInviteCode") }}',
                        type : 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success : function(result){
                            if(result.ret == 200){
                                $('#invite-code-display').text(result.data)
                            }
                        }
                    });
                });
            }, false);
        </script>
    </div>
    @else
    <div class="mdui-container mundb-standard-container">
        <div class="mdui-card mdui-center mdui-m-a-3 mdui-text-center">
            <div class="mdui-row mdui-grid-list mdui-p-a-3">
                <div class="mdui-col-xs-6">
                    <div class="mdui-grid-tile" style="padding:2rem;">
                    <avatar>
                        <img src="{{asset($user->avatar)}}" style="width:10rem;height:10rem;display:inline-block;" class="mdui-img-circle" alt="avatar">
                        <div class="mdui-typo-display-1 mdui-m-t-3">{{$user->name}}</div>
                    </avatar>
                    </div>
                </div>
                <div class="mdui-col-xs-6">
                    <div class="mdui-grid-tile" style="padding:2rem;">
                    <avatar>
                        <img src="{{asset($user_object->avatar)}}" style="width:10rem;height:10rem;display:inline-block;" class="mdui-img-circle" alt="avatar">
                        <div class="mdui-typo-display-1 mdui-m-t-3">{{$user_object->name}}</div>
                    </avatar>
                    </div>
                </div>
            </div>
            <div class="mdui-typo-headline-opacity mdui-m-a-3 mdui-text-center">在一起已经 {{$day_together}} 天啦</div>
        </div>
    </div>
    @endif
@endsection
