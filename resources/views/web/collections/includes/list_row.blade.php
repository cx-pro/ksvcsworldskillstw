<div class="">
    @foreach ($collections as $collection)
        @if(!isset($last_grade))
            <div class="wt064 fs-4 w-100 mt-5">{{$collection->get_grade()}}</div>
            <div class="d-flex overflow-x-scroll">
        @else
                @if ($last_grade != $collection->get_grade())
                    </div>
                    <div class="wt064 fs-4 w-100 mt-5">{{$collection->get_grade()}}</div>
                    <div class="d-flex overflow-x-scroll">
                @endif
        @endif
            @php
                $last_grade = $collection->get_grade();
                $delete_url = route("admin.collections.destory", ["id" => $collection->id]);
                $delete_id = "colldel" . $collection->id;
            @endphp
            @include("web.includes.remove_confirm")
            @include("web.collections.includes.card")

            @if($loop->last)
                </div>
            @endif
    @endforeach
</div>