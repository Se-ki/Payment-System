$(document).on('submit', '#form_change_password', function (event) {
    var current = $('#current_password').val()
    var password = $('#password').val()

    if (current === "" || password === "") {
        event.preventDefault()
        $('.modal').effect("shake", { times: 3, distance: 10 }, 500)
        $('.modal-title-password').html('Empty Form!')
    }
})


//profile changed
$("#file_image").change(function (e) {
    e.preventDefault()
    $('image').attr('src', URL.createObjectURL(e.target.files[0]))
    console.log(URL.createObjectURL(e.target.files[0]))
})
