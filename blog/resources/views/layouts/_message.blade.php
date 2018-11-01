<div class="mt-2">
    @foreach(['success','danger'] as $t)
        @if(session()->has($t))
            <div class="alert alert-{{$t}}" role="alert">
                <strong>{{session()->get($t)}}</strong>
            </div>
        @endif
    @endforeach
</div>
