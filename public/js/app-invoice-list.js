"use strict";
$(function () {
    var a,
        e = $(".invoice-list-table"),
        csrf_token = $('meta[name="csrf-token"]').attr("content"),
        o = $(".select2");
    o.length &&
        o.each(function () {
            var t = $(this);
            select2Focus(t),
                t.wrap('<div class="position-relative"></div>').select2({
                    dropdownParent: t.parent(),
                    placeholder: t.data("placeholder"),
                });
        }),
        e.length &&
            (a = e.DataTable({
                ajax: assetsPath + "json/invoice-list.json",
                columns: [
                    { data: "" },
                    { data: "invoice_id" },
                    { data: "invoice_id" },
                    { data: "invoice_status" },
                    { data: "issued_date" },
                    { data: "client_name" },
                    { data: "total" },
                    { data: "balance" },
                    { data: "invoice_status" },
                    { data: "action" },
                ],
                columnDefs: [
                    {
                        className: "control",
                        responsivePriority: 2,
                        searchable: !1,
                        targets: 0,
                        render: function (a, e, t, s) {
                            return "";
                        },
                    },
                    {
                        targets: 1,
                        orderable: !1,
                        render: function () {
                            return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                        },
                        checkboxes: {
                            selectAllRender:
                                '<input type="checkbox" class="form-check-input">',
                        },
                    },
                    {
                        targets: 2,
                        render: function (a, e, t, s) {
                            return (
                                '<a href="app-invoice-preview.html"><span>#' +
                                t.invoice_id +
                                "</span></a>"
                            );
                        },
                    },
                    {
                        targets: 3,
                        render: function (a, e, t, s) {
                            var n = t.invoice_status,
                                i = t.due_date;
                            return (
                                "<div class='d-inline-flex' data-bs-toggle='tooltip' data-bs-html='true' title='<span>" +
                                n +
                                '<br> <span class="fw-medium">Balance:</span> ' +
                                t.balance +
                                '<br> <span class="fw-medium">Due Date:</span> ' +
                                i +
                                "</span>'>" +
                                {
                                    Sent: '<span class="avatar avatar-sm"> <span class="avatar-initial rounded-circle bg-label-secondary"><i class="mdi mdi-email-outline"></i></span></span>',
                                    Draft: '<span class="avatar avatar-sm"> <span class="avatar-initial rounded-circle bg-label-primary"><i class="mdi mdi-folder-outline"></i></span></span>',
                                    "Past Due":
                                        '<span class="avatar avatar-sm"> <span class="avatar-initial rounded-circle bg-label-danger"><i class="mdi mdi-alert-circle-outline"></i></span></span>',
                                    "Partial Payment":
                                        '<span class="avatar avatar-sm"> <span class="avatar-initial rounded-circle bg-label-success"><i class="mdi mdi-check"></i></span></span>',
                                    Paid: '<span class="avatar avatar-sm"> <span class="avatar-initial rounded-circle bg-label-warning"><i class="mdi mdi-chart-pie-outline"></i></span></span>',
                                    Downloaded:
                                        '<span class="avatar avatar-sm"> <span class="avatar-initial rounded-circle bg-label-info"><i class="mdi mdi-arrow-down"></i></span></span>',
                                }[n] +
                                "</div>"
                            );
                        },
                    },
                    {
                        targets: 4,
                        responsivePriority: 4,
                        render: function (a, e, t, s) {
                            return "as";
                        },
                    },
                    {
                        targets: 5,
                        render: function (a, e, t, s) {
                            return "<span>$" + t.total + "</span>";
                        },
                    },
                    {
                        targets: 6,
                        render: function (a, e, t, s) {
                            t = new Date(t.due_date);
                            return (
                                '<span class="d-none">' +
                                moment(t).format("YYYYMMDD") +
                                "</span>" +
                                moment(t).format("DD MMM YYYY")
                            );
                        },
                    },
                    {
                        targets: 7,
                        orderable: !1,
                        render: function (a, e, t, s) {
                            t = t.balance;
                            return 0 === t
                                ? '<span class="badge rounded-pill bg-label-success" text-capitalized> Paid </span>'
                                : '<span class="text-heading">' + t + "</span>";
                        },
                    },
                    { targets: 8, visible: !1 },
                    {
                        targets: -1,
                        title: "Actions",
                        searchable: !1,
                        orderable: !1,
                        render: function (a, e, t, s) {
                            return '<div class="d-flex align-items-center"><a href="javascript:;" data-bs-toggle="tooltip" class="text-body delete-record" data-bs-placement="top" title="Delete Invoice"><i class="mdi mdi-delete-outline mdi-20px mx-1"></i></a><a href="app-invoice-preview.html" data-bs-toggle="tooltip" class="text-body" data-bs-placement="top" title="Preview Invoice"><i class="mdi mdi-eye-outline mdi-20px mx-1"></i></a><div class="dropdown"><a href="javascript:;" class="btn dropdown-toggle hide-arrow text-body p-0" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical mdi-20px"></i></a><div class="dropdown-menu dropdown-menu-end"><a href="javascript:;" class="dropdown-item">Download</a><a href="app-invoice-edit.html" class="dropdown-item">Edit</a><a href="javascript:;" class="dropdown-item">Duplicate</a></div></div></div>';
                        },
                    },
                ],
                order: [[2, "desc"]],
                dom: '<"row mx-1"<"col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-3"l<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3"B>><"col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3"f<"invoice_status mb-3 mb-md-0">>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                language: {
                    sLengthMenu: "Show _MENU_",
                    search: "",
                    searchPlaceholder: "Buscar Cupon",
                },
                buttons: [
                    {
                        text: '<i class="mdi mdi-plus me-md-1"></i><span class="d-md-inline-block d-none">Generar Cupon</span>',
                        className: "btn btn-primary waves-effect waves-light",
                        action: function (a, e, t, s) {
                            $("#coupon-modal").modal("show");
                        },
                    },
                ],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (a) {
                                return "Details of " + a.data().full_name;
                            },
                        }),
                        type: "column",
                        renderer: function (a, e, t) {
                            t = $.map(t, function (a, e) {
                                return "" !== a.title
                                    ? '<tr data-dt-row="' +
                                          a.rowIndex +
                                          '" data-dt-column="' +
                                          a.columnIndex +
                                          '"><td>' +
                                          a.title +
                                          ":</td> <td>" +
                                          a.data +
                                          "</td></tr>"
                                    : "";
                            }).join("");
                            return (
                                !!t &&
                                $('<table class="table"/><tbody />').append(t)
                            );
                        },
                    },
                },
                initComplete: function () {
                    this.api()
                        .columns(8)
                        .every(function () {
                            var e = this,
                                t = $(
                                    '<select id="UserRole" class="form-select"><option value=""> Select Status </option></select>'
                                )
                                    .appendTo(".invoice_status")
                                    .on("change", function () {
                                        var a = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );
                                        e.search(
                                            a ? "^" + a + "$" : "",
                                            !0,
                                            !1
                                        ).draw();
                                    });
                            e.data()
                                .unique()
                                .sort()
                                .each(function (a, e) {
                                    t.append(
                                        '<option value="' +
                                            a +
                                            '" class="text-capitalize">' +
                                            a +
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
        $(".invoice-list-table tbody").on(
            "click",
            ".delete-record",
            function () {
                $(this).closest(
                    $('[data-bs-toggle="tooltip"]').tooltip("hide")
                ),
                    a.row($(this).parents("tr")).remove().draw();
            }
        ),
        setTimeout(() => {
            $(".dataTables_filter .form-control").removeClass(
                "form-control-sm"
            ),
                $(".dataTables_length .form-select").removeClass(
                    "form-select-sm"
                );
        }, 300);

    const typeC = $("#typeC"),
        iconC = $(".iconC"),
        k = document.querySelector("#startDate"),
        w = document.querySelector("#endDate"),
        urlMap = {
            "Editar Cupón": "updateCoupon",
            "Crear Cupón": "createCoupon",
        },
        az = $("#description");
    az && autosize(az),
        k &&
            k.flatpickr({
                altFormat: "Y-m-dTH",
                onReady: function (e, t, n) {
                    n.isMobile && n.mobileInput.setAttribute("step", null);
                },
            });
    w &&
        w.flatpickr({
            altFormat: "Y-m-dTH",
            onReady: function (e, t, n) {
                n.isMobile && n.mobileInput.setAttribute("step", null);
            },
        });

    const iconMap = {
        fixed: "S/. ",
        percentage: "%",
    };

    $(".btn-codeCoupon").on("click", function () {
        $.get("CodeCoupon", { _token: csrf_token }, function (data) {
            $("#code").val(data.code);
        });
    });

    $("#typeC").on("change", function () {
        updateIcon(this.value);
    });

    $("#coupon-modal").on("hidden.bs.modal", function () {
        resetForm();
    });

    const f = document.getElementById("coupon-form");

    const fv = FormValidation.formValidation(f, {
        fields: {
            subcategories: {
                validators: {
                    notEmpty: { message: "Seleccionar subcategoria (as)" },
                },
            },
            code: {
                validators: {
                    notEmpty: { message: "Ingresar código de cupón" },
                },
            },
            quantity: {
                validators: {
                    notEmpty: { message: "Ingresar cantidad de cupones" },
                },
            },
            discount: {
                validators: {
                    notEmpty: { message: "Ingresar descuento" },
                },
            },
            startDate: {
                validators: {
                    notEmpty: { message: "Ingresar fecha de inicio" },
                },
            },
            endDate: {
                validators: {
                    notEmpty: {
                        message: "Ingresar fecha finalizado",
                    },
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
        sendDataServe(urlMap[method]);
    });

    /**
     * Envía datos al servidor mediante una solicitud POST.
     * @param {string} url - La URL del servidor al que se enviarán los datos.
     */
    function sendDataServe(url) {
        // Bloquea la interfaz de usuario mientras se realiza la solicitud.
        blockUI();

        // Crea un objeto FormData a partir del formulario 'f'.
        let formData = new FormData(f);

        // Realiza la solicitud fetch al servidor.
        fetch(url, {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Error en la solicitud"); // Manejo de errores
                }
                return response.json();
            })
            .then((data) => {
                // Actualiza la tabla DataTable (asegúrate de que 'a' y 'DataTable' estén correctamente definidos).
                a.ajax.reload();

                // Muestra una notificación con el ícono y el mensaje proporcionados por el servidor.
                Toast.fire({
                    icon: data.icon,
                    title: data.message,
                });

                // Oculta el modal de producto.
                $("#coupon-modal").modal("hide");
            })
            .catch((error) => {
                console.error("Error:", error.message);
            })
            .finally(() => {
                // Desbloquea la interfaz de usuario.
                $.unblockUI();
            });
    }

    function resetForm() {}

    function updateIcon(value) {
        if (iconMap.hasOwnProperty(value)) {
            iconC.html(iconMap[value]);
        } else {
            iconC.html("");
        }
    }
    function blockUI() {
        $.blockUI({
            message:
                '<div class="sk-wave mx-auto"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div>',
            css: { backgroundColor: "transparent", border: "0" },
            overlayCSS: { opacity: 0.5 },
        });
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
