// display data inside a modal
$(document).on('click', ".load-in-modal", function (e) {
    e.preventDefault();
    var url = $(this).attr('href'); // récuperer le valeur de href

    $.ajax({
        url: url,
        dataType: 'html',
        success: function (html) {
            $('body').append(html);
            $('#modal-data').modal('show');
        },
        error: function (XHR, status, error) {
            console.log(XHR);
            console.log(status);
            console.log(error);
            alert(error);
        }
    });
});

$(document).on('hidden.bs.modal', "#modal-data", function () {
    $(this).remove();
});