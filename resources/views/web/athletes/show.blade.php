@extends('layouts.web')
@section("title") 選手詳情 @endsection
@section("content")

<span class="fs-3 py-2">
    <a class="fs-4 fw-bold text-decoration-none" onclick="history.back()"><i class="bi bi-arrow-left"></i></a>
    <span class="mx-3 wt064">選手詳情</span>
</span>
<hr>
@include('web.athletes.includes.show_card')

@endsection