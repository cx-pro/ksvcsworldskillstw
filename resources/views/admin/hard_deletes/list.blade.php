@extends("layouts.web")
@section("title")永久刪除選單@endsection
@section("content")
@include("admin.hard_deletes.includes.announcements")
@include("admin.hard_deletes.includes.athletes")
@include("admin.hard_deletes.includes.users")
<div class="row justify-content-md-center text-center">
    <a class="col-6 col-md-4 mb-5 user-select-none text-decoration-none" data-bs-toggle="modal"
        data-bs-target="#announcement_delete_confirm">
        <i class="bi bi-megaphone fs-1"></i>
        <div class="wt064 fs-3">公告</div>
    </a>
    <a class="col-6 col-md-4 mb-5 user-select-none text-decoration-none"
        data-bs-toggle="modal" data-bs-target="#athlete_delete_confirm">
        <i class="bi bi-people fs-1"></i>
        <div class="wt064 fs-3">選手</div>
    </a>
    <a class="col-6 col-md-4 mb-5 user-select-none text-decoration-none"
        data-bs-toggle="modal" data-bs-target="#user_delete_confirm">
        <i class="bi bi-people fs-1"></i>
        <div class="wt064 fs-3">使用者</div>
    </a>
</div>

@endsection