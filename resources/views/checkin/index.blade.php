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
    <div class="mdui-row" style="padding-top: 5rem;">
        <span class="mdui-typo-caption-opacity mdui-p-b-1">已经完成的话可以在这里提交哦</span>
        <form>
            <div class="mdui-textfield mdui-textfield-floating-label">
                <label class="mdui-textfield-label">这个时候，您们想说点什么呢</label>
                <textarea class="mdui-textfield-input"></textarea>
            </div>
            <div style="display: none;">
                {{-- img preview --}}
            </div>
            <input type="file" id="img-upload" style="display: none;" >
            <div class="mdui-text-right">
                <button is="checkin-select-file" class="mdui-btn mdui-btn-raised mdui-color-theme-accent" type="button">选择本地图片文件</button>
            </div>
            <div class="mdui-text-center">
                <button id="checkin-submit" class="mdui-btn mdui-btn-raised mdui-color-theme-accent" type="button">提交</button>
            </div>
        </form>
    </div>
</div>
@endif
@endsection
