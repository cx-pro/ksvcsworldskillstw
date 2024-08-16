<div class="col-12 col-sm-6 col-md-4 me-3 mb-3" id="athlete{{$athlete->id}}">
    @if ($user && $user->isAdmin())
        <div class="d-flex justify-content-end mb-1">
            <div class="me-5 fs-5 border rounded-3 shadow-sm px-3">

                <a href="{{route("admin.athletes.edit", ["id" => $athlete->id])}}" class="text-decoration-none me-3">
                    <i class="bi bi-pencil-square" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="編輯"></i>
                </a>
                <a data-bs-toggle="modal" data-bs-target="#athdel{{$athlete->id}}">
                    <i class="bi bi-trash3 text-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="刪除"></i>
                </a>
            </div>
        </div>
    @endif
    <a href="{{route("athletes.show", ["id" => $athlete->id])}}" class="text-decoration-none" style="color:unset;">
        <div class="border rounded rounded-5 shadow-sm py-3 px-4 bg-light-subtle">
            <div class="">
                <img src="{{$athlete->avatar}}" class="rounded-4 w-100">
            </div>
            <div class="row wt064">
                <div class="col-6 col-sm-12 col-md-12 col-md-12 col-xl-6 fs-2 text-center">
                    {{$athlete->cls}}
                </div>
                <div class="col-6 col-sm-12 col-md-12 col-md-12 col-xl-6 fs-2 text-center">
                    {{$athlete->name}}
                </div>
            </div>
            <div class="text-primary fw-bold text-center fs-5">
                <hr>
                查看
            </div>
        </div>
    </a>
</div>