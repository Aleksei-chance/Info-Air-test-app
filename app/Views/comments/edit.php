<div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCommentModalLabel">Comment edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCommentForm">
                    <div class="mb-3">
                        <label for="editCommentText" class="form-label">Comment</label>
                        <textarea class="form-control" id="commentText" rows="4" placeholder=""><?= $content ?></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" onclick="edit_comment(<?= $id ?>)">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#editCommentModal').modal('show');
</script>
