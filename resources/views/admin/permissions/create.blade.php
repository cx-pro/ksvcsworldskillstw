@extends("layouts.web")
@section("title")@if(empty($permission))新增@else編輯@endif身分@endsection
@section("content")
<span class="fs-3 py-2">
    <span class="mx-3 wt064">@if(empty($permission))新增@else編輯@endif身分</span>
</span>
<hr>
<div class="">
    <form
        action="{{!empty($permission) ? route("admin.permissions.update", ["id" => $permission->id]) : route("admin.permissions.store")}}"
        method="post" class="col-12 col-md-8 col-lg-6 mx-auto">
        @csrf
        <div class="mt-3">
            <label for="name" class="fw-bold user-select-none">名稱</label>
            <input type="text" name="name" id="name"
                class="form-control bg-light-subtle @error('name') is-invalid @enderror" required maxlength="255"
                value="{{old("name", empty($permission) ? "" : $permission->name)}}">

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="level" class="fw-bold user-select-none">權限等級</label>
            <input type="number" name="level" id="level" class="form-control @error('level') is-invalid @enderror"
                required
                value="{{old("level", empty($permission) ? App\Models\Permission::admin_level() + 1 : $permission->level)}}">
            @error('level')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="text-center mt-5 row">
            <div class="col-12 col-md-6 mt-3 mt-md-0 order-1 order-md-0">
                <a href="{{route("admin.permissions.list")}}" class="btn btn-secondary fw-bold w-100">
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