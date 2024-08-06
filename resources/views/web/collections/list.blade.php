@extends('layouts.web')

@section("content")
<span class="fs-3 py-2">
    <span class="mx-3 wt064">練習作品</span>
</span>
<hr>
<div class="row">
    @foreach ($collections as $collection)
        @include("web.collections.includes.card")
    @endforeach
</div>
@endsection