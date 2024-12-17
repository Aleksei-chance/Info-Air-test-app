<?php foreach ($children as $comment): ?>
    <div class="comment mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <strong><?= $comment['nickname'] ?></strong>
                    <small class="text-muted"><?= $comment['time'] ?></small>
                </div>
                <p class="mb-2"><?= $comment['content'] ?></p>
                <div class="d-flex justify-content-between gap-2">
                    <div>
                        <?php if ($comment['level'] < 9): ?>
                            <button type="button" class="btn btn-link text-primary p-0" data-bs-toggle="modal" onclick="add_comment_modal(<?= $comment['id'] ?>)">
                                Reply
                            </button>
                        <?php endif; ?>
                    </div>


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
