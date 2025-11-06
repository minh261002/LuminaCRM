<div class="d-flex lh-1 p-0 px-2 d-flex align-items-center">
    <span class="avatar" style="background-image: url({{ $user->avatar }})"> </span>
    <div class="d-flex flex-column align-items-start ms-2">
        <div>{{ $user->name }}</div>
        <div class="mt-1 small text-secondary">
            {{ $user->code }}
        </div>
    </div>
</div>
