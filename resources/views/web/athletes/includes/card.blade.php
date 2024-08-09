<div class="mt-5" id="athlete{{$athlete->id}}">
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
    <div class="border rounded rounded-5 shadow-sm py-3 px-4 bg-light-subtle">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <img src="{{$athlete->avatar}}" class="rounded-4 w-100">
            </div>
            <div class="col-12 col-sm-6 col-md-4 text-break">
                <div class="wt064 fs-3">{{$athlete->name}}</div>
                <div class="fs-5 text-break overflow-scroll" style="max-height:23vw;">
                    {{$athlete->description}}
                </div>
            </div>
            <div class="col-12 col-md-4 text-break d-flex">
                <div class="vr me-3 d-none d-md-block"></div>
                <div class="flex-grow-1">
                    <div class="wt064 fs-3">競賽經歷</div>
                    <div class="fs-5 overflow-scroll" style="max-height:23vw;">
                        @foreach(App\Models\AthleteExperience::where("athlete_id", $athlete->id)->get() as $athlete_experience)
                            <div class="d-flex w-100 align-items-center border-bottom mb-2">
                                <div class="flex-grow-1">{{$athlete_experience->name}}</div>
                                <div class="">{{$athlete_experience->rank}}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>