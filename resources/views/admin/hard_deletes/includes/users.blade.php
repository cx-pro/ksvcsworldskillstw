<div class="modal fade" id="user_delete_confirm" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <p class="fw-bold text-danger">確定對非啟用狀態的使用者資料執行不可回復的刪除操作？</p>
                <div class="text-end">
                    <button type="button" class="btn btn-lg btn-secondary fw-bold me-3"
                        data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-sm btn-danger fw-bold me-3" data-bs-toggle="modal"
                        data-bs-target="#user_delete_confirm_again">確定刪除</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="user_delete_confirm_again" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <p class="fw-bold text-danger fs-1">最終確認?</p>
                <div class="text-end">
                    <form action="{{route("admin.hard_deletes.users")}}" method="post">
                        <button type="button" class="btn btn-lg btn-secondary fw-bold me-3"
                            data-bs-dismiss="modal">取消</button>
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger fw-bold">確認</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>