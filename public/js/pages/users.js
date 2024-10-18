"use strict";
$(function () {
    let t, a, n;
    n = (
        isDarkStyle
            ? ((t = config.colors_dark.borderColor),
              (a = config.colors_dark.bodyBg),
              config.colors_dark)
            : ((t = config.colors.borderColor),
              (a = config.colors.bodyBg),
              config.colors)
    ).headingColor;
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var e,
        s = $(".tbl-users"),
        status = {
            1: {
                title: "PEDIDO",
                class: "badge rounded-pill bg-label-warning",
            },
            2: {
                title: "PAGADO",
                class: "badge rounded-pill bg-label-success",
            },
            3: {
                title: "CANCELADO",
                class: "badge rounded-pill bg-label-danger",
            },
        },
        invoice = {
            0: {
                title: "PENDIENTE",
                class: "badge rounded-pill bg-label-warning",
            },
            1: {
                title: "ACEPTADO",
                class: "badge rounded-pill bg-label-success",
            },
            2: {
                title: "ANULADO",
                class: "badge rounded-pill bg-label-danger",
            },
        };
    s.length &&
        (e = s.DataTable({
            ajax: "Users/show",
            columns: [
                { data: "id" },
                { data: "name" },
                { data: "email" },
                { data: "username" },
                { data: "" },
            ],
            columnDefs: [
                {
                    className: "control",
                    searchable: !1,
                    orderable: !1,
                    responsivePriority: 2,
                    targets: 0,
                    render: function (e, t, a, n) {
                        return "";
                    },
                },

                {
                    targets: 1,
                    render: function (e, t, a, n) {
                        return `<span class="text-heading">${e}</span>`;
                    },
                },

                {
                    targets: 2,
                    render: function (e, t, a, n) {
                        return `<span class="text-heading">${e}</span>`;
                    },
                },
                {
                    targets: 3,

                    render: function (e, t, a, n) {
                        return `<span class="text-heading">${e}</span>`;
                    },
                },
                {
                    targets: -1,
                    title: "Acciones",
                    render: function (e, t, a, n) {
                        return `<div class="d-flex align-items-center">
                        <a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary rounded-pill text-body dataTables_edit" data-bs-toggle="tooltip" aria-label="Delete Invoice" data-bs-original-title="Delete Invoice">
                        <i class="mdi mdi-pencil-outline mdi-20px mx-1"></i></a>
                        <a href="javascript:;" class="btn btn-sm btn-icon btn-text-secondary rounded-pill text-body" data-bs-toggle="tooltip" aria-label="Delete Invoice" data-bs-original-title="Delete Invoice">
                        <i class="mdi mdi-delete-outline mdi-20px mx-1"></i>
                            </a>
                            </div>
                           
                           `;
                    },
                },
            ],
            order: [[1, "desc"]],
            dom: '<"card-header d-flex rounded-0 flex-wrap py-md-0"<"me-5 pe-5"f><"d-flex justify-content-start justify-content-md-end align-items-baseline"<"dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center mb-3 mb-sm-0 gap-3"lB>>>t<"row mx-1"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                sLengthMenu: "Mostrar _MENU_",
                search: "",
                searchPlaceholder: "Buscar Usuario...",
            },
            buttons: [
                {
                    extend: "collection",
                    className:
                        "btn btn-label-secondary dropdown-toggle me-3 waves-effect waves-light",
                    text: '<i class="mdi mdi-export-variant me-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                    buttons: [
                        {
                            extend: "print",
                            text: '<i class="mdi mdi-printer-outline me-1" ></i>Print',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [1, 2, 3],
                                format: {
                                    body: function (e, t, a) {
                                        var n;
                                        return e.length <= 0
                                            ? e
                                            : ((e = $.parseHTML(e)),
                                              (n = ""),
                                              $.each(e, function (e, t) {
                                                  void 0 !== t.classList &&
                                                  t.classList.contains(
                                                      "user-name"
                                                  )
                                                      ? (n +=
                                                            t.lastChild
                                                                .firstChild
                                                                .textContent)
                                                      : void 0 === t.innerText
                                                      ? (n += t.textContent)
                                                      : (n += t.innerText);
                                              }),
                                              n);
                                    },
                                },
                            },
                            customize: function (e) {
                                $(e.document.body)
                                    .css("color", n)
                                    .css("border-color", t)
                                    .css("background-color", a),
                                    $(e.document.body)
                                        .find("table")
                                        .addClass("compact")
                                        .css("color", "inherit")
                                        .css("border-color", "inherit")
                                        .css("background-color", "inherit");
                            },
                        },
                        {
                            extend: "csv",
                            text: '<i class="mdi mdi-file-document-outline me-1" ></i>Csv',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [1, 2, 3],
                                format: {
                                    body: function (e, t, a) {
                                        var n;
                                        return e.length <= 0
                                            ? e
                                            : ((e = $.parseHTML(e)),
                                              (n = ""),
                                              $.each(e, function (e, t) {
                                                  void 0 !== t.classList &&
                                                  t.classList.contains(
                                                      "user-name"
                                                  )
                                                      ? (n +=
                                                            t.lastChild
                                                                .firstChild
                                                                .textContent)
                                                      : void 0 === t.innerText
                                                      ? (n += t.textContent)
                                                      : (n += t.innerText);
                                              }),
                                              n);
                                    },
                                },
                            },
                        },
                        {
                            extend: "excel",
                            text: '<i class="mdi mdi-file-excel-outline me-1"></i>Excel',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [1, 2, 3],
                                format: {
                                    body: function (e, t, a) {
                                        var n;
                                        return e.length <= 0
                                            ? e
                                            : ((e = $.parseHTML(e)),
                                              (n = ""),
                                              $.each(e, function (e, t) {
                                                  void 0 !== t.classList &&
                                                  t.classList.contains(
                                                      "user-name"
                                                  )
                                                      ? (n +=
                                                            t.lastChild
                                                                .firstChild
                                                                .textContent)
                                                      : void 0 === t.innerText
                                                      ? (n += t.textContent)
                                                      : (n += t.innerText);
                                              }),
                                              n);
                                    },
                                },
                            },
                        },
                        {
                            extend: "pdf",
                            text: '<i class="mdi mdi-file-pdf-box me-1"></i>Pdf',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [1, 2, 3],
                                format: {
                                    body: function (e, t, a) {
                                        var n;
                                        return e.length <= 0
                                            ? e
                                            : ((e = $.parseHTML(e)),
                                              (n = ""),
                                              $.each(e, function (e, t) {
                                                  void 0 !== t.classList &&
                                                  t.classList.contains(
                                                      "user-name"
                                                  )
                                                      ? (n +=
                                                            t.lastChild
                                                                .firstChild
                                                                .textContent)
                                                      : void 0 === t.innerText
                                                      ? (n += t.textContent)
                                                      : (n += t.innerText);
                                              }),
                                              n);
                                    },
                                },
                            },
                        },
                        {
                            extend: "copy",
                            text: '<i class="mdi mdi-content-copy me-1"></i>Copy',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [1, 2, 3],
                                format: {
                                    body: function (e, t, a) {
                                        var n;
                                        return e.length <= 0
                                            ? e
                                            : ((e = $.parseHTML(e)),
                                              (n = ""),
                                              $.each(e, function (e, t) {
                                                  void 0 !== t.classList &&
                                                  t.classList.contains(
                                                      "user-name"
                                                  )
                                                      ? (n +=
                                                            t.lastChild
                                                                .firstChild
                                                                .textContent)
                                                      : void 0 === t.innerText
                                                      ? (n += t.textContent)
                                                      : (n += t.innerText);
                                              }),
                                              n);
                                    },
                                },
                            },
                        },
                    ],
                },
                {
                    text: '<i class="mdi mdi-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Agregar Usuario</span>',
                    className:
                        "add-new btn btn-primary ms-n1 waves-effect waves-light",
                    attr: {
                        "data-bs-toggle": "offcanvas",
                        "data-bs-target": "#offcanvasUser",
                    },
                },
            ],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (e) {
                            return "Details of " + e.data().full_name;
                        },
                    }),
                    type: "column",
                    renderer: function (e, t, a) {
                        a = $.map(a, function (e, t) {
                            return "" !== e.title
                                ? '<tr data-dt-row="' +
                                      e.rowIndex +
                                      '" data-dt-column="' +
                                      e.columnIndex +
                                      '"><td>' +
                                      e.title +
                                      ":</td> <td>" +
                                      e.data +
                                      "</td></tr>"
                                : "";
                        }).join("");
                        return (
                            !!a &&
                            $('<table class="table"/><tbody />').append(a)
                        );
                    },
                },
            },
        })),
        setTimeout(() => {
            $(".dataTables_filter .form-control").removeClass(
                "form-control-sm"
            ),
                $(".dataTables_length .form-select").removeClass(
                    "form-select-sm"
                );
        }, 300);

    $(".add-new").on("click", function () {
        $(".offcanvas-title")
            .attr("data-i18n", "Add User")
            .text("Agregar Categoria");
        $(".data-submit").text("AGREGAR");
    });

    e.on("click", ".dataTables_edit", function () {
        let row = $(this).closest("tr");
        let rowData = $(this).closest("table").DataTable().row(row).data();

        $(".offcanvas-title")
            .attr("data-i18n", "Edit User")
            .text("Editar Usuario");

        $("#offcanvasUser").offcanvas("show");

        $(".data-submit").text("EDITAR");
    });

    const f = document.getElementById("UserForm");

    const fv = FormValidation.formValidation(f, {
        fields: {
            fullname: {
                validators: {
                    notEmpty: {
                        message: "Ingresar Nombre y Apellidos de Usuario",
                    },
                },
            },
            UserEmail: {
                validators: {
                    notEmpty: { message: "Ingresar Correo Electrónico" },
                    emailAddress: {
                        message: "Ingresar un Correo Electrónico válido",
                    },
                    regexp: {
                        regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                        message:
                            "El formato del Correo Electrónico no es válido",
                    },
                },
            },
            UserName: {
                validators: {
                    notEmpty: { message: "Ingresar Nombre de Usuario" },
                },
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: "is-valid",
                rowSelector: function (t, e) {
                    return ".mb-4";
                },
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus(),
        },
    });

    fv.on("core.form.valid", function () {
        const method = $(".offcanvas-title").attr("data-i18n");
        if (method == "Edit User") {
            updateDataServe();
        } else {
            sendDataServe();
        }
    });

    function sendDataServe() {
        const formData = new FormData(f);

        formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

        fetch("Users/add", {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error(
                        "Hubo un problema al procesar el formulario."
                    );
                }
                return response.json();
            })
            .then((data) => {
                f.reset();
                document
                    .getElementById("ecommerce-category-title")
                    .classList.remove("is-valid");
                e.DataTable().ajax.reload();
                Toast.fire({
                    icon: data.icon,
                    title: data.message,
                });
                $("#offcanvasUser").offcanvas("hide");
            })
            .catch((error) => {
                console.error("Error:", error.message);
            });
    }
    function updateDataServe() {}

    const Toast = Swal.mixin({
        toast: true,
        position: "top",
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
    });
}),
    (function () {})();
