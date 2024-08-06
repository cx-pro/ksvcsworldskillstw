<span class="fs-3 py-2">
    <span class="mx-3 wt064">歷屆選手</span>
</span>
<hr>
@foreach ($athletes as $athlete)
    @include("web.athletes.includes.card")
@endforeach