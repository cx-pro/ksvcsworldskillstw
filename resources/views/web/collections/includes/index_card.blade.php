<div class="text-decoration-none col-12 fw-bold mt-3">
    <div class="d-flex align-items-center">

        @if ($user && $user->isAdmin())
            <div class="fs-5 px-3 order-2">

                <a href="{{route("admin.collections.edit", ["id" => $collection->id])}}" class="text-decoration-none me-3">
                    <i class="bi bi-pencil-square" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="編輯"></i>
                </a>
                <a data-bs-toggle="modal" data-bs-target="#colldel{{$collection->id}}">
                    <i class="bi bi-trash3 text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="刪除"></i>
                </a>
            </div>
        @endif
        <a href="{{$collection->path}}" id="collection{{$collection->id}}" class="flex-grow-1 text-decoration-none">
            <div>
                <div class="border rounded rounded-4 shadow-sm py-2 px-4 bg-light-subtle">
                    <div class="row">
                        <div class="col-6 col-md-8 text-truncate">{{$collection->name}}
                        </div>
                        <div class="col-6 col-md-4 text-end text-truncate">
                            <span class="d-none d-md-inline">
                                {{substr($collection->created_at, 0, -9)}}
                            </span>
                            {{$collection->author}}
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>