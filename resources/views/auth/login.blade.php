@extends('layouts.web')

@section("content")
<div class="d-flex">
    <div class="mx-auto" style="width:25rem;">
        <div class="form-floating">
            <input type="text" id="username" class="form-control border-bottom-0 rounded-bottom-0" placeholder=" ">
            <label for="username">使用者名稱</label>
        </div>
        <div class="form-floating">
            <input type="password" id="password" class="form-control rounded-top-0" placeholder=" ">
            <label for="password">密碼</label>
        </div>
    </div>
</div>
@endsection