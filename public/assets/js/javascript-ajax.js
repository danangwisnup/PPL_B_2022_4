// display a modal mahasiswa
$(document).on("click", "#buttonModalMahasiswa", function (event) {
    event.preventDefault();
    let href = $(this).attr("data-attr");
    $.ajax({
        url: href,
        // return the result
        success: function (result) {
            $("#mahasiswa_view").modal("show");
            $("#showModalMahasiswa").html(result).show();
        },
        error: function (jqXHR, testStatus, error) {
            console.log(error);
            alert("Page " + href + " cannot open. Error:" + error);
        },
    });
});

// display a modal dosen
$(document).on("click", "#buttonModalDosen", function (event) {
    event.preventDefault();
    let href = $(this).attr("data-attr");
    $.ajax({
        url: href,
        // return the result
        success: function (result) {
            $("#dosen_view").modal("show");
            $("#showModalDosen").html(result).show();
        },
        error: function (jqXHR, testStatus, error) {
            console.log(error);
            alert("Page " + href + " cannot open. Error:" + error);
        },
    });
});

let modal_header = document.getElementsByClassName("modal-header");
let modal_body = document.getElementsByClassName("modal-body");

// click class btn-close data-bs-toggle="tab" href="#tab-1" click
$(".btn-close").click(function () {
    // function tab1 click
    $("#tab1").click();

    // href to tab 1
    $("#tab-1").addClass("show active");
    $("#tab-2").removeClass("active");
    $("#tab-3").removeClass("active");
    $("#tab-4").removeClass("active");

    // nav-link set active
    $("#tab1").addClass("active");
    $("#tab2").removeClass("active");
    $("#tab3").removeClass("active");
    $("#tab4").removeClass("active");
});

$("#tab1").click(function () {
    // change modal header
    modal_header[0].classList.add("alert-info");
    modal_header[0].classList.remove("alert-danger");
    modal_header[0].classList.remove("alert-warning");
    modal_header[0].classList.remove("alert-success");

    // change modal body
    modal_body[0].classList.add("alert-info");
    modal_body[0].classList.remove("alert-danger");
    modal_body[0].classList.remove("alert-warning");
    modal_body[0].classList.remove("alert-success");
});

$("#tab2").click(function () {
    // change modal header
    modal_header[0].classList.remove("alert-info");
    modal_header[0].classList.add("alert-danger");
    modal_header[0].classList.remove("alert-warning");
    modal_header[0].classList.remove("alert-success");

    // change modal body
    modal_body[0].classList.remove("alert-info");
    modal_body[0].classList.add("alert-danger");
    modal_body[0].classList.remove("alert-warning");
    modal_body[0].classList.remove("alert-success");
});

$("#tab3").click(function () {
    // change modal header
    modal_header[0].classList.remove("alert-info");
    modal_header[0].classList.remove("alert-danger");
    modal_header[0].classList.add("alert-warning");
    modal_header[0].classList.remove("alert-success");

    // change modal body
    modal_body[0].classList.remove("alert-info");
    modal_body[0].classList.remove("alert-danger");
    modal_body[0].classList.add("alert-warning");
    modal_body[0].classList.remove("alert-success");
});

$("#tab4").click(function () {
    // change modal header
    modal_header[0].classList.remove("alert-info");
    modal_header[0].classList.remove("alert-danger");
    modal_header[0].classList.remove("alert-warning");
    modal_header[0].classList.add("alert-success");

    // change modal body
    modal_body[0].classList.remove("alert-info");
    modal_body[0].classList.remove("alert-danger");
    modal_body[0].classList.remove("alert-warning");
    modal_body[0].classList.add("alert-success");
});
