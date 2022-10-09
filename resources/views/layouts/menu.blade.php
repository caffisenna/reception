@if (auth()->user()->is_admin)
    <p class="uk-text-warning">管理業務</p>
    <li class="nav-item">
        <a href="{{ route('participants.index') }}" class="nav-link {{ Request::is('participants*') ? 'active' : '' }}">
            <p>参加者</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/admin/checked_in') }}" class="nav-link {{ Request::is('/admin/checked_in') ? 'active' : '' }}">
            <p>チェックイン済み</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/admin/absent_list') }}"
            class="nav-link {{ Request::is('/admin/absent_list') ? 'active' : '' }}">
            <p>欠席リスト</p>
        </a>
    </li>
    <p class="uk-text-warning">情報</p>
    <li class="nav-item">
        <a href="{{ route('admin_staffinfos.index') }}"
            class="nav-link {{ Request::is('admin_staffinfos*') ? 'active' : '' }}">
            <p>スタッフ情報</p>
        </a>
    </li>
@endif

@if (auth()->user()->is_staff)
    <p class="uk-text-warning">業務</p>
    <li class="nav-item">
        <a href="{{ url('/s/check_in/input') }}"
            class="nav-link {{ Request::is('/s/check_in/input*') ? 'active' : '' }}">
            <p>チェックイン</p>
        </a>
    </li>
    <p class="uk-text-warning">情報</p>
    <li class="nav-item">
        <a href="{{ route('staffinfos.index') }}" class="nav-link {{ Request::is('staffinfos*') ? 'active' : '' }}">
            <p>スタッフ情報</p>
        </a>
    </li>
@endif



{{-- <p class="uk-text-warning">マイページ</p>
<li class="nav-item">
    <a href="{{ url('') }}"
       class="nav-link {{ Request::is('/s/check_in/input*') ? 'active' : '' }}">
        <p>マイページ</p>
    </a>
</li>
 --}}
