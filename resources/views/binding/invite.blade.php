@extends('layouts')

@section('template')
    <div class="mdui-container mundb-standard-container">
        <div class="mdui-m-a-5 mdui-text-center" style="padding-top: 3rem;">
            @if($has_obeject)
                <i class="mdui-icon material-icons mdui-typo-display-1-opacity" style="font-size: 10rem">error_outline</i>
                <div class="mdui-typo-display-1-opacity mdui-m-t-3">你已经有绑定的对象了</div>
            @elseif(!$code_valid)
                <i class="mdui-icon material-icons mdui-typo-display-1-opacity" style="font-size: 10rem">error_outline</i>
                <div class="mdui-typo-display-1-opacity mdui-m-t-3">邀请码已失效</div>
            @elseif($oneself)
                <i class="mdui-icon material-icons mdui-typo-display-1-opacity" style="font-size: 10rem">error_outline</i>
                <div class="mdui-typo-display-1-opacity mdui-m-t-3">找到你的Ta再困难也不能和自己...哦</div>
            @else
                <div id="confirm-box">
                    <div class="mdui-center" style="max-width: 10rem">
                        <avatar style="width:98%">
                            <img src="{{asset($user->avatar)}}" alt="avatar">
                        </avatar>
                    </div>
                    <div class="mdui-typo-display-1 mdui-m-t-3">{{$user->name}}</div>
                    <div class="mdui-typo-body-2-opacity"><br />确认要与之绑定吗? 请慎重决定!</div>
                    @if(Auth::check())
                    <button id="confirm-invite" class="mdui-center mdui-btn mdui-btn-raised mdui-color-theme mdui-m-a-5">我十分十分十分地确定</button>
                    @endif
                    @guest
                    <div class="mdui-card-actions mdui-typo mdui-text-center card-buttom mdui-p-b-0">
                        <p>你需要「记恋」账号才能与他绑定 <a href="/register">马上注册</a></p>
                    </div>
                    @endguest
                </div>
                <div id="confirm-loading" class="mdui-spinner" style="width: 10rem; height: 10rem; display: none;"></div>
                <div id="confirm-result" style="display: none;">
                    <i class="mdui-icon material-icons mdui-text-color-green" style="font-size: 10rem">done</i>
                    <div class="mdui-typo-display-1 mdui-text-color-green mdui-m-t-3">绑定成功! 2 秒后返回</div>
                </div>
                <div id="confirm-error" style="display: none;">
                    <i class="mdui-icon material-icons mdui-typo-display-1-opacity" style="font-size: 10rem">error_outline</i>
                    <div id="error-reason"  class="mdui-typo-display-1-opacity mdui-m-t-3">邀请码已失效</div>
                </div>
            @endif

        </div>
    </div>
    <script>
        window.addEventListener("load",function() {
            $('#confirm-invite').on('click',function(){
                $('#confirm-box').hide();
                $('#confirm-loading').show();
                $.ajax({
                    url : '{{ route("binding_confirmInvite") }}',
                    type : 'POST',
                    data : {
                        invite_code : '{{ $invite_code }}',
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function(result){
                        $('#confirm-loading').hide();
                        if(result.ret == 200){
                            $('#confirm-result').show();
                        }else{
                            $('#error-reason').text(result.desc);
                            $('#confirm-error').show();
                        }
                        setTimeout(()=>{
                            window.location = '{{route('binding_index')}}';
                        },2000);
                    }
                });
            });
        }, false);
    </script>
@endsection
