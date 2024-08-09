@extends('layouts.web_no_header')
@section("title") 註冊 @endsection
@section("content")
<div class="d-flex align-item-center justify-content-center">
    <div class="">
        <div class="text-center">
            <span class="wt064 fs-1" style="color:#C9AD8B">競賽紀錄</span>
        </div>
        <div class="shadow-sm rounded-5 border border-2 py-5 px-5" style="width:25rem;max-width:90vw;">
            <form action="{{route("auth.register")}}" method="post">
                @csrf
                <h4>註冊</h4>
                <div class="mt-3">
                    <label for="name" class="fw-bold user-select-none">名稱</label>
                    <input type="text" name="name" id="name" class="form-control bg-light-subtle">
                </div>
                <div class="pt-4">
                    <label for="email" class="fw-bold user-select-none">電子信箱</label>
                    <input type="email" name="email" id="email" class="form-control bg-light-subtle">
                </div>
                <div class="pt-4">
                    <label for="password" class="fw-bold user-select-none">密碼</label>
                    <input type="password" name="password" id="password" class="form-control bg-light-subtle">
                </div>
                <div class="pt-4">
                    <label for="password_confirmation" class="fw-bold user-select-none">確認密碼</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control bg-light-subtle">
                </div>
                <div class="text-center text-md-end mt-5">
                    <button type="submit" class="btn btn-primary fw-bold px-4">
                        <span class="me-4">註</span>冊
                    </button>
                </div>
            </form>
        </div>
        <div class="text-center mt-4 mb-4">
            <a href="{{route("home")}}"
                class="me-md-5 link-primary fw-bold link-underline-opacity-25 link-offset-2 link-underline-opacity-100-hover">
                首頁
            </a>
            <a href="{{route("login")}}"
                class="link-primary fw-bold link-underline-opacity-25 link-offset-2 link-underline-opacity-100-hover">
                登入
            </a>
        </div>
    </div>
</div>
@endsection