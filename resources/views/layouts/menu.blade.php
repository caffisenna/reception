@if(auth()->user()->is_admin)
<li class="nav-item">
    <a href="{{ route('participants.index') }}"
       class="nav-link {{ Request::is('participants*') ? 'active' : '' }}">
        <p>参加者</p>
    </a>
</li>
@endif
