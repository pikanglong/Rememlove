@extends('layouts')

@section('template')
@if(false)
<div class="mdui-container mundb-standard-container">
    <div class="mdui-row" style="padding-top: 5rem;">
        <div class="mdui-col-xs-12 mdui-col-sm-1 mdui-col-md-2"></div>
        <div class="mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-8 mdui-typo-headline-opacity mdui-text-center">
            今天还没有打卡任务哦
        </div>
    </div>

    <div class="mdui-panel" style="margin-top: 6rem;" mdui-panel>
        <span class="mdui-typo-caption-opacity mdui-p-b-1">现在就现场整一个吧 : </span>
        <div class="mdui-panel-item">
            <div class="mdui-panel-item-header">
                随机一个
                <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <div class="mdui-panel-item-body">

            </div>
        </div>
        <div class="mdui-panel-item">
            <div class="mdui-panel-item-header">
                指定一个
                <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <div class="mdui-panel-item-body">

            </div>
        </div>
    </div>

    <script>
        window.addEventListener("load",function() {

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
            一起去图书馆学习
        </div>
    </div>
    <div class="mdui-row" style="padding-top: 5rem;">
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
                <button class="mdui-btn mdui-btn-raised mdui-color-theme-accent" type="button">选择本地图片文件</button>
            </div>
            <div class="mdui-text-center">
                <button class="mdui-btn mdui-btn-raised mdui-color-theme-accent" type="submit">提交</button>
            </div>
        </form>
    </div>
</div>
@endif
@endsection
