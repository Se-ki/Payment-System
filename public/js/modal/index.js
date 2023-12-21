// payment modal
$(document).on('click', '#paymentButton', function (event) {
    event.preventDefault();
    let href = $(this).attr('data-attr');
    console.log(href)
    $.ajax({
        url: href,
        // return the result
        success: function (result) {
            $('#paymentModal').modal("show");
            $('#paymentBody').html(result).show();
        },
        error: function (jqXHR, testStatus, error) {
            console.log(error);
            alert("Page " + href + " cannot open. Error:" + error);
            $('#loader').hide();
        },
        timeout: 8000
    })
});

// record modal
$(document).on('click', '#recordButton', function (event) {
    event.preventDefault();
    let href = $(this).attr('data-attr');
    $.ajax({
        url: href,
        success: function (result) {
            $('#recordModal').modal("show");
            $('#recordBody').html(result).show();
        },
        error: function (jqXHR, testStatus, error) {
            console.log(error);
            alert("Page " + href + " cannot open. Error:" + error);
            $('#loader').hide();
        },
        timeout: 8000
    })
});

//description modal
$(document).on('click', '#descriptionButton', function (event) {
    event.preventDefault();
    let href = $(this).attr('data-attr');
    $.ajax({
        url: href,
        success: function (result) {
            $('#descriptionModal').modal("show");
            $('#descriptionBody').html(result).show();
        },
        error: function (jqXHR, testStatus, error) {
            console.log(error);
            alert("Page " + href + " cannot open. Error:" + error);
            $('#loader').hide();
        },
        timeout: 8000
    })
});

