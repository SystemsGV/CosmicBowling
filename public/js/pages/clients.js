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
    var e,
        s = $(".datatables-users"),
        i = $(".select2"),
        l = "app-user-view-account.html",
        o = {
            0: { title: "Pending", class: "bg-label-warning" },
            1: { title: "Active", class: "bg-label-success" },
        };
    i.length &&
        ((i = i),
            select2Focus(i),
            i.wrap('<div class="position-relative"></div>').select2({
                placeholder: "Select Country",
                dropdownParent: i.parent(),
            })),
        s.length &&
        (e = s.DataTable({
            ajax: "tableClients",
            columns: [
                { data: "id" },
                { data: "names" },
                { data: "type_doc" },
                { data: "number_doc" },
                { data: "email" },
                { data: "phone" },
                { data: "address" },
                { data: "status" },
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
                    targets: 7,
                    render: function (e, t, a, n) {
                        return e === "Validado"
                            ? "<div class='d-inline-flex' data-bs-toggle='tooltip' data-bs-html='true' title='Validado " +
                            moment(a.verified).format(
                                "DD/MM/YYYY HH:mm:ss"
                            ) +
                            "'>" +
                            '<span class="badge rounded-pill bg-label-success">' +
                            e +
                            "</span>" +
                            "</div>"
                            : "<div class='d-inline-flex' data-bs-toggle='tooltip' data-bs-html='true' title='No validado'>" +
                            '<span class="avatar avatar-sm"> <span class="avatar-initial rounded-circle bg-label-danger"><i class="mdi mdi-alert-outline"></i></span></span>' +
                            "</div>";
                    },
                },
            ],
            order: [[2, "desc"]],
            dom: '<"row mx-2"<"col-md-2"<"me-3"l>><"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0 gap-3"fB>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                sLengthMenu: "Show _MENU_",
                search: "",
                searchPlaceholder: "Search..",
            },
            buttons: [
                {
                    extend: "collection",
                    className:
                        "btn btn-label-secondary dropdown-toggle me-3 waves-effect waves-light",
                    text: '<i class="mdi mdi-export-variant me-1"></i> <span class="d-none d-sm-inline-block">Exportar</span>',
                    buttons: [
                        {
                            extend: "print",
                            text: '<i class="mdi mdi-printer-outline me-1" ></i>Print',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5],
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
                                                        : void 0 ===
                                                            t.innerText
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

                        // NIVEL 1 → botón Agregar Socio (AL MISMO NIVEL que el collection)

                        {
                            extend: "csv",
                            text: '<i class="mdi mdi-file-document-outline me-1" ></i>Csv',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5],
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
                                                        : void 0 ===
                                                            t.innerText
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
                                columns: [1, 2, 3, 4, 5],
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
                                                        : void 0 ===
                                                            t.innerText
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
                                columns: [1, 2, 3, 4, 5],
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
                                                        : void 0 ===
                                                            t.innerText
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
                                columns: [1, 2, 3, 4, 5],
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
                                                        : void 0 ===
                                                            t.innerText
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
                    text: '<i class="mdi mdi-plus me-1"></i> Agregar Socio',
                    className: 'btn btn-primary waves-effect waves-light',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#addNewCoupon'
                    }
                }
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
            initComplete: function () {
                this.api()
                    .columns(2)
                    .every(function () {
                        var t = this,
                            a = $(
                                '<select id="UserPlan" class="form-select text-capitalize"><option value="">Filtra por documento</option></select>'
                            )
                                .appendTo(".user_plan")
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
                                    '">' +
                                    e +
                                    "</option>"
                                );
                            });
                    }),
                    this.api()
                        .columns(7)
                        .every(function () {
                            var t = this,
                                a = $(
                                    '<select id="FilterTransaction" class="form-select text-capitalize"><option value="">Filtra por estado</option></select>'
                                )
                                    .appendTo(".user_status")
                                    .on("change", function () {
                                        var e =
                                            $.fn.dataTable.util.escapeRegex(
                                                $(this).val()
                                            );
                                        // Aplicar el filtro según el valor seleccionado
                                        t.search(
                                            e ? "^" + e + "$" : "", // Buscar solo el valor exacto
                                            true, // Usar regex para la búsqueda
                                            false // Ignorar la búsqueda de palabras
                                        ).draw();
                                    });
                            // Agregar opciones al select
                            t.data()
                                .unique()
                                .sort()
                                .each(function (d) {
                                    a.append(
                                        '<option value="' +
                                        d +
                                        '" class="text-capitalize">' +
                                        d +
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
        setTimeout(() => {
            $(".dataTables_filter .form-control").removeClass(
                "form-control-sm"
            ),
                $(".dataTables_length .form-select").removeClass(
                    "form-select-sm"
                );
        }, 300);



    // nueva logica
    function blockUI() {
        $.blockUI({
            message: '<div class="sk-wave mx-auto"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div>',
            css: { backgroundColor: "transparent", border: "0" },
            overlayCSS: { opacity: 0.5 },
        });
    }

    const Toast = Swal.mixin({
        toast: true,
        position: "top",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
    });

    let today = new Date();
    let day = String(today.getDate()).padStart(2, "0");
    let month = String(today.getMonth() + 1).padStart(2, "0");
    let year = today.getFullYear();
    let formattedDate = `${day}-${month}-${year}`;

    const f = document.getElementById("partnerForm");

    const fv = FormValidation.formValidation(f, {
        fields: {
            pattername: {
                validators: {
                    notEmpty: { message: "Ingresa el apellido paterno" },
                    regexp: {
                        regexp: /^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/,
                        message: "Solo se permiten letras"
                    }
                }
            },
            mattername: {
                validators: {
                    notEmpty: { message: "Ingresa el apellido materno" },
                    regexp: {
                        regexp: /^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/,
                        message: "Solo se permiten letras"
                    }
                }
            },
            names: {
                validators: {
                    notEmpty: { message: "Ingresa los nombres" },
                    regexp: {
                        regexp: /^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/,
                        message: "Solo se permiten letras"
                    }
                }
            },
            doc: {
                validators: {
                    notEmpty: {
                        message: "Ingresa el Nº documento del socio",
                    },
                },
            },
            birthdate: {
                validators: {
                    notEmpty: {
                        message: "Ingresa la fecha de nacimiento"
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'El formato debe ser Año-Mes-Día (Ej: 1998-03-25)'
                    }
                }
            },
            affiliation: {
                validators: {
                    notEmpty: { message: "Ingresa la ficha de afiliación" }
                }
            },
            initdate: {
                validators: {
                    notEmpty: { message: "Ingresa la fecha de inicio" },
                },
            },
            enddate: {
                validators: {
                    notEmpty: { message: "Ingresa la fecha de vencimiento" },
                },
            },
            address: {
                validators: {
                    notEmpty: { message: "Ingresa la dirección" }
                }
            },
            phone: {
                validators: {
                    notEmpty: { message: "Ingresa el número de celular" },
                }
            },
            mail: {
                validators: {
                    notEmpty: { message: "Ingresa el e-mail" },
                    emailAddress: { message: "Ingresa un e-mail válido" },
                    regexp: {
                        regexp: /^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/,
                        message: "El formato del e-mail no es válido (Ej: usuario@gmail.com)"
                    }
                }
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({ eleValidClass: "is-valid" }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus(),
        },
    });

    fv.on("core.form.valid", function () {
        blockUI();

        const csrfToken = $('meta[name="csrf-token"]').attr("content");
        let formData = new FormData(f);

        fetch("/api/insertSocio", {
            method: "POST",
            headers: { "X-CSRF-TOKEN": csrfToken },
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                Toast.fire({ icon: data.icon, title: data.message });
                if (data.icon === "success") {
                    $("#addNewCoupon").modal("hide");
                    fv.resetForm(true);
                }
            })
            .catch((error) => {
                Toast.fire({ icon: "error", title: "Error al registrar socio" });
                console.error(error);
            })
            .finally(() => { $.unblockUI(); });
    });


    //setear fecha automatica
    $("#initdate").flatpickr({
        dateFormat: "d-m-Y",
        defaultDate: today,
        locale: {
            firstDayOfWeek: 1,
            rangeSeparator: " Hasta ",
            weekdays: {
                shorthand: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                longhand: [
                    "Domingo",
                    "Lunes",
                    "Martes",
                    "Miércoles",
                    "Jueves",
                    "Viernes",
                    "Sábado",
                ],
            },
            months: {
                shorthand: [
                    "Ene",
                    "Feb",
                    "Mar",
                    "Abr",
                    "May",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dic",
                ],
                longhand: [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre",
                ],
            },
        },
        onChange: function (selectedDates) {
            if (selectedDates.length > 0) {
                let startDate = new Date(selectedDates[0]);
                let endDate = new Date(startDate);

                // Sumar 1 año y restar 1 día
                endDate.setFullYear(endDate.getFullYear() + 1);
                endDate.setDate(endDate.getDate() - 1);

                // Obtener día, mes y año correctamente formateados
                let day = String(endDate.getDate()).padStart(2, "0"); // 01-31
                let month = String(endDate.getMonth() + 1).padStart(2, "0"); // 01-12
                let year = endDate.getFullYear(); // YYYY

                let formattedEndDate = `${day}-${month}-${year}`; // Formato d-m-Y

                // Establecer valor en el input de vencimiento
                $("#enddate").val(formattedEndDate);
            }
        },
    });

    $("#enddate").flatpickr({
        dateFormat: "d-m-Y",
        defaultDate: formattedDate,
        locale: {
            firstDayOfWeek: 1,
            rangeSeparator: " Hasta ",
            weekdays: {
                shorthand: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
                longhand: [
                    "Domingo",
                    "Lunes",
                    "Martes",
                    "Miércoles",
                    "Jueves",
                    "Viernes",
                    "Sábado",
                ],
            },
            months: {
                shorthand: [
                    "Ene",
                    "Feb",
                    "Mar",
                    "Abr",
                    "May",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dic",
                ],
                longhand: [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre",
                ],
            },
        },
    });

});
