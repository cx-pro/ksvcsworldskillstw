<div class="text-decoration-none fw-bold mt-3">
    <div class="me-3">
        <div id="collection{{$collection->id}}" class="flex-grow-1">
            <div>
                <div class="border rounded rounded-4 shadow-sm py-2 px-4 bg-light-subtle">
                    <div class="border-bottom border-2 pb-2">
                        <a class="text-decoration-none" href="{{$collection->location}}">
                            <div class="text-truncate">{{$collection->name}}
                            </div>
                            <div class="text-truncate text-end pt-4">
                                <span class="d-none d-md-inline">
                                    {{substr($collection->created_at, 0, -9)}}
                                </span>
                                {{$collection->author}}
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-center text-center w-100 fs-5 px-3 user-select-none gap-3">
                        <a href="/fs?file={{$collection->quiz}}" target="_blank" class="text-decoration-none">
                            <i class="bi bi-file-richtext" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="作品題目"></i>
                        </a>
                        <a href="/fs?file={{$collection->file}}" target="_blank" class="text-decoration-none">
                            <i class="bi bi-file-earmark-zip" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="作品檔案"></i>
                        </a>
                        <a href="/fs?file={{$collection->sql}}" target="_blank" class="text-decoration-none">
                            <i class="bi bi-filetype-sql " data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="作品資料庫"></i>
                        </a>
                        @if ($user && $user->isAdmin())
                            <a href="{{route("admin.collections.edit", ["id" => $collection->id])}}"
                                class="text-decoration-none text-success" style="cursor:pointer">
                                <i class="bi bi-pencil-square" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="編輯"></i>
                            </a>
                            <a data-bs-toggle="modal" data-bs-target="#colldel{{$collection->id}}" style="cursor:pointer">
                                <i class="bi bi-trash3 text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="刪除"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>