@extends('layouts')

@section('template')
@if(empty($today_task))
<div class="mdui-container mundb-standard-container">
    <div class="mdui-row" style="padding-top: 5rem;">
        <div class="mdui-col-xs-12 mdui-col-sm-1 mdui-col-md-2"></div>
        <div class="mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-8 mdui-typo-headline-opacity mdui-text-center">
            今天还没有打卡任务哦
        </div>
    </div>

    <div class="mdui-panel" style="margin-top: 6rem;" mdui-panel>
        <span class="mdui-typo-caption-opacity mdui-p-b-1">现在就整一个吧 : </span>
        <div class="mdui-panel-item">
            <div class="mdui-panel-item-header">
                随机一个
                <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <div class="mdui-panel-item-body">
                <div class="mdui-text-center">
                    <button id="random-task" type="button" class="mdui-btn mdui-btn-raised mdui-color-theme-accent">给我整一个</button>
                </div>
            </div>
        </div>
        <div class="mdui-panel-item">
            <div class="mdui-panel-item-header">
                指定一个
                <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <div class="mdui-panel-item-body">
                <form id="invite-code-form" method="POST">
                    <div class="mdui-textfield mdui-textfield-floating-label">
                        <label class="mdui-textfield-label">今天你们想干点什么呢?
                        </label>
                        <input id="want-to-do" class="mdui-textfield-input" type="text" required/>
                        <div class="mdui-textfield-error">不能为空</div>
                    </div>

                    <div class="mdui-text-center">
                        <button id="spec-task-submit" type="button" class="mdui-btn mdui-btn-raised mdui-color-theme-accent">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener("load",function() {
            $('#random-task').on('click',function(){
                $.ajax({
                    url : '{{ route("check_newTask",["mode" => "rand"]) }}',
                    type : 'POST',
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

            $('#spec-task-submit').on('click',function(){
                var want_to_do = $('#want-to-do').val();
                if(want_to_do == ''){
                    mdui.alert('您想做的事情不能是空的哦','注意',function(){},{
                        confirmText : '我知道了'
                    })
                    return;
                }
                $.ajax({
                    url : '{{ route("check_newTask",["mode" => "spec"]) }}',
                    type : 'POST',
                    data : {
                        want_to_do : want_to_do
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
            })
        }, false);
    </script>
</div>
@else
<div class="mdui-container mundb-standard-container">
    <div class="mdui-row" style="padding-top: 5rem;">
        <div class="mdui-col-xs-12 mdui-col-sm-1 mdui-col-md-2"></div>
        <div class="mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-8 mdui-typo-headline-opacity mdui-text-center">
            今天的任务是
        </div>
    </div>
    <div class="mdui-row" style="padding-top: 5rem;">
        <div class="mdui-col-xs-12 mdui-col-sm-1 mdui-col-md-2"></div>
        <div class="mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-8 mdui-typo-display-1-opacity mdui-text-center">
            {{$today_task->do}}
        </div>
    </div>
    @if(!$today_task->complete)
    <div class="mdui-row" style="padding-top: 5rem;margin-bottom: 5rem;">
        <span class="mdui-typo-caption-opacity mdui-p-b-1">已经完成的话可以在这里提交哦</span>
        <form>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">这个时候，您们想说点什么呢</label>
                <textarea id="remarks" class="mdui-textfield-input"></textarea>
            </div>
            <div id="img-preview" class="mdui-row" style="display: none;">

            </div>
            <input type="file" style="display: none;" id="img-upload" accept="image/*" multiple />

            <div class="mdui-text-right">
                <button is="checkin-select-file" class="mdui-btn mdui-btn-raised mdui-color-theme-accent" type="button"><label for="img-upload">选择本地图片文件</label></button>
            </div>
            <div class="mdui-text-center">
                <button id="checkin-submit" class="mdui-btn mdui-btn-raised mdui-color-theme-accent" type="button">提交</button>
            </div>
        </form>
    </div>
    @else
    <div class="mdui-row" style="padding-top: 5rem;margin-bottom: 5rem;">
        <span class="mdui-typo-caption-opacity mdui-p-b-1">任务已完成! 请再接再厉哦</span>
            <p style="text-indent:2rem;">{{$today_task->remarks}}</p>
            <div id="img-preview" class="mdui-row">
                @foreach ($img_list as $img_url)
                    <div class="mdui-col-xs-3 mdui-col-sm-3 mdui-col-md-3 mdui-col-lg-3">
                        <img class="app-pic mdui-img-fluid mdui-img-rounded" src="{{$img_url}}" alt="">
                    </div>
                @endforeach
            </div>
        </form>
    </div>
    @endif
</div>
<script src="https://cdn.jsdelivr.net/npm/compressorjs@1.0.5/dist/compressor.min.js"></script>
<script>
    window.addEventListener("load",function() {
        $('#img-upload').on('change',function(){
            var files = $(this).prop('files');
            if(files.length > 4){
                mdui.alert('最多只允许上传四张图片哦','注意',function(){},{
                    confirmText : '我知道了'
                });
                $('#img-preview').hide();
                console.log($(this).prop('files'));
                return;
            }

            $('#img-preview').html('');
            $('#img-preview').show();
            for (const file of files) {
                let url = URL.createObjectURL(file);
                $('#img-preview').append(`
                <div class="mdui-col-xs-3 mdui-col-sm-3 mdui-col-md-3 mdui-col-lg-3">
                    <img class="app-pic mdui-img-fluid mdui-img-rounded" src="${url}" alt="">
                </div>
                `);
            }
        });

        $('#checkin-submit').on('click',function(){
            var files = $('#img-upload').prop('files');
            var remarks = $('#remarks').val();
            if(files==undefined || files.length == 0 || files.length > 4){
                mdui.alert('必须上传图片且图片数要少于四张哦','注意',function(){},{
                    confirmText : '我知道了'
                });
                return;
            }
            var form_data = new FormData();
            var i = 0;
            var file_size = 0;

            for (const file of files) {
                new Compressor(file, {
                    strict: true,
                    checkOrientation: true,
                    maxWidth: 3000,
                    maxHeight: 3000,
                    quality: 0.8,
                    success(result) {
                        form_data.append('pic_' + i, result);
                        file_size += result.size / 1024;
                        i++;
                    },
                    error(err) {
                        console.log(err.message);
                    },
                });
            }
            form_data.append('remarks',remarks);
            form_data.append('binding_id', {{ $binding_id }} )
            setTimeout(function(){
                console.log(file_size);
                if(file_size >= 2048){
                    mdui.alert('上传文件总大小不能超过2M哦','注意',function(){},{
                        confirmText : '我知道了'
                    });
                    return;
                }
                $.ajax({
                    url : '{{route("check_submit")}}',
                    type : 'POST',
                    data : form_data,
                    processData : false,
                    contentType : false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function(result){
                        if(result.ret == 200){
                            mdui.alert('打卡完成，请再接再厉哦','成功',function(){
                                window.location = result.data;
                            },{
                                confirmText : '好的呢'
                            });
                        }else{
                            mdui.alert(result.desc,'注意',function(){},{
                                confirmText : '我知道了'
                            });
                        }
                    }
                });
            },500);
        });
    }, false);
</script>
@endif
@endsection
