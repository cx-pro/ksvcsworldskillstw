@extends('layouts.web_no_header')
@section("title") 登出 @endsection
@section("content")
<div class="d-flex align-item-center justify-content-center mt-5">
    <div class="mt-5">
        <div class="shadow-sm rounded-5 border border-2 py-5 px-5" style="width:25rem;max-width:90vw;">
            <form action="{{route("auth.logout")}}" method="post">
                @csrf
                <h4>確定登出？</h4>
                <div class="mt-5 row text-center">
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                        <button type="button" class="btn btn-secondary fw-bold w-100" onclick="history.back()">
                            <span class="me-4">取</span>消
                        </button>
                    </div>
                    <div class="col-12 col-md-6">
                        <button type="submit" class="btn btn-primary fw-bold w-100">
                            <span class="me-4">確</span>定
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="text-center mt-4">
        </div>
    </div>
</div>
@endsection