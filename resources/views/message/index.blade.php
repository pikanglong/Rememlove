@extends('layouts')

@section('template')
<div class="mdui-container mundb-standard-container">
    <div class="mdui-col-xs-12 mdui-col-sm-1 mdui-col-md-2"></div>
    <div class="mdui-col-xs-12 mdui-col-sm-10 mdui-col-md-8">
        <ul class="mdui-list mdui-center">
            @if(count($message_list) != 0)
                @foreach ($message_list as $message)
                    <li class="mdui-list-item mdui-ripple message-item" data-message-id="{{$message->id}}">
                        <div class="mdui-list-item-content">
                            <div class="mdui-list-item-title">{{$message->title}}</div>
                            <div class="mdui-list-item-text mdui-list-item-one-line">{{$message->contents}}</div>
                        </div>
                    </li>
                @endforeach
            @else
                <p class="mdui-text-center">没有未读消息哦</p>

            @endif
        </ul>
    </div>
    {{-- {{$message_list->links()}} --}}
</div>
<script>
window.addEventListener("load",function() {
    $('.message-item').on('click',function(){
        var message_id = $(this).data('message-id');
        $(this).slideUp(100);

        $.ajax({
            url : '{{ route("message_read") }}',
            type : 'POST',
            data : {
                message_id : message_id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function(result){
                mdui.dialog({
                    title: result.data.title,
                    content: result.data.contents,
                    buttons: [
                    {
                        text: '访问消息附带的链接',
                        onClick: function(inst){
                            if(result.data.link != undefined){
                                window.open(result.data.link);
                            }else{
                                mdui.alert('这条消息没有附带链接');
                            }
                        }
                    },
                    {
                        text: '我看完了'
                    }
                    ]
                });
            }
        });
    });
}, false);
</script>
@endsection
