<a href="{{$collection->path}}" class="text-decoration-none col-12 fw-bold">
    <div>
        <div class="border rounded rounded-3 shadow-sm py-1 px-4 mt-3">
            <div class="row">
                <div class="col-6 col-md-8 text-truncate">{{$collection->filename}}
                </div>
                <div class="col-6 col-md-4 text-end text-truncate">
                    <span class="d-none d-md-inline">
                        {{substr($collection->created_at, 0, -9)}}
                    </span>
                    {{$collection->author}}
                </div>
            </div>
        </div>
    </div>
</a>