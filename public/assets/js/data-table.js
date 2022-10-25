$(document).ready(function () {
    var table = $("#table").DataTable({
        iDisplayLength: 10,
        language: {
            search: "",
        },
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "All"],
        ],
    });

    $("#table").each(function () {
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable
            .closest(".dataTables_wrapper")
            .find("div[id$=_filter] input");
        // Change the input attributes
        search_input.attr({
            placeholder: "Search",
            class: "form-control form-control-sm ps-5",
            // add icon fa fa-search
            style: "width: 250px; background-image: url(http://ppl-project.test/assets/images/search.jpg); background-repeat: no-repeat; background-position: 10px 7px !important; background-size: 18px 18px !important;",
            id: "search",
            name: "search",
        });

        // LENGTH - Inline-Form control
        var length_sel = datatable
            .closest(".dataTables_wrapper")
            .find("div[id$=_length] select");
        length_sel.removeClass("form-control-sm");
    });
});

$(document).ready(function () {
    var table = $("#table_1").DataTable({
        iDisplayLength: 10,
        language: {
            search: "",
        },
        buttons: [
            {
                extend: "print",
                title: function () {
                    return (
                        "<h5><center>Data " +
                        title +
                        " - Informatika</center></h5><br/>"
                    );
                },
                className: "btn btn-primary btn-sm",
                text: '<i class="bi bi-printer"></i> Print',
                titleAttr: "Print",
            },
            {
                extend: "excel",
                title: function () {
                    return "Data " + title + " - Informatika";
                },
                className: "btn btn-primary btn-sm",
                text: '<i class="fas fa-file-excel"></i> Excel',
                titleAttr: "Excel",
            },
        ],
        dom:
            "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
            "<'row'<'col-md-12'tr>>" +
            "<'row'<'col-md-5'i><'col-md-7'p>>",
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "All"],
        ],
    });

    $("#table_1").each(function () {
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable
            .closest(".dataTables_wrapper")
            .find("div[id$=_filter] input");
        // Change the input attributes
        search_input.attr({
            placeholder: "Search",
            class: "form-control form-control-sm ps-5",
            // add icon fa fa-search
            style: "width: 250px; background-image: url(http://ppl-project.test/assets/images/search.jpg); background-repeat: no-repeat; background-position: 10px 7px !important; background-size: 18px 18px !important;",
            id: "search",
            name: "search",
        });

        // LENGTH - Inline-Form control
        var length_sel = datatable
            .closest(".dataTables_wrapper")
            .find("div[id$=_length] select");
        length_sel.removeClass("form-control-sm");
    });
});

$(document).ready(function () {
    var table = $("#table_2").DataTable({
        iDisplayLength: 10,
        language: {
            search: "",
        },
        buttons: [
            {
                extend: "print",
                title: function () {
                    return (
                        "<h5><center>Data " +
                        title_2 +
                        " - Informatika</center></h5><br/>"
                    );
                },
                className: "btn btn-primary btn-sm",
                text: '<i class="bi bi-printer"></i> Print',
                titleAttr: "Print",
            },
            {
                extend: "excel",
                title: function () {
                    return "Data " + title_2 + " - Informatika";
                },
                className: "btn btn-primary btn-sm",
                text: '<i class="fas fa-file-excel"></i> Excel',
                titleAttr: "Excel",
            },
        ],
        dom:
            "<'row'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" +
            "<'row'<'col-md-12'tr>>" +
            "<'row'<'col-md-5'i><'col-md-7'p>>",
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "All"],
        ],
    });

    $("#table_2").each(function () {
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable
            .closest(".dataTables_wrapper")
            .find("div[id$=_filter] input");
        // Change the input attributes
        search_input.attr({
            placeholder: "Search",
            class: "form-control form-control-sm ps-5",
            // add icon fa fa-search
            style: "width: 250px; background-image: url(http://ppl-project.test/assets/images/search.jpg); background-repeat: no-repeat; background-position: 10px 7px !important; background-size: 18px 18px !important;",
            id: "search",
            name: "search",
        });

        // LENGTH - Inline-Form control
        var length_sel = datatable
            .closest(".dataTables_wrapper")
            .find("div[id$=_length] select");
        length_sel.removeClass("form-control-sm");
    });
});

function filterColumn(i) {
    $("#table_1")
        .DataTable()
        .column(i)
        .search($("#col" + i + "_filter").val())
        .draw();
}

$(document).ready(function () {
    $("input.column_filter").on("keyup click", function () {
        filterColumn($(this).parents("div").attr("data-column"));
    });
    $("select.column_filter").on("change", function () {
        filterColumn($(this).parents("div").attr("data-column"));
    });
});
