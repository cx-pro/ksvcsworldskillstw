@extends("layouts.web")
@section("title")@if(empty($announcement))新增@else編輯@endif公告@endsection
@section("content")
<span class="fs-3 py-2">
    <span class="mx-3 wt064">@if(empty($announcement))新增@else編輯@endif公告</span>
</span>
<hr>
<div class="">
    <form
        action="{{!empty($announcement) ? route("admin.announcements.update", ["id" => $announcement->id]) : route("admin.announcements.store")}}"
        method="post" class="col-12 col-md-8 col-lg-6 mx-auto">
        @csrf
        <div class="mt-3">
            <label for="title" class="fw-bold user-select-none">標題</label>
            <input type="text" name="title" id="title"
                class="form-control bg-light-subtle @error('title') is-invalid @enderror" required maxlength="255"
                value="{{old("title", empty($announcement) ? "" : $announcement->title)}}">

            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="content" class="fw-bold user-select-none">內文</label>
            <textarea name="content" id="content"
                class="form-control bg-light-subtle @error('content') is-invalid @enderror" style="height:10rem;"
                required>{{old("content", empty($announcement) ? "" : $announcement->content)}}</textarea>

            @error('content')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="text-center mt-5 row">
            <div class="col-12 col-md-6 mt-3 mt-md-0 order-1 order-md-0">
                <a href="{{route("announcements.list")}}" class="btn btn-secondary fw-bold w-100">
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