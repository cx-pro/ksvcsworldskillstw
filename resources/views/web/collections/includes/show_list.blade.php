@php
    $user = auth()->user();
@endphp
<span class="fs-3 py-2">
    <span class="mx-3 wt064">練習作品</span>
</span>
@if ($user && $user->isAdmin())
    <a href="{{route("admin.collections.create")}}" class="float-end fs-2 me-5">
        <i class="bi bi-plus-lg" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="新增"></i>
    </a>
@endif
<hr>
<div>
    存取以下作品中屬Laravel者將登出此站。
</div>

@include("web.collections.includes.list_row")