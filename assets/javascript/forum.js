var myVar = setInterval(LoadData, 3000);

http_request = new XMLHttpRequest();

function LoadData(){
    $.ajax({
        url: '../controller/forum.php',
        type: "POST",
        dataType: 'json',
        success: function(data) {
            $('#forumTable tbody').empty();
            for (var i=0; i<data.length; i++) {
                var commentId = data[i].id;

                if(data[i].parent_topic_id == 0){
                    document.querySelector("#record")
                    var row = $('<tr><td> <b>'+ data[i].category + ':</b> </br> <img src="../assets/images/avatar.jpg" width="30px" height="30px" /><b>' + data[i].name + '</b> :<i style="font-size: 12px"> '+ data[i].date + ':</i> </br><p style="padding-left:30px">' + data[i].post + '</br><a data-toggle="modal" data-id="'+ commentId +'" title="Reply" class="open-ReplyModal" href="#ReplyModal">Reply</a>'+'</p></td></tr>');
                    $('#record').append(row);
                    for (var r = 0; (r < data.length); r++)
                    {
                        if ( data[r].parent_topic_id == commentId)
                        {
                            var comments = $('<tr><td style="padding-left:80px"> <img src="../assets/images/avatar.jpg" width="30px" height="30px" /> <b>' + data[r].name + ' :<i style="font-size: 12px"> ' + data[r].date + ':</i></b></br><p style="padding-left:35px">'+ data[r].post +'</p></td></tr>');
                            $('#record').append(comments);
                        }
                    }
                }
            }
        },

        error: function(jqXHR, textStatus, errorThrown){
            console.warn(jqXHR.responseText);
        }
    });
}



$(document).on("click", ".open-ReplyModal", function () {
    var parent_topic_id = $(this).data('id');
    $("#Rcommentid").val( parent_topic_id );
});


$( document ).ready(function() {
    //Post new discussion
    $('#butsave').on('click', function () {
        var id = document.forms["frm"]["Pcommentid"].value;
        var unique_id = document.forms["frm"]["unique_id"].value;
        var category = document.forms["frm"]["category"].value;
        var post = document.forms["frm"]["msg"].value;

        if (category != "" && post != "") {
            $.ajax({
                url: "../controller/insert-forum.php",
                type: "POST",
                data: {
                    id: id,
                    unique_id: unique_id,
                    category: category,
                    post: post,
                },
                cache: false,
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        document.forms["frm"]["category"].value = "";
                        document.forms["frm"]["msg"].value = "";
                        LoadData();
                    } else if (dataResult.statusCode == 201) {
                        alert("Error occured !");
                    }
                }
            });
        } else {
            alert('Please fill all the field !');
        }
    });

    //Reply Comment
    $('#btnreply').on('click', function() {

        var id = document.forms["frm1"]["Rcommentid"].value;
        var unique_id =document.querySelector("#Runique_id").value;
        var post = document.forms["frm1"]["Rmsg"].value;
        var category = "Parent_category";

        if(post !== ""){
            $.ajax({
                url: "../controller/insert-forum.php",
                type: "POST",
                data: {
                    id: id,
                    unique_id: unique_id,
                    post: post,
                    category: category
                },
                cache: false,
                success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        document.forms["frm1"]["Rcommentid"].value = "";
                        document.forms["frm1"]["Rmsg"].value = "";
                        LoadData();
                        $("#ReplyModal").modal("hide");
                    }
                    else if(dataResult.statusCode == 201){
                        alert("Error occured !");
                    }
                }
            });
        }
        else{
            alert('Please fill all the field !');
        }
    });
});


