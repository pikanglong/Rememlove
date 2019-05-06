@extends('layouts')

@section('template')

<div id="aaa" class="mdui-container-fluid mundb-standard-container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div class="mdui-row mdui-justify-content-center">
        <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-4 mdui-col-lg-3 mdui-col-xl-2">
            <div class="mdui-card" style="margin-top:8px; margin-bottom:8px">
                <div class="mdui-card-content mdui-m-a-1 mdui-p-a-0">
                    <div class="mdui-card-header mdui-p-a-1">
                        <img class="mdui-card-header-avatar" src="{{asset(Auth::user()->avatar)}}"/>
                        <div class="mdui-card-header-title">{{Auth::user()->name}}</div>
                        <div class="mdui-card-header-subtitle">
                            <select id="time-view" class="mdui-select">
                                <option value="0">全站广场公开</option>
                                <option value="1">对方直接可见</option>
                                <option value="2">1小时后对方可见</option>
                                <option value="3">6小时后对方可见</option>
                                <option value="4">12小时后对方可见</option>
                                <option value="5">1天后对方可见</option>
                                <option value="6">私密</option>
                            </select>
                        </div>
                    </div>
                    <button class="mdui-fab mdui-float-right mdui-color-theme-accent" style="top: -3rem;" onclick="submitmem();">
                        <i class="mdui-icon material-icons">check</i>
                    </button>
                </div>
                <div class="mdui-card-content">
                    <div class="mdui-textfield">
                        <textarea id="mem-text" class="mdui-textfield-input" placeholder="今天有什么新鲜事？"></textarea>
                    </div>
                </div>
                <div class="mdui-card-media mdui-p-l-1">
                    <div id="pic-list" class="mdui-row-xs-3 mdui-row-sm-4 mdui-row-md-5 mdui-row-lg-6 mdui-row-xl-7 mdui-grid-list">
                        {{--                        <div class="mdui-col">--}}
                        {{--                            <div class="mdui-grid-tile">--}}
                        {{--                                <img class="app-pic mdui-img-fluid mdui-img-rounded" src="" alt="">--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                    <input type="file" style="display: none;" id="pic_upload" accept="image/*" ref="input" onchange="SelectedImg(this.files)" multiple>
                </div>
                <div class="mdui-card-actions ">
                    <button class="mdui-btn mdui-color-theme-accent " onclick="$('#pic_upload').click()">
                        <i class="mdui-icon material-icons">image</i>上传图片
                    </button>
                    <button class="mdui-btn mdui-ripple mdui-color-theme" mdui-dialog="{target: '#encrypt'}">设置密码</button>
                </div>
                <div class="mdui-dialog" id="encrypt">
                    <div class="mdui-dialog-title">加密你的美好回忆</div>
                    <div class="mdui-dialog-content">请输入密码和提示。
                        <div class="mdui-textfield">
                            <input name="mem-pass" id="mem-pass" type="text" class="mdui-textfield-input" placeholder="设置密令" >
                        </div>
                        <div class="mdui-textfield">
                            <input name="mem-pass-tip" id="mem-pass-tip" type="text" class="mdui-textfield-input" placeholder="密令提示" >
                        </div>
                    </div>
                    <div class="mdui-dialog-actions">
                        <button class="mdui-btn mdui-ripple">取消</button>
                        <button class="mdui-btn mdui-ripple">确定</button>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($membox as $m)
        @if($m -> uid == Auth::user() -> id || strtotime($m -> new_time_see) < time())
        <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-4 mdui-col-lg-3 mdui-col-xl-2">
            <div class="mdui-card" style="margin-top:8px; margin-bottom:8px">
                <div class="mdui-card-header mdui-p-a-1">
                    <img class="mdui-card-header-avatar" src="{{asset($m->user->avatar)}}"/>
                    <div class="mdui-card-header-title">{{$m -> user->name}}</div>
                    <div class="mdui-card-header-subtitle">{{$m -> created_at}}
                        @if(strtotime($m -> new_time_see) >= time())
                        <i class="MDI clock"></i>{{$m -> time_see_remained}}对方可见
                        @endif
                    </div>
                </div>
                <div class="mdui-card-content mdui-p-l-1 mdui-p-t-0 mdui-p-b-0">
                    {{$m -> contents}}
                </div>
                @if($m->pic_count > 0)
                <div class="mdui-card-media mdui-p-l-1 mdui-m-b-3 mdui-p-r-1">
                    <div class="mdui-row">
                        @foreach($m->pic as $p)
                        <div class="mdui-col-sm-4 mdui-p-a-1" onclick="show('{{asset('static/img/membox/'.$p) }}');">
                            <img class="app-pic mdui-img-fluid mdui-img-rounded" src="{{asset('static/img/membox/'.$p) }}" alt="">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="mdui-card-actions card-buttom">
                    {{-- <div class="mdui-chip">
                        <span class="mdui-chip-icon"><i class="MDI heart"></i></span>
                        <span class="mdui-chip-title">喜欢</span>
                    </div> --}}
                    {{-- <div class="mdui-chip">
                        <span class="mdui-chip-icon"><i class="MDI share"></i></span>
                        <span class="mdui-chip-title">分享</span>
                    </div> --}}
                    <button class="mdui-btn mdui-btn-icon mdui-float-right mdui-color-theme" onclick="show();">
                        <i class="mdui-icon material-icons">chevron_right</i>
                    </button>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
<script>
        function show(url){
            $('#fullview').removeClass('hide');
            $('#fullview').addClass('showdiv');
            $('#pic_view').removeClass('hide');
            $('#pic_view').addClass('showdiv2');
            $('#big_pic_view').attr("src",url);
        }
        function hide_pic_view(){
            $('#fullview').removeClass('showdiv');
            $('#fullview').addClass('hide');
            $('#pic_view').addClass('hide');
            $('#pic_view').removeClass('showdiv2');
        }
        const c = new FormData();
        let count = 0;
        function SelectedImg(file){
            $('#pic-list').html('');
            for(let f of file){
                new Compressor(f, { //使用compressor.js压缩图片
                    strict: true,
                    checkOrientation: true,
                    maxWidth: 3000,
                    maxHeight: 3000,
                    quality: 0.8,
                    success(result) {
                        let piclink = URL.createObjectURL(result);
                        let format = "<div class=\"mdui-col\">\n" +
                            "                            <div class=\"mdui-grid-tile\">\n" +
                            "                                <img class=\"app-pic mdui-img-fluid mdui-img-rounded\" src=\"" + piclink + "\" alt=\"\">\n" +
                            "                            </div>\n" +
                            "                        </div>";
                        $('#pic-list').append(format);
                        c.set('pic-'+ count, result, result.name); //设置本地压缩后的图片
                        count++;
                        console.log(c);
                    },
                    error(err) {
                        console.log(err.message);
                    },
                });
            }
        }
        function submitmem(){
            c.set('time',$('#time-view option:selected').index());
            c.set('text',$('#mem-text').val());
            c.set('password',$('#mem-pass').val());
            c.set('password-tip',$('#mem-pass-tip').val());
            c.set('pic-count', count);
            $.ajax({
                contentType: false,
                processData: false,
                url : '{{ route("membox_new") }}',
                type : 'POST',
                data: c,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : function(result){
                    mdui.alert("发布成功。", function(){
                        console.log(result);
                    });

                }
            });
        }
    </script>
@endsection
