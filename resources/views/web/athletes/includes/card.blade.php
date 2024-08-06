<div class="border rounded rounded-5 shadow-sm py-3 px-4">
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
            <div>
                <div class="wt064 fs-3">競賽經歷</div>
                <div class="fs-5 row overflow-scroll" style="max-height:23vw;">
                    @foreach(App\Models\AthleteExperience::where("athlete_id", $athlete->id)->get() as $athlete_experience)
                        <div class="col-12 col-md-6 text-nowrap">
                            {{$athlete_experience->name}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>