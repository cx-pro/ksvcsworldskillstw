@extends("layouts.web")
@section("title")@if(empty($user))新增@else編輯@endif使用者@endsection
@section("content")
<span class="fs-3 py-2">
    <span class="mx-3 wt064">@if(empty($user))新增@else編輯@endif使用者</span>
</span>
<hr>
<div class="">
    <form action="{{!empty($user) ? route("admin.users.update", ["id" => $user->id]) : route("admin.users.store")}}"
        method="post" class="col-12 col-md-8 col-lg-6 mx-auto">
        @csrf
        <div class="mt-3">
            <div class="form-check form-switch">
                <input class="form-check-input" name="active" type="checkbox" role="switch" id="active" @if (!empty($user)) @checked($user->active)@else @checked((old("active") || !($errors->any() || old("active")))) @endif>
                <label class="form-check-label fw-bold" for="active">啟用使用者</label>
            </div>
        </div>
        <div class="mt-3">
            <label for="name" class="fw-bold user-select-none">名稱</label>
            <input type="text" name="name" id="name"
                class="form-control bg-light-subtle @error('name') is-invalid @enderror" required maxlength="255" @if (!empty($user)) value="{{$user->name}}" @else value="{{old("name", "")}}" @endif>

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="email" class="fw-bold user-select-none">電子信箱</label>
            <div class="form-check form-switch mt-2">
                <input class="form-check-input" name="email_verified_at" type="checkbox" role="switch"
                    id="email_verified_at" @if (!empty($user)) @checked(!empty($user->email_verified_at))@else
                    @checked(old("email_verified_at") || !($errors->any() || old("email_verified_at"))) @endif>
                <label class="form-check-label fw-bold" for="email_verified_at">驗證狀態</label>
            </div>
            <input type="email" name="email" id="email"
                class="form-control bg-light-subtle @error('email') is-invalid @enderror" required maxlength="255" @if (!empty($user)) value="{{$user->email}}" @else value="{{old("email", "")}}" @endif>

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mt-3">
            <label for="password" class="fw-bold user-select-none">密碼</label>
            <input type="text" name="password" id="password"
                class="form-control bg-light-subtle @error('password') is-invalid @enderror" maxlength="255"
                value="{{old("password", "")}}">

            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="role" class="fw-bold user-select-none">身份</label>
            <select name="role" id="role" class="form-select @error('role') is-invalid @enderror">
                @foreach (App\Models\Role::all() as $role)
                    <option value="{{$role->id}}" @selected($role->id == (!empty($user) ? $user->role_id : (old("role"))))>
                        {{$role->name}}
                    </option>
                @endforeach
            </select>
            @error('role')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="text-center mt-5 row">
            <div class="col-12 col-md-6 mt-3 mt-md-0 order-1 order-md-0">
                <a href="{{route("admin.users.list")}}" class="btn btn-secondary fw-bold w-100" onclick="history.back()">
                    <span class="me-4">取</span>消
                </a>
            </div>
            <div class="col-12 col-md-6">
                <button type="submit" class="btn btn-primary fw-bold w-100">
                    <span class="me-4">新</span>增
                </button>
            </div>
        </div>
    </form>
</div>
@endsection