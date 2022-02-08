@if(auth()->user()->is_admin)
<li class="nav-item">
    <a href="{{ route('participants.index') }}"
       class="nav-link {{ Request::is('participants*') ? 'active' : '' }}">
        <p>参加者</p>
    </a>
</li>
@endif

@if(auth()->user()->is_staff)
<li class="nav-item">
    <a href="{{ url('/s/check_in/input') }}"
       class="nav-link {{ Request::is('/s/check_in/input*') ? 'active' : '' }}">
        <p>チェックイン</p>
    </a>
</li>
@endif
