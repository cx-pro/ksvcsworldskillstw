@extends("layouts.web")
@section("title")@if(empty($athlete))新增@else編輯@endif選手@endsection
@section("content")
<span class="fs-3 py-2">
    <span class="mx-3 wt064">@if(empty($athlete))新增@else編輯@endif選手</span>
</span>
<hr>
<div class="">
    <form
        action="{{!empty($athlete) ? route("admin.athletes.update", ["id" => $athlete->id]) : route("admin.athletes.store")}}"
        method="post" class="col-12 col-md-8 col-lg-6 mx-auto" enctype="multipart/form-data">
        @csrf
        <div class="mt-3">
            <label for="name" class="fw-bold user-select-none">姓名</label>
            <input type="text" name="name" id="name"
                class="form-control bg-light-subtle @error('name') is-invalid @enderror" required maxlength="255"
                value="{{old("name", empty($athlete) ? "" : $athlete->name)}}">

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="description" class="fw-bold user-select-none">描述</label>
            <textarea name="description" id="description"
                class="form-control bg-light-subtle @error('description') is-invalid @enderror" style="height:10rem;"
                required maxlength="255">{{old("description", empty($athlete) ? "" : $athlete->description)}}</textarea>

            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3">
            <label for="cls" class="fw-bold user-select-none">班級</label>
            <input type="text" name="cls" id="cls"
                class="form-control bg-light-subtle @error('cls') is-invalid @enderror" required maxlength="255"
                value="{{old("cls", empty($athlete) ? "" : $athlete->cls)}}">

            @error('cls')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mt-3">
            <label for="grade" class="fw-bold user-select-none">屆數</label>
            <input type="text" name="grade" id="grade"
                class="form-control bg-light-subtle @error('grade') is-invalid @enderror" required maxlength="255"
                value="{{old("grade", empty($athlete) ? "" : $athlete->grade)}}">
            @error('grade')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mt-3">
            <label for="avatar" class="fw-bold user-select-none">頭像</label>
            <input type="file" accept="image/*" name="avatar" id="avatar"
                class="form-control @error('avatar') is-invalid @enderror">

            @error('avatar')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="w-50 w-md-25 mt-2">
                @if (!empty($athlete))<img src="{{$athlete->avatar}}" class="w-100">@endif
            </div>
        </div>
        <div class="mt-3">
            <div class="mb-2 d-flex align-items-center">
                <label for="collection" class="fw-bold user-select-none me-2">作品</label>
                <button type="button" id="clear_select" class="btn btn-sm btn-secondary fw-bold">取消選擇</button>
            </div>

            <select name="collection[]" id="collection" multiple
                class="form-select @error('collection') is-invalid @enderror">
                @foreach ((empty($athlete) ? App\Models\Collection::whereNull("athlete_id") : App\Models\Collection::where("athlete_id", $athlete->id)->orWhereNull("athlete_id"))->get() as $collection)
                    <option class="collections_option" value="{{$collection->id}}" @selected(!empty($athlete) ? $collection->athlete_id == $athlete->id : old("collection"))>
                        {{$collection->name}}
                    </option>
                @endforeach
            </select>
            @error('collection')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mt-3 row">
            <hr>
            <label class="fw-bold user-select-none">經歷</label>
            <div class="col-12 col-md-6">
                <label for="experience_input" class="fw-bold user-select-none">競賽名稱</label>
                <input type="text" class="form-control" id="experience_input">
                <label for="rank_input" class="fw-bold user-select-none mt-2">名次</label>
                <input type="text" class="form-control" id="rank_input">
            </div>
            <div class="col-12 col-md-6 text-center">
                <div class="text-center">
                    <div class="mt-4">
                        <button type="button" class="btn btn-sm btn-primary fw-bold px-4" id="addExp"><span
                                class="me-4">新</span>增</button>
                        <button type="button" class="btn btn-sm btn-outline-primary fw-bold px-4" id="moveUp"><span
                                class="me-4">上</span>移</button>
                    </div>
                    <div class="mt-2">
                        <button type="button" class="btn btn-sm btn-secondary fw-bold px-4" id="removeExp"><span
                                class="me-4">移</span>除</button>
                        <button type="button" class="btn btn-sm btn-outline-primary fw-bold px-4" id="moveDown"><span
                                class="me-4">下</span>移</button>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <label for="experience_list" class="fw-bold user-select-none mt-2">已記錄</label>
                <select id="experience_list" class="form-select" multiple> </select>
                @error('experience')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <input type="hidden" name="experience" id="experience">
            <div class="mb-3"></div>
            <hr>
        </div>

        <div class="text-center mt-5 row mb-5">
            <div class="col-12 col-md-6 mt-3 mt-md-0 order-1 order-md-0">
                <a href="{{route("athletes.list")}}" class="btn btn-secondary fw-bold w-100">
                    <span class="me-4">取消
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
        var experience_list = [
            @foreach(empty($experience) ? [] : $experience as $athlete_experience)
                ["{{$athlete_experience[0]}}", "{{$athlete_experience[1]}}"] @if(!$loop->last), @endif
            @endforeach

        ];
        function showExpList() {
            $("#experience").val(JSON.stringify(experience_list))
            $("#experience_list").empty()
            experience_list.forEach((element, index) => {
                $("#experience_list").append(`<option value="${index}">${element}</option>`)
            });
        }
        $(() => {
            showExpList()
            $("#addExp").click(() => {
                var exp = $("#experience_input").val();
                var rank = $("#rank_input").val();
                var exp_rank = [exp, rank]
                if (!exp || !rank || experience_list.includes(exp_rank)) return;
                experience_list.push(exp_rank);
                $("#experience_input").val("");
                $("#rank_input").val("");
                showExpList();
            })
            $("#removeExp").click(() => {
                var exp = $("#experience_list").val();
                if (!exp) return;
                exp.forEach((element, index) => experience_list.splice(element - index, 1));
                showExpList();
            })
            $("#moveUp").click(() => {
                var exp = $("#experience_list").val();
                if (!exp) return;
                var start = exp[0];
                var end = exp[exp.length - 1];
                var selected = experience_list.splice(start, end - start + 1);
                var rest = experience_list.splice(start - 1, experience_list.length - start + 2);
                experience_list = [].concat(experience_list, selected, rest)
                showExpList();
            })
            $("#moveDown").click(() => {
                var exp = $("#experience_list").val();
                if (!exp) return;
                var start = parseInt(exp[0]);
                var end = parseInt(exp[exp.length - 1]);
                var selected = experience_list.splice(start, end - start + 1);
                var rest = experience_list.splice(start + 1, experience_list.length - start);
                experience_list = [].concat(experience_list, selected, rest)
                showExpList();
            })
            $("#clear_select").click(() => {
                $(".collections_option:selected").prop("selected", false);
            })
        })
    </script>
@endpush