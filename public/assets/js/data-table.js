(function ($) {
    "use strict";
    $(function () {
        $("#table_1").DataTable({
            aLengthMenu: [
                [5, 10, 15, -1],
                [5, 10, 15, "All"],
            ],
            iDisplayLength: 10,
            language: {
                search: "",
            },
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
                style: "width: 400px; background-image: url(http://ppl-project.test/assets/images/search.jpg); background-repeat: no-repeat; background-position: 10px 7px !important; background-size: 18px 18px !important;",
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
})(jQuery);

(function ($) {
    "use strict";
    $(function () {
        $("#table_2").DataTable({
            aLengthMenu: [
                [5, 10, 15, -1],
                [5, 10, 15, "All"],
            ],
            iDisplayLength: 10,
            language: {
                search: "",
            },
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
                style: "width: 400px; background-image: url(http://ppl-project.test/assets/images/search.jpg); background-repeat: no-repeat; background-position: 10px 7px !important; background-size: 18px 18px !important;",
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
})(jQuery);
