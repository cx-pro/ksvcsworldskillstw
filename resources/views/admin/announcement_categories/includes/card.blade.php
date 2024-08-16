@php
    $delete_url = route("admin.announcement_categories.destory", ["id" => $category->id]);
    $delete_id = "catedel$category->id";
@endphp
@include("web.includes.remove_confirm")
<div class="d-flex col-12 col-sm-6 col-md-4">

    <div class="border rounded px-2 py-1 shadow-sm wt064">
        <div>
            {{$category->name}}
            <span style="color:{{$category->color}}">
                {{$category->color}}
            </span>
        </div>
    </div>

    @if ($user && $user->isAdmin())
        <div class="d-flex justify-content-end align-items-center ms-3">

            <a href="{{route("admin.announcement_categories.edit", ["id" => $category->id])}}"
                class="text-decoration-none me-3">
                <i class="bi bi-pencil-square fs-5" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="編輯"></i>
            </a>
            <a data-bs-toggle="modal" data-bs-target="#catedel{{$category->id}}">
                <i class="bi bi-trash3 text-danger fs-5" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-title="刪除"></i>
            </a>
        </div>
    @endif
</div>