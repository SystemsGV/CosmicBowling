"use strict";
$(function () {
    var e,
        t = $(".datatables-permissions"),
        l = "app-user-list.html",
        m = $("#modalHoliday");
    flatpickr(".flatpickr-tim", {
        dateFormat: "Y-m-d",
        time_24hr: false,
    }),
        t.length &&
            (e = t.DataTable({
                ajax: "tableHolidays",
                columns: [
                    { data: "" },
                    { data: "id" },
                    { data: "name" },
                    { data: "holiday" },
                    { data: "status" },
                    { data: "" },
                ],
                columnDefs: [
                    {
                        className: "control",
                        orderable: !1,
                        searchable: !1,
                        responsivePriority: 2,
                        targets: 0,
                        render: function (e, t, a, n) {
                            return "";
                        },
                    },
                    { targets: 1, searchable: !1, visible: !1 },
                    {
                        targets: 2,
                        render: function (e, t, a, n) {
                            return e;
                        },
                    },
                    {
                        targets: 3,
                        orderable: !1,
                        className: "text-center",
                        render: function (e, t, a, n) {
                            return e;
                        },
                    },
                    {
                        targets: 4,
                        orderable: !1,
                        className: "text-center",
                        render: function (e, t, a, n) {
                            const checkedAttribute = e === 1 ? "checked" : "";
                            return (
                                '<label class="switch switch-lg"><input type="checkbox" class="switch-input btn-status" ' +
                                checkedAttribute +
                                '><span class="switch-toggle-slider"><span class="switch-on"></span><span class="switch-off"></span></span></label>'
                            );
                        },
                    },
                    {
                        targets: -1,
                        searchable: !1,
                        className: "text-center",
                        title: "Acciones",
                        searchable: !1,
                        orderable: !1,
                        render: function (e, t, a, n) {
                            return '<a href="javascript:;" data-bs-toggle="tooltip" class="text-body datatable_edit" data-bs-placement="top" title="Editar Feriado"><i class="mdi mdi-square-edit-outline mdi-28px mx-1"></i></a>';
                        },
                    },
                ],
                order: [[1, "asc"]],
                dom: '<"row mx-1"<"col-sm-12 col-md-3" l><"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                language: {
                    sLengthMenu: "Show _MENU_",
                    search: "Search",
                    searchPlaceholder: "Search..",
                },
                buttons: [
                    {
                        text: "<i class='mdi mdi-calendar-plus-outline'></i> Agregar Feriado",
                        className:
                            "add-new btn btn-primary mb-3 mb-md-0 waves-effect waves-light",
                        attr: {
                            "data-bs-toggle": "modal",
                            "data-bs-target": "#modalHoliday",
                        },
                        init: function (e, t, a) {
                            $(t).removeClass("btn-secondary");
                            $("#titleModal").text("Agregar Feriado");
                        },
                    },
                ],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (e) {
                                return "Detalles de " + e.data().name;
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
                initComplete: function () {
                    this.api()
                        .columns(3)
                        .every(function () {
                            var t = this,
                                a = $(
                                    '<select id="UserRole" class="form-select text-capitalize"><option value=""> Select Role </option></select>'
                                )
                                    .appendTo(".user_role")
                                    .on("change", function () {
                                        var e = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );
                                        t.search(
                                            e ? "^" + e + "$" : "",
                                            !0,
                                            !1
                                        ).draw();
                                    });
                            t.data()
                                .unique()
                                .sort()
                                .each(function (e, t) {
                                    a.append(
                                        '<option value="' +
                                            e +
                                            '" class="text-capitalize">' +
                                            e +
                                            "</option>"
                                    );
                                });
                        });
                },
            })),
        e.on("draw.dt", function () {
            [].slice
                .call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                .map(function (a) {
                    return new bootstrap.Tooltip(a, {
                        boundary: document.body,
                    });
                });
        }),
        $(".datatables-permissions tbody").on(
            "click",
            ".delete-record",
            function () {
                e.row($(this).parents("tr")).remove().draw();
            }
        );
    m.on("hidden.bs.modal", function () {
        resetForm();
    });

    e.on("click", ".datatable_edit", function () {
        let rows = $(this).closest("tr"),
            row = rows.closest("table").DataTable().row(rows).data();
        $("#titleModal").text("Editar Feriado");
        $("#idH").val(row.id);
        $("#nameH").val(row.name);
        $("#dateH").val(row.holiday);
        m.modal("show");
    });

    e.on("click", ".btn-status", function () {
        let row = $(this).closest("tr");
        let rowData = $(this).closest("table").DataTable().row(row).data(),
            isChecked = $(this).prop("checked");

        let id = rowData.id,
            status = isChecked ? "1" : "0";

        let csrfToken = $('meta[name="csrf-token"]').attr("content");
        let formData = {
            id: id,
            status: status,
            _token: csrfToken, // Agregar el token CSRF aquí
        };

        $.ajax({
            url: "statusHoliday",
            method: "POST",
            data: formData,
            dataType: "json",
        })
            .done(function (response) {
                Toast.fire({
                    icon: response.icon,
                    title: response.message,
                });
            })
            .fail(function (xhr, status, error) {
                console.error("Hubo un error en la solicitud AJAX:", error);
            });
    });

    const f = document.getElementById("formHoliday"),
        urlMap = {
            "Editar Feriado": "updateHoliday",
            "Agregar Feriado": "createHoliday",
        };

    const fv = FormValidation.formValidation(f, {
        fields: {
            nameH: {
                validators: {
                    notEmpty: { message: "Ingresar código de cupón" },
                },
            },
            dateH: {
                validators: {
                    notEmpty: { message: "Ingresar cantidad de cupones" },
                },
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: "is-valid",
                eleInvalidClass: "is-invalid",
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
        sendDataServe(urlMap[method]);
    });

    function sendDataServe(url) {
        blockUI();

        let formData = new FormData(f);

        fetch(url, {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    return response.json().then((errorData) => {
                        throw new Error(
                            errorData.message || "Error en la solicitud"
                        );
                    });
                }
                return response.json();
            })
            .then((data) => {
                e.ajax.reload();
                Toast.fire({
                    icon: data.icon,
                    title: data.message,
                });

                m.modal("hide");
            })
            .catch((error) => {
                Toast.fire({
                    icon: "error",
                    title: "Contactar con sistemas",
                });
                console.error("Error:", error.message);
            })
            .finally(() => {
                $.unblockUI();
            });
    }

    function blockUI() {
        $.blockUI({
            message:
                '<div class="sk-wave mx-auto"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div>',
            css: { backgroundColor: "transparent", border: "0" },
            overlayCSS: { opacity: 0.5 },
        });
    }

    function resetForm() {
        f.reset();
        fv.resetForm(true);
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
