@extends("layouts.web")
@section("title")@if(empty($role))新增@else編輯@endif身分@endsection
@section("content")
<span class="fs-3 py-2">
    <span class="mx-3 wt064">@if(empty($role))新增@else編輯@endif身分</span>
</span>
<hr>
<div class="">
    <form action="{{!empty($role) ? route("admin.roles.update", ["id" => $role->id]) : route("admin.roles.store")}}"
        method="post" class="col-12 col-md-8 col-lg-6 mx-auto">
        @csrf
        <div class="mt-3">
            <label for="name" class="fw-bold user-select-none">名稱</label>
            <input type="text" name="name" id="name"
                class="form-control bg-light-subtle @error('name') is-invalid @enderror" required maxlength="255"
                value="{{old("name", empty($role) ? "" : $role->name)}}">

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        @if((empty($role) || !empty($role) && $role->id != auth()->user()->role_id))
            <div class="mt-3">
                <label for="permission" class="fw-bold user-select-none">權限</label>
                <select name="permission" id="permission" class="form-select @error('permission') is-invalid @enderror">
                    @foreach (App\Models\Permission::where("level", ">=", auth()->user()->level())->get() as $permission)
                        <option value="{{$permission->id}}" @selected($permission->id == (!empty($role) ? $role->permission_id : (old("permission"))))>
                            {{$permission->name}}
                        </option>
                    @endforeach
                </select>
                @error('permission')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @endif
        <div class="text-center mt-5 row">
            <div class="col-12 col-md-6 mt-3 mt-md-0 order-1 order-md-0">
                <a href="{{route("admin.roles.list")}}" type="button" class="btn btn-secondary fw-bold w-100">
                    <span class="me-4">取</span>消
                </a>
            </div>
            <div class="col-12 col-md-6">
                <button type="submit" class="btn btn-primary fw-bold w-100">
                    <span class="me-4">新</span>增
                </button>
            </div>
        </div>
    </form>
</div>
@endsection