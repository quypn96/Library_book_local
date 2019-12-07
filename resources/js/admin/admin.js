function callSweetMsg(title, text, type, btnText = "Ok"){
    Swal.fire({
        title: title,
        text: text,
        type: type,
        confirmButtonText: btnText
    });
}

function deleteConfirm(taget){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            taget.submit();
        }
    })
}

$(document).on("click", ".confirm_delete", function (e) {
    e.preventDefault();
    var taget = $(this).closest('form');
    deleteConfirm(taget);
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on("change", ".borrow-selected", function () {
    let data = this.value;
    let id = parseInt($(this).data('id'));
    let cartUrl = "/admin/borrow/" +id;
    $.ajax({
        url: cartUrl,
        method: "PUT",
        data: {
            status: data
        },
        success: function (data) {
            if (data.status) {
                callSweetMsg("Success!", "Update status success", "success");
            } else {
                callSweetMsg("Error!", "Update status error", "error");
            }
        }
    });
});

$(document).on("click", ".add-author-select", function () {
    var html = $(".copy-author").html();
    $(".after-add-author").after(html);
});

$(document).on("click", ".add-category-select", function () {
    var html = $(".copy-category").html();
    $(".after-add-category").after(html);
});

$("body").on("click",".remove",function(){
    $(this).parents(".control-group").remove();
});
