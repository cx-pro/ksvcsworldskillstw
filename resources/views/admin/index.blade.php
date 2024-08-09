@extends("layouts.web")
@section("title")管理介面@endsection
@section("content")
<div class="form-check form-switch mb-5">
    <input class="form-check-input" type="checkbox" role="switch" id="hard_delete_menu">
    <label class="form-check-label fw-bold user-select-none" for="hard_delete_menu">永久刪除選單</label>
</div>
<div class="row justify-content-md-center text-center">
    <a href="{{route("admin.users.list")}}" class="col-6 col-md-4 mb-5 user-select-none text-decoration-none">
        <i class="bi bi-people fs-1"></i>
        <div class="wt064 fs-3">使用者管理</div>
    </a>
    <a href="{{route("admin.roles.list")}}" class="col-6 col-md-4 mb-5 user-select-none text-decoration-none">
        <i class="bi bi-gear-wide fs-1"></i>
        <div class="wt064 fs-3">身份管理</div>
    </a>
    <a href="{{route("admin.permissions.list")}}" class="col-6 col-md-4 mb-5 user-select-none text-decoration-none">
        <i class="bi bi-gear-wide fs-1"></i>
        <div class="wt064 fs-3">權限管理</div>
    </a>
    <a href="{{route("admin.hard_deletes.list")}}" class="link-danger col-6 col-md-4 mb-5 user-select-none text-decoration-none"
        id="hard_deletes" style="display: none;">
        <i class="bi bi-recycle fs-1"></i>
        <div class="wt064 fs-3">永久刪除選單</div>
    </a>
</div>

@endsection
@push("scripts")
    <script>
        $(() => {
            $("#hard_deletes").hide()
            $("#hard_delete_menu").click(() => {
                $("#hard_deletes").toggle(500)
            })
        })
    </script>
@endpush