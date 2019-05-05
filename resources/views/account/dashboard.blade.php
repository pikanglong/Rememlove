@extends('layouts')

@section('template')
    <div class="mdui-container mundb-standard-container">
        <div class="mdui-row mdui-p-a-3">
            <div class="mdui-col-xs-4 mdui-col-sm-3 mdui-col-md-2">
                <avatar style="width:98%">
                    <img src="https://scontent-sin2-2.cdninstagram.com/vp/fbaa80544aa8e7be95668e1344fbb3b4/5D5E6E38/t51.2885-19/s320x320/54732379_639022049871378_1829252946760564736_n.jpg?_nc_ht=scontent-sin2-2.cdninstagram.com" alt="avatar">
                </avatar>
            </div>
            <div class="mdui-col-xs-8 mdui-col-sm-3 mdui-col-md-4">
                <div class="mdui-typo-display-1">{{ Auth::user()->name }}</div>
                <br>
                <div class="mdui-typo-title"><strong>1</strong> 回忆 <strong>111</strong> 喜欢 <strong>111</strong> 评论</div>
                <br>
                <br>
            </div>
            <div class="mdui-col-xs-8 mdui-col-sm-3 mdui-col-md-4" style="text-align: right">
                <div class="mdui-typo-headline">还没有配对TA呢</div>
                <br>
                <div class="mdui-typo-title"><strong>0</strong> 回忆</div>
            </div>
            <div class="mdui-col-xs-4 mdui-col-sm-3 mdui-col-md-2">
                <avatar style="width:98%">
                    <img src="https://scontent-sin2-2.cdninstagram.com/vp/fbaa80544aa8e7be95668e1344fbb3b4/5D5E6E38/t51.2885-19/s320x320/54732379_639022049871378_1829252946760564736_n.jpg?_nc_ht=scontent-sin2-2.cdninstagram.com" alt="avatar">
                </avatar>
            </div>
        </div>
        <div class="mdui-tab mdui-tab-centered" mdui-tab>
            <a href="#mem-tab" class="mdui-ripple mdui-ripple-white">
                <i class="mdui-icon material-icons">book</i>
                <label>回忆</label>
            </a>
            <a href="#like-tab" class="mdui-ripple mdui-ripple-white">
                <i class="mdui-icon material-icons">favorite</i>
                <label>喜欢</label>
            </a>
            <a href="#comment-tab" class="mdui-ripple mdui-ripple-white">
                <i class="mdui-icon material-icons">comment</i>
                <label>评论</label>
            </a>
        </div>
        <div id="mem-tab" class="mdui-p-a-2">web content</div>
        <div id="like-tab" class="mdui-p-a-2">shopping content</div>
        <div id="comment-tab" class="mdui-p-a-2">images content</div>
    </div>
@endsection
