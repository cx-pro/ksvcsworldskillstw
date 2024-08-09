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
@foreach ($athletes as $athlete)
    @php
        $delete_url = route("admin.athletes.destory", ["id" => $athlete->id]);
        $delete_id = "athdel" . $athlete->id;
    @endphp

    @include("web.includes.remove_confirm")
    @include("web.athletes.includes.card")
@endforeach