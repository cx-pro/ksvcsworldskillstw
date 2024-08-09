<div class="modal fade" id="{{$delete_id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                <p class="fw-bold text-danger">確定完全刪除此使用者？</p>
                <div class="text-end">
                    <button type="button" class="btn btn-sm btn-secondary fw-bold me-3"
                        data-bs-dismiss="modal">取消</button>
                    <a href="{{$delete_url}}" class="btn btn-sm btn-danger fw-bold">確定刪除</a>
                </div>
            </div>
        </div>
    </div>
</div>