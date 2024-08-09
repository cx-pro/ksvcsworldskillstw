@php
    $user = auth()->user();
@endphp

@extends("layouts.web")
@section("title")身份管理@endsection
@section("content")

<span class="fs-3 py-2">
    <span class="mx-3 wt064">身份列表</span>
</span>

@if ($user && $user->isAdmin())
    <a href="{{route("admin.roles.create")}}" class="float-end fs-2 me-5">
        <i class="bi bi-plus-lg" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="新增"></i>
    </a>
@endif
<hr>
<div class="row">
    @foreach ($roles as $role)
        @include("admin.roles.includes.card")
    @endforeach
</div>
@endsection