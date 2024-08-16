@php
    $user = auth()->user();
@endphp
<span class="fs-3 py-2">
    <span class="mx-3 wt064">歷屆選手</span>
</span>
@if ($user && $user->isAdmin())
    <a href="{{route("admin.athletes.create")}}" class="float-end fs-2 me-5">
        <i class="bi bi-plus-lg" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="新增"></i>
    </a>
@endif
<hr>
<div class="mb-5">
    @foreach ($athletes as $athlete)
        @if(!isset($last_grade))
            <div class="wt064 fs-4 w-100 mt-5">{{$athlete->grade}}</div>
            <div class="d-flex overflow-x-scroll">
        @else
                @if ($last_grade != $athlete->grade)
                    </div>
                    <div class="wt064 fs-4 w-100 mt-5">{{$athlete->grade}}</div>
                    <div class="d-flex overflow-x-scroll">
                @endif
        @endif

            @php
                $last_grade = $athlete->grade;
                $delete_url = route("admin.athletes.destory", ["id" => $athlete->id]);
                $delete_id = "athdel" . $athlete->id;
            @endphp

            @include("web.includes.remove_confirm")
            @include("web.athletes.includes.card")

            @if($loop->last)
                </div>
            @endif
    @endforeach
</div>