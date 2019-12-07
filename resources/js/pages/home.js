function callSweetMsg(title, text, type, btnText = "Ok"){
    Swal.fire({
        title: title,
        text: text,
        type: type,
        confirmButtonText: btnText
    });
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on("click", ".borrow",function () {
    let cartUrl = "/cart/add-item/";
    let data = $(this).data('id');
    $.ajax({
        url: cartUrl,
        method: "POST",
        data: {
            id: data
        },
        success: function (data) {
            if (data == "login") {
                window.location.href = data;
            }
            let countCart = Object.keys(data.cart).length;
            $('.count').text(countCart);
            if (data.status) {
                callSweetMsg("Success!", "Add book into list books success", "success");
            } else {
                callSweetMsg("Error!", "Book is exist", "error");
            }
        },
        error: function (request, status, error) {
            var err = jQuery.parseJSON( request.responseText );
            if (err.message == "Unauthenticated.") {
                window.location.href = '/login';
            }
        }
    });
});
$(document).on("click", ".delete-item",function () {
    let url = "/cart/delete-item/";
    let data = $(this).data('id');
    $.ajax({
        url: url,
        method: "DELETE",
        data: {
            id: data
        },
        success: function (data) {
            if (data == "login") {
                window.location.href = data;
            }
            let countCart = Object.keys(data.cart).length;
            $('.count').text(countCart);
            let html = '';
            $.each( data.cart, function( key, value ) {
                html += '<tr>' +
                            '<td class="cart_product">' +
                                '<a href="">' +
                                    '<img src="' + value.image + '" width="100" alt=""></a>' +
                            '</td>' +
                            '<td class="cart_description">' +
                                '<h4><a href="">' + value.title + '</a></h4>' +
                            '</td>' +
                            '<td class="cart_delete">' +
                                '<button class="cart_quantity_delete delete-item" data-id="' +
                                    value.id + '">' +
                                    '<i class="fa fa-times" ></i>' +
                                '</button>' +
                            '</td>' +
                        '</tr>';
            });
            $('.list-items').html(html);
        }
    });
});

$(document).on("click", ".logout",function () {
    $('form#logout').submit();
});

$(document).on("click", ".like",function () {
    var taget = $(this);
    let url = "/likes";
    let method = "";
    let data = parseInt($(this).data('id'));
    let typeMethod = parseInt($(this).data('type'));
    if (typeMethod === 1) {
        method = 'POST'
    } else {
        method = 'DELETE';
        url = url + "/" + data;
    }
    $.ajax({
        url: url,
        method: method,
        data: {
            id: data
        },
        success: function (data) {
            if (data.liked) {
                taget.text('Unlike');
                taget.data('type', 0);
            }
            if (data.unliked) {
                taget.text('Like');
                taget.data('type', 1);
            }
        }
    });
});

$(document).on("click", ".comment", function () {
    let commentUrl = "/comments";
    let book_id = parseInt($(this).data('id'));
    let content = $('textarea[name="content"]').val();
    $.ajax({
        url: commentUrl,
        method: "POST",
        data: {
            book_id: book_id,
            content: content
        },
        success: function (data) {
            let html = `
                <li class="media">
                    <a href="#" class="pull-left">
                        <img src="` + window.location.origin + `/storage/` + data.user.avatar + `" alt="" class="img-circle">
                    </a>
                    <div class="media-body">
                        <span class="text-muted pull-right">
                            <small class="text-muted">now</small>
                        </span>
                        <strong class="text-success">` + data.user.name + `</strong>
                        <p>
                            ` + data.comment.content + `
                        </p>
                    </div>
                </li>
            `;
            $('.media-list').append(html);
            $('textarea[name="content"]').val("");

        },
        error: function (request, status, error) {
            var err = jQuery.parseJSON( request.responseText );
            if (err.message == "Unauthenticated.") {
                window.location.href = '/login';
            }
            callSweetMsg("Error!", err.errors.content, "error");
        }
    });
});

$(document).on('click', '.reply-tag', function () {
    var parent = $(this).parents('li.comments');
    var userName = $(this).data('username');
    var textarea = $(parent).find('.text-reply');
    textarea.val('@' + userName + ': ');
    textarea.focus();
});

$(document).on("click", ".reply-submit", function () {
    let commentUrl = "/comments";
    let parent_id = parseInt($(this).data('parent'));
    let parent = $(this).parents('div.reply');
    let content = $(parent).find('.text-reply').val();
    var taget = $(this).parents('li.comments');
    var ul_taget = $(taget).find('.cmt');
    $.ajax({
        url: commentUrl,
        method: "POST",
        data: {
            content: content,
            parent_id: parent_id
        },
        success: function (data) {
            let html = `
                <li class="media comment-reply">
                    <a href="#" class="pull-left">
                        <img src="` + window.location.origin + `/storage/` + data.user.avatar + `" alt="" class="img-circle">
                    </a>
                    <div class="media-body">
                        <span class="text-muted pull-right">
                            <small class="text-muted">now</small>
                        </span>
                        <strong class="text-success">` + data.user.name + `</strong>
                        <p>
                            ` + data.comment.content + `
                        </p>
                    </div>
                </li>
            `;
            $(ul_taget).append(html);
            $('textarea[name="content"]').val("");

        },
        error: function (request, status, error) {
            var err = jQuery.parseJSON( request.responseText );
            if (err.message == "Unauthenticated.") {
                window.location.href = '/login';
            }
            callSweetMsg("Error!", err.errors.content, "error");
        }
    });
});
