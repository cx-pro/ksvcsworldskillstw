@extends('layouts.web_no_header')

@section("title") 忘記密碼 @endsection
@section("content")
<div class="d-flex align-item-center justify-content-center mt-5">
    <div class="mt-5">
        <div class="shadow-sm rounded-5 border border-2 py-5 px-5" style="width:25rem;max-width:90vw;">
            <form action="{{route("auth.password.email")}}" method="post">
                @csrf
                <h4>忘記密碼</h4>
                <div class="mt-5">
                    <label for="email" class="fw-bold user-select-none">電子信箱</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="text-center text-md-end mt-5 row">
                    <div class="col-12 col-md-6"></div>
                    <div class="col-12 col-md-6">
                        <button type="submit" class="btn btn-primary fw-bold w-100">
                            送出重置信
                        </button>
                    </div>
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