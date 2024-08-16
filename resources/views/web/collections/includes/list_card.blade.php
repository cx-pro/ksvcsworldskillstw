<div class="mt-3">
    <div class="fs-1 mt-3">
        <a href="/fs?file={{$collection->quiz}}" target="_blank" class="text-decoration-none">
            <i class="bi bi-file-richtext" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="作品題目"></i>
        </a>
    </div>
    <div class="fs-1 mt-3">
        <a href="/fs?file={{$collection->file}}" target="_blank" class="text-decoration-none">
            <i class="bi bi-file-earmark-zip" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="作品檔案"></i>
        </a>
    </div>
    <div class="fs-1 mt-3">
        <a href="/fs?file={{$collection->sql}}" target="_blank" class="text-decoration-none">
            <i class="bi bi-filetype-sql " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="作品資料庫"></i>
        </a>
    </div>
    @if ($user && $user->isAdmin())
        <div class="fs-1 mt-3">
            <a href="{{route("admin.collections.edit", ["id" => $collection->id])}}"
                class="text-decoration-none me-3 link-primary" style="cursor:pointer">
                <i class="bi bi-pencil-square" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="編輯"></i>
            </a>
        </div>
        <div class="fs-1 mt-3">
            <a data-bs-toggle="modal" data-bs-target="#colldel{{$collection->id}}" style="cursor:pointer">
                <i class="bi bi-trash3 text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="刪除"></i>
            </a>
        </div>
    @endif
</div>
<div class="mt-3 d-flex w-100">
    <div class="text-decoration-none fw-bold w-100 flex-grow-1">
        <div id="collection{{$collection->id}}" class="d-flex w-100 py-2">
            <div class="border rounded rounded-4 shadow-sm py-2 px-4 bg-light-subtle flex-grow-1">
                <a class="text-decoration-none w-100" href="{{$collection->location}}">
                    <div class="position-relative w-100">
                        <div class="position-absolute w-100 h-100 bg-light opacity-50"></div>
                        <iframe src="{{$collection->location}}" class="w-100"
                            style="min-height:30vw;pointer-events: none;"></iframe>
                    </div>
                    <div class="text-center border-top border-2 mt-4 pt-2 pb-1 text-primary">查看</div>
                </a>
            </div>

        </div>
    </div>
</div>