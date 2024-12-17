
<?php if ($comments): ?>
    <div class="d-flex justify-content-between" style="margin-bottom: 15px">
        <h3>Comments</h3>
        <button type="button" class="btn btn-primary" onclick="add_comment_modal()">
            Add comment
        </button>
    </div>
    <div class="comments">
        <?php foreach ($comments as $comment): ?>
            <div class="comment mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <strong><?= $comment['nickname'] ?></strong>
                            <small class="text-muted"><?= $comment['time'] ?></small>
                        </div>
                        <p class="mb-2"><?= $comment['content'] ?></p>
                        <div class="d-flex justify-content-between gap-2">
                            <button type="button" class="btn btn-link text-primary p-0" data-bs-toggle="modal" onclick="add_comment_modal(<?= $comment['id'] ?>)">
                                Reply
                            </button>

                            <div class="d-flex justify-content-between gap-2">
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="edit_comment_modal(<?= $comment['id'] ?>)">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="delete_comment(<?= $comment['id'] ?>)">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ms-4 mt-3">
                    <?php
                        if (count($comment['items']) > 0) {
                            $children = $comment['items'];
                            require 'itemsChildren.php';
                        }
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <button type="button" class="btn btn-primary" onclick="add_comment_modal()">
        Add comment
    </button>
<?php else: ?>
    <h3>Comments</h3>
    <div class="text-center p-5 border rounded bg-light">
        <h5 class="text-muted">No comments yet</h5>
        <p class="text-muted">Be the first to add a comment!</p>
        <button type="button" class="btn btn-primary" onclick="add_comment_modal()">
            Add a Comment
        </button>
    </div>
<?php endif; ?>
