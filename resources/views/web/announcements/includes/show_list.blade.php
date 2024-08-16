@php
    $user = auth()->user();
@endphp
<span class="fs-3 py-2">
    <span class="mx-3 wt064">公告</span>
</span>
@if ($user && $user->isAdmin())
    <div class="float-end">
        <a href="{{route("admin.announcements.create")}}" class="fs-2 me-3 text-decoration-none">
            <i class="bi bi-plus-lg" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="新增"></i>
        </a>
        <a href="{{route("admin.announcement_categories.list")}}" class="fs-2 me-3 text-decoration-none">
            <i class="bi bi-tag" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="管理類別"></i>
        </a>
    </div>
@endif
<hr>
<div class="my-3" style="min-height:30vh;">
    @foreach ($announcements as $announcement)
        @php
            $delete_url = route("admin.announcements.destory", ["id" => $announcement->id]);
            $delete_id = "anndel" . $announcement->id;
        @endphp

        @include("web.includes.remove_confirm")
        <div class="mt-2 fs-6 border-bottom">
            <div class="d-flex px-3 align-items-center">
                <a href="{{route('announcements.show', [$announcement->id])}}"
                    class="text-decoration-none link-primary fw-bold flex-grow-1 me-3">
                    <div class="d-flex align-items-center">
                        <div class="me-2 d-flex align-items-center">
                            <span class="badge"
                                style="background-color:{{$announcement->category()->color}}">{{$announcement->category()->name}}</span>
                        </div>
                        <div class="flex-grow-1">{{$announcement->title}}</div>
                        <div class="text-end">
                            {{substr($announcement->created_at, 0, -3)}}
                        </div>
                    </div>
                </a>

                @if (!empty($user) && $user->isAdmin())
                    <div class="">
                        <a href="{{route("admin.announcements.edit", ["id" => $announcement->id])}}"
                            class="text-decoration-none me-3">
                            <i class="bi bi-pencil-square fs-4" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="編輯"></i>
                        </a>
                        <a data-bs-toggle="modal" data-bs-target="#anndel{{$announcement->id}}">
                            <i class="bi bi-trash3 text-danger fs-4" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="刪除"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>