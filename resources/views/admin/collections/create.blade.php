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
            <label for="name" class="fw-bold user-select-none">作品名稱</label>
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
                <label for="quiz" class="fw-bold user-select-none">上傳作品題目</label>
                <input type="file" name="quiz" id="quiz" class="form-control @error('quiz') is-invalid @enderror"
                    @required(empty($collection))>
                @error('quiz')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="upload" class="fw-bold user-select-none">上傳作品檔案(.zip)</label>
                <input type="file" name="upload" id="upload" class="form-control @error('upload') is-invalid @enderror"
                    accept=".zip" @required(empty($collection))>
                @error('upload')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mt-3">
                <label for="sql_upload" class="fw-bold user-select-none">上傳資料庫檔案(.sql) <span
                        class="text-danger">需包含建立資料庫子句</span></label>
                <input type="file" name="sql_upload" id="sql_upload"
                    class="form-control @error('sql_upload') is-invalid @enderror" accept=".sql">
                @error('sql_upload')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mt-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" name="is_laravel" type="checkbox" role="switch" id="is_laravel" @if (!empty($collection)) @checked($collection->is_laravel)@else @checked((old("is_laravel"))) @endif>
                    <label class="form-check-label fw-bold" for="is_laravel">使用Laravel</label>
                </div>
                @error('is_laravel')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @endif
        <div class="mt-3">
            <label for="athlete" class="fw-bold user-select-none">附屬於</label>
            <select name="athlete" id="athlete" class="form-select">
                <option value="no">不選擇</option>
                @foreach (App\Models\Athlete::where("active", 1)->get() as $athlete)
                    <option value="{{$athlete->id}}" @selected(old("athlete", $collection->athlete_id ?? "") == $athlete->id)>
                        {{$athlete->name}}
                    </option>
                @endforeach
            </select>

            @error('athlete')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3" id="gradeContainer">
            <label for="grade" class="fw-bold user-select-none">屆數</label>

            <input type="text" name="grade" id="grade" required maxlength="255"
                class="form-control bg-light-subtle @error('grade') is-invalid @enderror"
                value="{{old("grade", empty($collection) ? "" : $collection->grade)}}" autocomplete="off"
                list="grade_list">
            <datalist id="grade_list">
                @foreach (array_unique(array_merge(App\Models\Collection::orderBy("grade")->distinct()->pluck("grade")->toArray(), App\Models\Athlete::orderBy("grade")->distinct()->pluck("grade")->toArray())) as $grade)
                    <option value="{{$grade}}"></option>
                @endforeach
            </datalist>
            @error('grade')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

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

@push("scripts")
    <script>
        function handle_athlete(v) {
            if (v == "no") {
                $("#gradeContainer").removeClass("d-none")
                $("#grade").prop("required", true)
            } else {
                $("#gradeContainer").addClass("d-none")
                $("#grade").prop("required", false)
            }
        }
        $(() => {
            handle_athlete($("#athlete").val());
            $("#athlete").change(() => handle_athlete($("#athlete").val()))
        })
    </script>
@endpush