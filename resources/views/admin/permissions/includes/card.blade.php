@php
    $not_sortable = $permission->id == auth()->user()->permission()->id;
@endphp
<li class="drag_row py-1 
@if($permission->is_default_admin())
    rounded-bottom
@endif
@if($not_sortable)
    not_sortable
@endif
 " id="permission{{$permission->id}}" data-permission-name="{{$permission->name}}">
    @php
        $delete_url = route("admin.permissions.destory", ["id" => $permission->id]);
        $delete_id = "permissiondel" . $permission->id;
    @endphp

    @include("admin.includes.remove_confirm")
    <div class="col-12 fs-5 user-select-none">
        <div class="border py-1 px-3 rounded rounded-4 shadow-sm bg-light-subtle 
@if($not_sortable)
    opacity-50
@endif
" style="
cursor:
@if($not_sortable)
    not-allowed
@else
    move
@endif
">
            <div class="d-flex w-100 align-items-center">
                <div> <i class="bi bi-grip-vertical"></i> </div>
                <div class="flex-grow-1">
                    <div class="row text-center text-md-start">
                        <div class="col-4 px-3">
                            <div class="wt064">
                                名稱<span class="ms-md-4 d-block d-md-inline">{{$permission->name}}</span>
                            </div>
                        </div>
                        <div class="col-4 px-3">
                            <div class="wt064">權限等級<span
                                    class="ms-md-4 permission_level d-block d-md-inline">{{$permission->level}}</span>
                            </div>
                        </div>

                        <div class="col-4 px-3">
                            @if ($not_sortable)
                                <div class="wt064">
                                    <span class="text-primary">無法調整自身權限</span>
                                </div>
                            @else
                                <div class="wt064">操作
                                    <span class="d-block d-md-inline">
                                        <a href="{{route("admin.permissions.edit", ["id" => $permission->id])}}"
                                            class="link-primary text-decoration-none fs-5" style="cursor:pointer">
                                            <i class="bi bi-pencil-square" data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="編輯"></i>
                                        </a>

                                        <a data-bs-toggle="modal" data-bs-target="#permissiondel{{$permission->id}}"
                                            class="link-danger text-decoration-none fs-5" style="cursor:pointer">
                                            <i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="刪除"></i>
                                        </a>
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>