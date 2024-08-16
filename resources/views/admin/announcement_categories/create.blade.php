@extends("layouts.web")
@section("title")@if(empty($category))新增@else編輯@endif公告類別@endsection
@section("content")
<span class="fs-3 py-2">
    <span class="mx-3 wt064">@if(empty($category))新增@else編輯@endif公告類別</span>
</span>
<hr>
<div class="">
    <form
        action="{{!empty($category) ? route("admin.announcement_categories.update", ["id" => $category->id]) : route("admin.announcement_categories.store")}}"
        method="post" class="col-12 col-md-8 col-lg-6 mx-auto">
        @csrf
        <div class="mt-3">
            <label for="name" class="fw-bold user-select-none">名稱</label>
            <input type="text" name="name" id="name"
                class="form-control bg-light-subtle @error('name') is-invalid @enderror" required maxlength="255"
                value="{{old("name", empty($category) ? "" : $category->name)}}">

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="content" class="fw-bold user-select-none">顏色</label>
            <input type="color" name="color" id="color"
                class="form-control bg-light-subtle @error('name') is-invalid @enderror" required
                value="{{old("color", empty($category) ? "" : $category->color)}}">

            @error('color')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="text-center mt-5 row">
            <div class="col-12 col-md-6 mt-3 mt-md-0 order-1 order-md-0">
                <a href="{{route("admin.announcement_categories.list")}}" class="btn btn-secondary fw-bold w-100">
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