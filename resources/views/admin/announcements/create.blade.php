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
        method="post" class=" mx-auto">
        <div class="col-12 col-md-8 col-lg-6">
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
                <label for="category" class="fw-bold user-select-none">類別</label>
                <select name="category" id="category"
                    class="form-select bg-light-subtle @error('title') is-invalid @enderror">
                    @foreach (App\Models\AnnouncementCategory::where("active", 1)->get() as $category)
                        <option value="{{$category->id}}" @selected(old("category", $announcement->category_id ?? "") == $category->id)>
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>

                @error('category')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mt-3">
            <label for="content" class="fw-bold user-select-none">內文</label>
            @error('content')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
            <textarea name="content" id="content"
                class="form-control bg-light-subtle @error('content') is-invalid @enderror" style="height:10rem;"
                required>{{old("content", empty($announcement) ? "" : $announcement->content)}}</textarea>

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


    <script src="{{asset("public/js/tinymce/tinymce.min.js")}}" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content',
            promotion: false,
            language: 'zh_TW',
            license_key: "gpl",
            hidden_input: true,
            init_instance_callback: function (editor) {
                editor.addShortcut("ctrl+s", "Custom Save", "custom_save");
                editor.addCommand("custom_save", function () {
                });
            }
        });
    </script>
</div>
@endsection