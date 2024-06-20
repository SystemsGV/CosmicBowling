"use strict";
$(function () {
    let csrfToken = $('meta[name="csrf-token"]').attr("content");
    let e, s, n;
    n = (
        isDarkStyle
            ? ((e = config.colors_dark.borderColor),
              (s = config.colors_dark.bodyBg),
              config.colors_dark)
            : ((e = config.colors.borderColor),
              (s = config.colors.bodyBg),
              config.colors)
    ).headingColor;
    var t = $(".datatables-products"),
        m = $(".select2"),
        a = {
            1: { title: "Scheduled", class: "bg-label-warning" },
            2: { title: "Publish", class: "bg-label-success" },
            3: { title: "Inactive", class: "bg-label-danger" },
        },
        o = { 0: { title: "inactive" }, 1: { title: "active" } };

    const commentEditor = document.querySelector(".comment-editor");
    commentEditor &&
        new Quill(commentEditor, {
            modules: { toolbar: ".comment-toolbar" },
            placeholder: "Ingrese la descripción del producto...",
            theme: "snow",
        }),
        m.length &&
            m.each(function () {
                var sm = $(this);
                select2Focus(sm),
                    sm.wrap('<div class="position-relative"></div>').select2({
                        dropdownParent: sm.parent(),
                        placeholder: sm.data("placeholder"),
                    });
            }),
        t.length &&
            (t.DataTable({
                ajax: "tableProducts",
                columns: [
                    { data: "id" },
                    { data: "id" },
                    { data: "image" },
                    { data: "name" },
                    { data: "category" },
                    { data: "subcategory" },
                    { data: "pricelj" },
                    { data: "pricefds" },
                    { data: "guest" },
                    { data: "status" },
                    { data: "" },
                ],
                columnDefs: [
                    {
                        className: "control",
                        searchable: !1,
                        orderable: !1,
                        responsivePriority: 2,
                        targets: 0,
                        render: function (t, e, s, n) {
                            return "";
                        },
                    },
                    {
                        targets: 1,
                        orderable: !1,
                        checkboxes: {
                            selectAllRender:
                                '<input type="checkbox" class="form-check-input">',
                        },
                        render: function () {
                            return '<input type="checkbox" class="dt-checkboxes form-check-input" >';
                        },
                        searchable: !1,
                    },
                    {
                        targets: 2,
                        orderable: !1,
                        render: function (t, e, s, n) {
                            return `<div class="d-flex justify-content-center align-items-center" style="height: 40px;"><img src="/storage/product/${t}" alt="Avatar" class="rounded" style="max-width: 80%;"></div>`;
                        },
                    },
                    {
                        targets: 4,
                        responsivePriority: 1,

                        render: function (t, e, s, n) {
                            return `<span class="h6">${t}</span>`;
                        },
                    },
                    {
                        targets: [6, 7],
                        className: "text-center",
                        render: function (t, e, s, n) {
                            return `<span class="h6">S/. ${t}</span>`;
                        },
                    },
                    {
                        targets: 8,
                        className: "text-center",
                        render: function (t, e, s, n) {
                            return `<span class="h6"> ${t}</span>`;
                        },
                    },
                    {
                        targets: -2,
                        render: function (t, e, s, n) {
                            s = t;
                            return (
                                "<span class='text-truncate'>" +
                                {
                                    inactive:
                                        '<label class="switch switch-primary switch-sm"><input type="checkbox" class="switch-input" id="switch"><span class="switch-toggle-slider"><span class="switch-off"></span></span></label>',
                                    active: '<label class="switch switch-primary switch-sm"><input type="checkbox" class="switch-input" checked=""><span class="switch-toggle-slider"><span class="switch-on"></span></span></label>',
                                }[o[s].title] +
                                '<span class="d-none">' +
                                o[s].title +
                                "</span></span>"
                            );
                        },
                    },
                    {
                        targets: -1,
                        title: "Actions",
                        searchable: !1,
                        orderable: !1,
                        render: function (t, e, s, n) {
                            return '<div class="d-flex align-items-center"><a href="javascript:;" data-bs-toggle="tooltip" class="text-body datatable_edit" data-bs-placement="top" title="Delete Invoice"><i class="mdi mdi-pencil-outline mdi-20px mx-1"></i></a></div>';
                        },
                    },
                ],
                order: [2, "asc"],
                dom: '<"card-header d-flex border-top rounded-0 flex-wrap py-md-0"<"me-5 ms-n2"f><"d-flex justify-content-start justify-content-md-end align-items-baseline"<"dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center mb-3 mb-sm-0 gap-3"lB>>>t<"row mx-1"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                lengthMenu: [10, 20, 50, 70, 100],
                language: {
                    sLengthMenu: "_MENU_",
                    search: "",
                    searchPlaceholder: "Buscar Producto",
                    info: "Mostrando de _START_ al _END_ de  _TOTAL_ registros",
                    oPaginate: {
                        sFirst: "Primero",
                        sLast: "Último",
                        sNext: "Siguiente",
                        sPrevious: "Anterior",
                    },
                },
                buttons: [
                    {
                        extend: "collection",
                        className:
                            "btn btn-label-secondary dropdown-toggle me-3 waves-effect waves-light",
                        text: '<i class="mdi mdi-export-variant me-1"></i><span class="d-none d-sm-inline-block">Export </span>',
                        buttons: [
                            {
                                extend: "print",
                                text: '<i class="mdi mdi-printer-outline me-1" ></i>Print',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5],
                                    format: {
                                        body: function (t, e, s) {
                                            var n;
                                            return t.length <= 0
                                                ? t
                                                : ((t = $.parseHTML(t)),
                                                  (n = ""),
                                                  $.each(t, function (t, e) {
                                                      void 0 !== e.classList &&
                                                      e.classList.contains(
                                                          "product-name"
                                                      )
                                                          ? (n +=
                                                                e.lastChild
                                                                    .firstChild
                                                                    .textContent)
                                                          : void 0 ===
                                                            e.innerText
                                                          ? (n += e.textContent)
                                                          : (n += e.innerText);
                                                  }),
                                                  n);
                                        },
                                    },
                                },
                                customize: function (t) {
                                    $(t.document.body)
                                        .css("color", n)
                                        .css("border-color", e)
                                        .css("background-color", s),
                                        $(t.document.body)
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
                                    columns: [1, 2, 3, 4, 5],
                                    format: {
                                        body: function (t, e, s) {
                                            var n;
                                            return t.length <= 0
                                                ? t
                                                : ((t = $.parseHTML(t)),
                                                  (n = ""),
                                                  $.each(t, function (t, e) {
                                                      void 0 !== e.classList &&
                                                      e.classList.contains(
                                                          "product-name"
                                                      )
                                                          ? (n +=
                                                                e.lastChild
                                                                    .firstChild
                                                                    .textContent)
                                                          : void 0 ===
                                                            e.innerText
                                                          ? (n += e.textContent)
                                                          : (n += e.innerText);
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
                                    columns: [1, 2, 3, 4, 5],
                                    format: {
                                        body: function (t, e, s) {
                                            var n;
                                            return t.length <= 0
                                                ? t
                                                : ((t = $.parseHTML(t)),
                                                  (n = ""),
                                                  $.each(t, function (t, e) {
                                                      void 0 !== e.classList &&
                                                      e.classList.contains(
                                                          "product-name"
                                                      )
                                                          ? (n +=
                                                                e.lastChild
                                                                    .firstChild
                                                                    .textContent)
                                                          : void 0 ===
                                                            e.innerText
                                                          ? (n += e.textContent)
                                                          : (n += e.innerText);
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
                                    columns: [1, 2, 3, 4, 5],
                                    format: {
                                        body: function (t, e, s) {
                                            var n;
                                            return t.length <= 0
                                                ? t
                                                : ((t = $.parseHTML(t)),
                                                  (n = ""),
                                                  $.each(t, function (t, e) {
                                                      void 0 !== e.classList &&
                                                      e.classList.contains(
                                                          "product-name"
                                                      )
                                                          ? (n +=
                                                                e.lastChild
                                                                    .firstChild
                                                                    .textContent)
                                                          : void 0 ===
                                                            e.innerText
                                                          ? (n += e.textContent)
                                                          : (n += e.innerText);
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
                                    columns: [1, 2, 3, 4, 5],
                                    format: {
                                        body: function (t, e, s) {
                                            var n;
                                            return t.length <= 0
                                                ? t
                                                : ((t = $.parseHTML(t)),
                                                  (n = ""),
                                                  $.each(t, function (t, e) {
                                                      void 0 !== e.classList &&
                                                      e.classList.contains(
                                                          "product-name"
                                                      )
                                                          ? (n +=
                                                                e.lastChild
                                                                    .firstChild
                                                                    .textContent)
                                                          : void 0 ===
                                                            e.innerText
                                                          ? (n += e.textContent)
                                                          : (n += e.innerText);
                                                  }),
                                                  n);
                                        },
                                    },
                                },
                            },
                        ],
                    },
                    {
                        text: '<i class="mdi mdi-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Agregar</span>',
                        className:
                            "btn-modal btn btn-primary mb-3 mb-md-0 waves-effect waves-light",
                        attr: {
                            "data-bs-toggle": "modal",
                            "data-bs-target": "#productModal",
                        },
                        init: function (e, t, a) {
                            $(t).removeClass("btn-secondary");
                        },
                    },
                ],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (t) {
                                return "Details of " + t.data().name;
                            },
                        }),
                        type: "column",
                        renderer: function (t, e, s) {
                            s = $.map(s, function (t, e) {
                                return "" !== t.title
                                    ? '<tr data-dt-row="' +
                                          t.rowIndex +
                                          '" data-dt-column="' +
                                          t.columnIndex +
                                          '"><td>' +
                                          t.title +
                                          ":</td> <td>" +
                                          t.data +
                                          "</td></tr>"
                                    : "";
                            }).join("");
                            return (
                                !!s &&
                                $('<table class="table"/><tbody />').append(s)
                            );
                        },
                    },
                },
                initComplete: function () {
                    this.api()
                        .columns(-2)
                        .every(function () {
                            var e = this,
                                s = $(
                                    '<select id="ProductStatus" class="selectTable form-select text-capitalize"><option value="">Status</option></select>'
                                )
                                    .appendTo(".product_status")
                                    .on("change", function () {
                                        var t = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );
                                        e.search(
                                            t ? "^" + t + "$" : "",
                                            !0,
                                            !1
                                        ).draw();
                                    });
                            e.data()
                                .unique()
                                .sort()
                                .each(function (t, e) {
                                    s.append(
                                        '<option value="' +
                                            a[t].title +
                                            '">' +
                                            a[t].title +
                                            "</option>"
                                    );
                                });
                        }),
                        this.api()
                            .columns(4)
                            .every(function () {
                                var e = this,
                                    s = $(
                                        '<select id="ProductCategory" class="selectTable form-select text-capitalize"><option value="">Categoria</option></select>'
                                    )
                                        .appendTo(".product_category")
                                        .on("change", function () {
                                            var t =
                                                $.fn.dataTable.util.escapeRegex(
                                                    $(this).val()
                                                );
                                            e.search(
                                                t ? "^" + t + "$" : "",
                                                !0,
                                                !1
                                            ).draw();
                                        });
                                e.data()
                                    .unique()
                                    .sort()
                                    .each(function (t, e) {
                                        s.append(
                                            '<option value="' +
                                                t +
                                                '">' +
                                                t +
                                                "</option>"
                                        );
                                    });
                            }),
                        this.api()
                            .columns(5)
                            .every(function () {
                                var e = this,
                                    s = $(
                                        '<select id="ProductSubCategory" class="selectTable form-select text-capitalize"><option value=""> SubCategorias </option></select>'
                                    )
                                        .appendTo(".product_subcategory")
                                        .on("change", function () {
                                            var t =
                                                $.fn.dataTable.util.escapeRegex(
                                                    $(this).val()
                                                );
                                            e.search(
                                                t ? "^" + t + "$" : "",
                                                !0,
                                                !1
                                            ).draw();
                                        });
                                e.data()
                                    .unique()
                                    .sort()
                                    .each(function (t, e) {
                                        s.append(
                                            '<option value="' +
                                                t +
                                                '">' +
                                                t +
                                                "</option>"
                                        );
                                    });
                            });
                    let o = $(".selectTable");
                    o.each(function () {
                        var t = $(this);
                        select2Focus(t),
                            t
                                .wrap('<div class="position-relative"></div>')
                                .select2({
                                    dropdownParent: t.parent(),
                                    placeholder: t.data("placeholder"),
                                });
                    });
                },
            }),
            $(".dataTables_length").addClass("mt-0 mt-md-3"),
            $(".dt-action-buttons").addClass("pt-0"),
            $(".dt-buttons").addClass("d-flex flex-wrap")),
        setTimeout(() => {
            $(".dataTables_filter .form-control").removeClass(
                "form-control-sm"
            ),
                $(".dataTables_length .form-select").removeClass(
                    "form-select-sm"
                );
        }, 300);

    $(".btn-modal").on("click", function () {
        changeLabel(
            "Agregar Nuevo Producto",
            "Agregar nuevo producto para reservas",
            "Guardar"
        );
    });

    $("#category").change(function () {
        var categoryId = $(this).val();
        searchSubcategory(categoryId);
    });

    $("#productModal").on("hidden.bs.modal", function () {
        resetForm();
    });

    t.on("click", ".datatable_edit", function () {
        let row = $(this).closest("tr");
        let rowData = $(this).closest("table").DataTable().row(row).data();

        changeLabel(
            "Editar Producto",
            "Editar producto para reservas",
            "Editar"
        );

        $("#product_id").val(rowData.id);
        $("#category").val(rowData.category_id).trigger("change");
        $("#product").val(rowData.name);
        $("#description .ql-editor").html(rowData.description);
        $("#pricelj").val(rowData.pricelj);
        $("#pricefds").val(rowData.pricefds);
        $("#stock").val(rowData.stock);
        $("#limit").val(rowData.guest);

        $("#productModal").modal("show");
        $("#subcategory").val(rowData.subcategory_id).trigger("change");
    });

    const f = document.getElementById("productForm");

    const fv = FormValidation.formValidation(f, {
        fields: {
            category: {
                validators: {
                    notEmpty: { message: "Selecciona una categoría" },
                },
            },
            subcategory: {
                validators: {
                    notEmpty: { message: "Selecciona una subcategoría" },
                },
            },
            product: {
                validators: {
                    notEmpty: { message: "Ingresa un nombre de producto" },
                },
            },
            price: {
                validators: {
                    notEmpty: { message: "Ingresa un precio" },
                },
            },
            stock: {
                validators: {
                    notEmpty: { message: "Ingresa la cantidad de stock" },
                },
            },
            limit: {
                validators: {
                    notEmpty: { message: "Ingresa el límite de personas" },
                },
            },
        },

        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: "is-valid",
                rowSelector: function (t, e) {
                    switch (e) {
                        case "formValidationName":
                        case "formValidationEmail":
                        case "formValidationPass":
                        case "formValidationConfirmPass":
                        case "formValidationFile":
                        case "formValidationDob":
                        case "formValidationSelect2":
                        case "formValidationLang":
                        case "formValidationTech":
                        case "formValidationHobbies":
                        case "formValidationBio":
                        case "formValidationGender":
                            return ".col-md-6";
                        case "formValidationPlan":
                            return ".col-xl-3";
                        case "formValidationSwitch":
                        case "formValidationCheckbox":
                            return ".col-12";
                        default:
                            return ".row";
                    }
                },
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus(),
        },
    });

    fv.on("core.form.valid", function () {
        const method = $("#titleModal").text();
        if (method == "Editar Producto") {
            updateDataServe();
        } else {
            sendDataServe();
        }
    });

    function sendDataServe() {
        blockUI();

        let formData = new FormData(f),
            description = $("#description .ql-editor").html();
        formData.append("description", description);
        formData.append("_token", csrfToken);

        fetch("newProduct", {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Error en la solicitud");
                }
                return response.json();
            })
            .then((data) => {
                t.DataTable().ajax.reload();
                Toast.fire({
                    icon: data.icon,
                    title: data.message,
                });
                $("#productModal").modal("hide");
            })
            .catch((error) => {
                console.error("Error:", error);
            })
            .finally(() => {
                $.unblockUI();
            });
    }

    function updateDataServe() {
        blockUI();

        let formData = new FormData(f),
            description = $("#description .ql-editor").html();
        formData.append("description", description);
        formData.append("_token", csrfToken);

        fetch("editProduct", {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Error en la solicitud");
                }
                return response.json();
            })
            .then((data) => {
                t.DataTable().ajax.reload();
                Toast.fire({
                    icon: data.icon,
                    title: data.message,
                });
                $("#productModal").modal("hide");
            })
            .catch((error) => {
                console.error("Error:", error);
            })
            .finally(() => {
                $.unblockUI();
            });
    }

    function resetForm() {
        clearEditorContent();
        fv.resetForm(true);
        f.reset();

        $("#category").val(null).trigger("change");
    }

    function changeLabel(title, message, button) {
        $("#titleModal").text(title);
        $("#messageModal").text(message);
        $(".btn-send").text(button);
    }

    function blockUI() {
        $.blockUI({
            message:
                '<div class="sk-wave mx-auto"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div>',
            css: { backgroundColor: "transparent", border: "0" },
            overlayCSS: { opacity: 0.5 },
        });
    }

    function searchSubcategory(category, id) {
        $.ajax({
            url: "selectSubCat",
            method: "POST",
            data: { category_id: category },
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            dataType: "json",
            async: false,
        })
            .done((data) => {
                $("#subcategory").empty();

                $.each(data, function (index, subcategory) {
                    $("#subcategory").append(
                        $("<option>", {
                            value: subcategory.id,
                            text: subcategory.name,
                        })
                    );
                });
            })
            .fail((error) => {
                console.log(error.responseText);
            })
            .always(() => {});
    }

    function clearEditorContent() {
        const commentEditor = document.querySelector(".comment-editor");
        if (commentEditor) {
            const quill = new Quill(commentEditor, {
                modules: { toolbar: ".comment-toolbar" },
                placeholder: "Ingrese la descripción del producto...",
                theme: "snow",
            });
            quill.setText("");
        }
    }

    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
    });
});
