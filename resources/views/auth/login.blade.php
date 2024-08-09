@extends('layouts.web_no_header')
@section("title") 登入 @endsection
@section("content")
<div class="d-flex align-item-center justify-content-center">
    <div class="mt-5">
        <div class="text-center">
            <span class="wt064 fs-1" style="color:#C9AD8B">競賽紀錄</span>
        </div>
        <div class="shadow-sm rounded-5 border border-2 py-5 px-5" style="width:25rem;max-width:90vw;">
            <form action="{{route("auth.login")}}" method="post">
                @csrf
                <h4>登入</h4>
                <div class="mt-3">
                    <label for="email" class="fw-bold user-select-none">電子信箱</label>
                    <input type="text" name="email" id="email"
                        class="form-control bg-light-subtle @error('email') is-invalid @enderror" value="{{old("email","")}}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="pt-5">
                    <label for="password" class="fw-bold user-select-none">密碼</label>
                    <input type="password" name="password" id="password"
                        class="form-control bg-light-subtle @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-check pt-4">
                    <input class="form-check-input" name="remember" type="checkbox" value="" id="remember">
                    <label class="form-check-label" for="remember">
                        記住我
                    </label>
                </div>
                <div class="text-center text-md-end mt-5 row">
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                        <a href="/forgot-password"
                            class="me-md-5 link-primary fw-bold link-underline-opacity-25 link-offset-2 link-underline-opacity-100-hover">
                            無法登入？
                        </a>
                    </div>
                    <div class="col-12 col-md-6">
                        <button type="submit" class="btn btn-primary fw-bold px-4">
                            <span class="me-4">登</span>入
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="text-center mt-4">
            <a href="{{route("home")}}"
                class="me-md-5 link-primary fw-bold link-underline-opacity-25 link-offset-2 link-underline-opacity-100-hover">
                首頁
            </a>
            <a href="{{route("register")}}"
                class="link-primary fw-bold link-underline-opacity-25 link-offset-2 link-underline-opacity-100-hover">
                註冊
            </a>
        </div>
    </div>
</div>
@endsection