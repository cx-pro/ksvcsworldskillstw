<div class="mb-4">
    <header
        class="d-flex shadow-sm flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0 text-center">
            <a href="{{route('home')}}" class="d-inline-flex link-body-emphasis text-decoration-none">
                <span class="wt064 fs-1" style="color:#C9AD8B">競賽紀錄</span>
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 wt064 fs-4 justify-content-center mb-md-0 text-center">
            <li>
                <a href="{{route('home')}}"
                    class="nav-link px-2 @if ($request_url == route('home')) link-secondary @endif">首頁</a>
            </li>
            <li>
                <a href="{{route('announcements.list')}}"
                    class="nav-link px-2 @if ($request_url == route('announcements.list')) link-secondary @endif">公告</a>
            </li>
            <li>
                <a href="{{route('athletes.list')}}"
                    class="nav-link px-2 @if ($request_url == route('athletes.list')) link-secondary @endif">歷屆選手</a>
            </li>
            <li>
                <a href="{{route('collections.list')}}"
                    class="nav-link px-2 @if ($request_url == route('collections.list')) link-secondary @endif">練習作品</a>
            </li>
        </ul>
        <div class="col-md-3 text-center">
            @if ($user)
                <a href="{{route('logout')}}" class="fs-3 border-0 link-primary text-decoration-none">
                    <i class="bi bi-box-arrow-left"></i>
                </a>
            @else
                <a href="{{route('login')}}" class="fs-3 border-0 link-primary text-decoration-none">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                </a>
            @endif
            @if($user && $user->isAdmin())
                <a href="{{route('admin.home')}}" class="fs-4 link-success text-decoration-none ms-3">
                    <i class="bi bi-gear-wide-connected"></i>
                </a>
            @endif
        </div>
    </header>
    @php
        $msg = Session::get("message");
    @endphp
    @if ($msg)
        <div class="d-flex mt-2">
            <span class="mx-auto rounded text-bg-warning bg-gradient py-1 ps-3 pe-2 text-center" style="max-width:90vw;">
                <span>
                    {!! $msg !!}
                </span>
                <form action="{{route('api.clear_msg')}}" method="post" class="d-inline">
                    @csrf
                    <button type="submit" class="btn-close float-end" aria-label="Close"></button>
                </form>
            </span>
        </div>
    @endif
    @if ($user && !$user->hasVerifiedEmail())
        <div class="d-flex mt-2">
            <span class="mx-auto rounded text-bg-warning bg-gradient py-1 ps-3 pe-2 text-center" style="max-width:90vw;">
                <span>
                    您尚未驗證信箱
                </span>
                <form action="{{route('auth.verification.send')}}" method="post" class="d-inline">
                    @csrf
                    <button type="submit" class="btn border-0 p-0 ms-5 fw-bold link-primary">重寄驗證信</button>
                </form>
            </span>
        </div>
    @endif
</div>