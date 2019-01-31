<div class="container-avatar">
    @if (Auth::user()->image <> null && Auth::user()->image <> "")
        <img src="{{ route('user.avatar',['filename'=>Auth::user()->image]) }}" class="avatar" />
    @else
        <img src="{{ asset('img/profile1.jpg') }}" class="avatar" />
    @endif
</div>
