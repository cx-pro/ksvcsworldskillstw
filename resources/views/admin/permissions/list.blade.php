@php
    $user = auth()->user();
@endphp

@extends("layouts.web")
@section("title")權限管理@endsection
@section("content")

<span class="fs-3 py-2">
    <span class="mx-3 wt064">可管理權限列表</span>
</span>
<span class="text-success fw-bold">可拖曳排序調整權限等級</span>
<a href="{{route("admin.permissions.create")}}" class="float-end fs-2 me-5">
    <i class="bi bi-plus-lg" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="新增"></i>
</a>
<hr>
<diFv class="d-flex mb-4">
    <div class="btn-group fade" id="sort_btn_container">
        <button type="button" id="reset_sort" class="btn btn-sm btn-secondary fw-bold">重設</button>
        <button type="button" id="save_sort" class="btn btn-sm btn-primary fw-bold">儲存</button>
    </div>
</diFv>
<ul class="drop_area">
    @foreach ($permissions as $permission)
        @include("admin.permissions.includes.card")
    @endforeach
</ul>
@endsection

@push("styles")
    <style>
        .drop_area {
            list-style-type: none;
        }
    </style>
@endpush
@push("scripts")
    <script>

        var permission_list = [
            @foreach ($permissions as $permission)
                "permission{{$permission->id}}",
            @endforeach
        ];
        var level_list = {
            @foreach ($permissions as $permission)
                "permission{{$permission->id}}":{{$permission->level}},
            @endforeach
        };
        var permission_orilist;
        var min_level = {{min($permissions->pluck("level")->toArray())}};
        var admin_mark = `<div id="admin_mark" class="mb-2"><span class="fw-bold ms-2 border-danger">具有管理權限</span><div>`

        function array_equals(array1, array2) {
            return JSON.stringify(array1) === JSON.stringify(array2);
        }
        function init_sbc(id_list = []) {
            if (!id_list)
                new_list.forEach(element => id_list.push(element.id));
            var sbc = $("#sort_btn_container");
            if (array_equals(permission_list, id_list)) sbc.removeClass("show");
            else sbc.addClass("show");
        }
        function init_sortable(new_list) {
            var admin_range = 0;
            var id_list = [];
            new_list.forEach((element, index) => {
                if ($(element).data("permission-name") == "_admin") admin_range = index;
                var permission_level = $(element).find(".permission_level");
                var old_level = level_list[element.id];
                permission_level.html(old_level);
                if (index != permission_list.indexOf(element.id)) {
                    permission_level.html(`${old_level} → <span class="text-danger">${min_level + index}</span>`);
                }
                id_list.push(element.id)
            });
            remove_admin_mark();
            new_list.slice(0, admin_range + 1).forEach((element) => $(element).addClass("border-start border-4 border-danger ps-1"));
            var fi = $(new_list[0]);
            fi.addClass("rounded-top");
            fi.prepend(admin_mark);
            $(".drop_area").empty();
            $(".drop_area").append(...new_list);
            init_sbc(id_list);
        }
        function remove_admin_mark() {
            $("#admin_mark").remove();
            $(".drag_row").removeClass("border-start border-4 border-danger ps-1 rounded-top");
        }

        $(() => {
            permission_orilist = $(".drop_area").html();
            init_sortable(Array.from($(".drop_area").children()));

            $(".drop_area").sortable({
                start: (event, ui) => {
                    remove_admin_mark();
                    if ($(ui.item[0]).index() != 0) $(".drop_area").addClass("mt-5");
                },
                items: "li:not(.not_sortable)",
                cursor: "move",
                stop: (event, ui) => {
                    init_sortable(Array.from($(".drop_area").children()));
                    $(".drop_area").removeClass("mt-5");
                }

            });

            $("#reset_sort").click(() => {
                $(".drop_area").html(permission_orilist);
                init_sbc();
                init_sortable(Array.from($(".drop_area").children()));
            })
            $("#save_sort").click(() => {
                var new_list = []
                Array.from($(".drop_area").children()).forEach(element => new_list.push(element.id));
                $.ajax({
                    url: "{{route("admin.permissions.update_levels", [], false)}}",
                    method: "POST",
                    data: {
                        new_id: new_list,
                        _token: "{{csrf_token()}}"
                    }
                }).done(() => setTimeout(location.reload(), 500));
            })
        })
        $("ul, li").disableSelection();
    </script>
@endpush