
<div class="modal fade" id="addCommentModal" tabindex="-1" aria-labelledby="addCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCommentModalLabel">Command add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCommentForm">
                    <div class="mb-3">
                        <label for="commentText" class="form-label">Comment</label>
                        <textarea class="form-control" id="commentText" rows="4" placeholder=""></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="commentAuthor" class="form-label">Nickname</label>
                        <input type="text" class="form-control" id="commentAuthor" placeholder="">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="add_comment(<?= $parent_id ?>)">Add</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#addCommentModal').modal('show');
</script>
