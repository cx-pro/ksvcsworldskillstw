@php
    $delete_url = route("admin.roles.destory", ["id" => $role->id]);
    $delete_id = "roledel" . $role->id;
@endphp

@include("admin.includes.remove_confirm")
<div class="p-2 col-12 col-md-6 fs-5">
    <div class="border py-2 px-3 rounded rounded-4 mb-4 shadow-sm bg-light-subtle" id="role{{$role->id}}">
        <div class="row text-center text-md-start">
            <div class="mb-2 col-12 col-md-6 px-3">
                <div class="wt064">名稱</div>
                <div>{{$role->name}}</div>
            </div>
            <div class="mb-2 col-12 col-md-6 px-3">
                <div class="wt064">權限</div>
                <div>
                    {{$role->permission()->name}}
                </div>
            </div>
            <div class="mb-2 col-12 col-md-6 px-3">
                <div class="wt064">權限等級</div>
                <div>
                    {{$role->permission_level()}}
                </div>
            </div>
        </div>
        <div class="border-2 px-3 border-top mt-2 d-flex justify-content-center">
            <div class="text-center">
                <div class="wt064">操作</div>
                <div>
                    <a href="{{route("admin.roles.edit", ["id" => $role->id])}}"
                        class="link-primary text-decoration-none fs-4">
                        <i class="bi bi-person-gear" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="編輯"></i>
                    </a>

                    <a data-bs-toggle="modal" data-bs-target="#roledel{{$role->id}}"
                        class="link-danger text-decoration-none fs-4">
                        <i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="刪除"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>