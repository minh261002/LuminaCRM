<div class="card-body">
    <h4 class="subheader">Thông tin</h4>
    <div class="list-group list-group-transparent">
        <a href="{{ route('profile') }}"
            class="list-group-item list-group-item-action d-flex align-items-center
        {{ request()->is('profile') ? 'active' : '' }}
        ">
            Thông tin cá nhân
        </a>
        <a href="{{ route('profile.change-password') }}"
            class="list-group-item list-group-item-action d-flex align-items-center
        {{ request()->is('change-password') ? 'active' : '' }}
        ">
            Đổi mật khẩu
        </a>
    </div>
</div>
