@extends("layouts.web")
@section("title")@if(empty($collection))新增@else編輯@endif練習作品@endsection
@section("content")
<span class="fs-3 py-2">
    <span class="mx-3 wt064">@if(empty($collection))新增@else編輯@endif練習作品</span>
</span>
<hr>
<div class="">
    <form
        action="{{!empty($collection) ? route("admin.collections.update", ["id" => $collection->id]) : route("admin.collections.store")}}"
        method="post" enctype="multipart/form-data" class="col-12 col-md-8 col-lg-6 mx-auto">
        @csrf
        <div class="mt-3">
            <label for="name" class="fw-bold user-select-none">名稱</label>
            <input type="text" name="name" id="name" required maxlength="255"
                class="form-control bg-light-subtle @error('name') is-invalid @enderror"
                value="{{old("name", empty($collection) ? "" : $collection->name)}}">

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        @if(empty($collection))
            <div class="mt-3">
                <label for="upload" class="fw-bold user-select-none">上傳檔案</label>
                <input type="file" name="upload" id="upload" class="form-control" required>
                @error('upload')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @endif

        <div class="text-center mt-5 row">
            <div class="col-12 col-md-6 mt-3 mt-md-0 order-1 order-md-0">
                <a href="{{route("collections.list")}}" class="btn btn-secondary fw-bold w-100">
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