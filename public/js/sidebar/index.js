// side bar code
const toggle = $('#header-toggle')
const nav = $('#nav-bar')
const bodypd = $('#body-pd')
const headerpd = $('#header')

$(toggle).click(function () {
    //show navbar
    $(nav).toggleClass('show-l-navbar')
    //change icon
    $(toggle).toggleClass('bx-x')
    //add padding to body
    $(bodypd).toggleClass('body-pd')
    //add aodding to header
    $(headerpd).toggleClass('body-pd')
})

