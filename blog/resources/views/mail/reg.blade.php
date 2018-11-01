这里是{{$user['name']}}
<a href="{{route('confirmMail',$user->email_token)}}">点击链接完成激活</a>
