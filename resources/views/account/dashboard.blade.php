@extends('layouts')

@section('template')
    <div class="mdui-container mundb-standard-container">
        <div class="mdui-row mdui-p-a-3">
            <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-3">
                <avatar style="width:10rem;height:10rem;">
                    <img src="{{ asset(Auth::user()->avatar) }}" class="mdui-img-circle" alt="avatar">
                </avatar>
            </div>
            <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-3">
                <div class="mdui-typo-display-1">{{ Auth::user()->name }}</div>
                <br>
            <div class="mdui-typo-title"><strong>{{$mymemboxcount}}</strong> 回忆 <strong>111</strong> 喜欢</div>
            </div>
            @if($halfuid)
            <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-3" style="text-align: right">
                <div class="mdui-typo-display-1">{{ $halfdetail -> name }}</div>
                <br>
                <div class="mdui-typo-title"><strong>{{$halfmemboxcount}}</strong> 回忆 <strong>111</strong> 喜欢</div>
            </div>
            <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-3">
                <avatar style="width:10rem;height:10rem;">
                        <img src="{{ asset($halfdetail->avatar) }}" class="mdui-img-circle" alt="avatar">
                </avatar>
            </div>
            @else
            <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-3" style="text-align: right">
                <div class="mdui-typo-headline">还没有配对TA呢</div>
                <br>
            </div>
            <div class="mdui-col-xs-12 mdui-col-sm-6 mdui-col-md-3">
                <avatar style="width:10rem;height:10rem;">
                    <img class="mdui-img-circle" src="https://scontent-sin2-2.cdninstagram.com/vp/fbaa80544aa8e7be95668e1344fbb3b4/5D5E6E38/t51.2885-19/s320x320/54732379_639022049871378_1829252946760564736_n.jpg?_nc_ht=scontent-sin2-2.cdninstagram.com" alt="avatar">
                </avatar>
            </div>
            @endif
            <div>
                <input type="file" style="display: none;" id="avatar_upload" accept="image/*" ref="input" onchange="SelectedImg(this.files[0])">
                <button class="mdui-btn mdui-btn-raised mdui-color-theme-accent" onclick="$('#avatar_upload').click();">上传头像</button>
            </div>
        </div>
    </div>
    <script>
        function SelectedImg(file){
            let c = new FormData();
            c.set('avatar',file);
            $.ajax({
                contentType: false,
                processData: false,
                url : '{{ route("account_updateAvatar") }}',
                type : 'POST',
                data: c,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : function(){
                    mdui.alert("头像上传成功。", function(){
                        window.location = "{{ route('account_dashboard') }}";
                    });

                }
            });
        }
    </script>
@endsection
