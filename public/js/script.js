function load_comments(){
    $.ajax({
        url: "/comments/load",
        method: "get",
        dataType: "html",
    }).done(function(data)
    {
        $("#comments").html(data);
    }).fail(function(data)
    {

    });
}

function add_comment_modal(parent_id = 0)
{
    $.ajax({
        url: "/comment/add-modal",
        method: "post",
        dataType: "html",
        data: {parent_id: parent_id},
    }).done(function(data)
    {
        $("#modal").html(data);
    }).fail(function(data)
    {

    });
}

function add_comment(parent_id = 0)
{
    let nickname = $('#commentAuthor').val();
    let content = $('#commentText').val();

    if (nickname != "" && content != "") {
        $.ajax({
            url: "/comment/add",
            method: "post",
            dataType: "html",
            data: {parent_id: parent_id, nickname: nickname, content: content},
        }).done(function(data)
        {
            if (data > 0) {
                $('#addCommentModal').modal('hide');
                load_comments()
            } else {
                alert('error!');
            }
        }).fail(function(data)
        {

        });
    } else {
        alert('Fill data!');
    }
}

function edit_comment_modal(id)
{
    $.ajax({
        url: "/comment/edit-modal",
        method: "post",
        dataType: "html",
        data: {id: id},
    }).done(function(data)
    {
        $("#modal").html(data);
    }).fail(function(data)
    {

    });
}

function edit_comment(id)
{
    let content = $('#commentText').val();

    if (content != "") {
        $.ajax({
            url: "/comment/edit",
            method: "post",
            dataType: "html",
            data: {id: id, content: content},
        }).done(function(data)
        {
            console.log(data);
            if (data > 0) {
                $('#editCommentModal').modal('hide');
                load_comments()
            } else {
                alert('error!');
            }
        }).fail(function(data)
        {

        });
    } else {
        alert('Fill data!');
    }
}

function delete_comment(id)
{
    $.ajax({
        url: "/comment/delete",
        method: "post",
        dataType: "html",
        data: {id: id},
    }).done(function(data)
    {
        if (data > 0) {
            load_comments()
        } else {
            alert('error!');
        }
    }).fail(function(data)
    {

    });
}
