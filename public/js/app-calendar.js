"use strict";
let direction = "ltr";
isRtl && (direction = "rtl"),
    document.addEventListener("DOMContentLoaded", function () {
        {
            const v = document.getElementById("calendar"),
                m = document.querySelector(".app-calendar-sidebar"),
                p = document.getElementById("addEventSidebar"),
                f = document.querySelector(".app-overlay"),
                g = {
                    Business: "primary",
                    Holiday: "success",
                    Personal: "danger",
                    Family: "warning",
                    ETC: "info",
                },
                b = document.querySelector(".offcanvas-title"),
                h = document.querySelector(".btn-toggle-sidebar"),
                y = document.querySelector('button[type="submit"]'),
                S = document.querySelector(".btn-delete-event"),
                L = document.querySelector(".btn-cancel"),
                E = document.querySelector("#eventTitle"),
                k = document.querySelector("#eventStartDate"),
                w = document.querySelector("#eventEndDate"),
                q = $("#eventLabel"),
                M = document.querySelector("#eventPrice"),
                A = document.querySelector(".select-all"),
                F = [].slice.call(document.querySelectorAll(".input-filter")),
                Y = document.querySelector(".inline-calendar");
            let a,
                l = events,
                r = !1,
                e,
                fv;
            const C = new bootstrap.Offcanvas(p);
            function t(e) {
                return e.id
                    ? "<span class='badge badge-dot bg-" +
                          $(e.element).data("label") +
                          " me-2'> </span>" +
                          e.text
                    : e.text;
            }
            function n(e) {
                return e.id
                    ? "<div class='d-flex flex-wrap align-items-center'><div class='avatar avatar-xs me-2'><i class='" +
                          $(e.element).data("icon") +
                          "'></i> </div>" +
                          e.text +
                          "</div>"
                    : e.text;
            }
            var d, o;
            function s() {
                var e = document.querySelector(".fc-sidebarToggle-button");
                for (
                    e.classList.remove("fc-button-primary"),
                        e.classList.add("d-lg-none", "d-inline-block", "ps-0");
                    e.firstChild;

                )
                    e.firstChild.remove();
                e.setAttribute("data-bs-toggle", "sidebar"),
                    e.setAttribute("data-overlay", ""),
                    e.setAttribute("data-target", "#app-calendar-sidebar"),
                    e.insertAdjacentHTML(
                        "beforeend",
                        '<i class="mdi mdi-menu mdi-24px text-body"></i>'
                    );
            }
            q.length &&
                (select2Focus(q),
                q.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Seleccionar Subcategoria",
                    dropdownParent: q.parent(),
                    templateResult: t,
                    templateSelection: t,
                    minimumResultsForSearch: -1,
                    escapeMarkup: function (e) {
                        return e;
                    },
                })),
                k &&
                    (d = k.flatpickr({
                        enableTime: !0,
                        altFormat: "Y-m-dTH:i:S",
                        onReady: function (e, t, n) {
                            n.isMobile &&
                                n.mobileInput.setAttribute("step", null);
                        },
                    })),
                w &&
                    (o = w.flatpickr({
                        enableTime: !0,
                        altFormat: "Y-m-dTH:i:S",
                        onReady: function (e, t, n) {
                            n.isMobile &&
                                n.mobileInput.setAttribute("step", null);
                        },
                    })),
                Y &&
                    (e = Y.flatpickr({
                        monthSelectorType: "static",
                        inline: !0,
                    }));
            q.on("input", function () {
                let option = $(this).find("option:selected"),
                    lj = option.data("lj"),
                    fds = option.data("fds");

                let selectedDate = new Date(k.value);
                let dayOfWeek = selectedDate.getDay();

                blockUI();

                let promise;
                if (isWeekend(dayOfWeek)) {
                    promise = Promise.resolve(fds);
                } else {
                    promise = checkHoliday(k.value).then((isHoliday) =>
                        isHoliday ? fds : lj
                    );
                }

                promise
                    .then((price) => {
                        M.value = price;
                        console.log(price);
                    })
                    .catch((error) => {
                        console.error(
                            "Error al verificar el día feriado:",
                            error
                        );
                    })
                    .finally(() => {
                        $.unblockUI();
                    });
            });

            function isWeekend(dayOfWeek) {
                return dayOfWeek === 5 || dayOfWeek === 6 || dayOfWeek === 0;
            }

            let i = new Calendar(v, {
                initialView: "dayGridMonth",
                events: function (e, t) {
                    let n = (function () {
                        let t = [],
                            e = [].slice.call(
                                document.querySelectorAll(
                                    ".input-filter:checked"
                                )
                            );
                        return (
                            e.forEach((e) => {
                                t.push(e.getAttribute("data-value"));
                            }),
                            t
                        );
                    })();
                    t(
                        l.filter(function (e) {
                            return n.includes(
                                e.extendedProps.calendar.toLowerCase()
                            );
                        })
                    );
                },
                plugins: [
                    dayGridPlugin,
                    interactionPlugin,
                    listPlugin,
                    timegridPlugin,
                ],
                editable: !0,
                dragScroll: !0,
                dayMaxEvents: 2,
                eventResizableFromStart: !0,
                customButtons: { sidebarToggle: { text: "Sidebar" } },
                headerToolbar: {
                    start: "sidebarToggle, prev,next, title",
                    end: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
                },
                locale: "es",
                firstDay: 1,
                direction: direction,
                initialDate: new Date(),
                navLinks: !0,
                eventClassNames: function ({ event: e }) {
                    return ["fc-event-" + g[e._def.extendedProps.calendar]];
                },
                dateClick: function (e) {
                    const date = moment(e.date);
                    const formattedDate = date.format("YYYY-MM-DD");
                    const dayOfWeek = date.day();

                    // Mapeo de días de la semana a horas
                    const defaultHours = {
                        0: 13, // Domingo
                        1: 15, // Lunes
                        2: 15, // Martes
                        3: 15, // Miércoles
                        4: 15, // Jueves
                        5: 15, // Viernes
                        6: 13, // Sábado
                    };

                    const defaultHour = defaultHours[dayOfWeek]; // Obtener la hora predeterminada según el día de la semana

                    u(),
                        C.show(),
                        b && (b.innerHTML = "Agregar Evento"), // DOM Init Button
                        (y.innerHTML = "Agregar");
                    y.classList.remove("btn-update-event");
                    y.classList.add("btn-add-event");
                    S.classList.add("d-none");

                    k.value = date
                        .hour(defaultHour)
                        .minute(0)
                        .second(0)
                        .format("YYYY-MM-DD HH:mm");
                    w.value = date
                        .hour(23)
                        .minute(0)
                        .second(0)
                        .format("YYYY-MM-DD HH:mm");
                },
                eventClick: function (e) {
                    (e = e),
                        (a = e.event).url &&
                            (e.jsEvent.preventDefault(),
                            window.open(a.url, "_blank")),
                        C.show(),
                        b && (b.innerHTML = "Actualizar Evento"), // DOM Update OffCanvas
                        (y.innerHTML = "Actualizar"),
                        y.classList.add("btn-update-event"),
                        y.classList.remove("btn-add-event"),
                        S.classList.remove("d-none"),
                        (E.value = a.title),
                        d.setDate(a.start, !0, "Y-m-d"),
                        null !== a.end
                            ? o.setDate(a.end, !0, "Y-m-d")
                            : o.setDate(a.start, !0, "Y-m-d"),
                        q.val(a.extendedProps.calendar).trigger("change"),
                        void 0 !== a.extendedProps.price &&
                            (M.value = a.extendedProps.price);
                },
                datesSet: function () {
                    s();
                },
                viewDidMount: function () {
                    s();
                },
            });
            i.render(), s();
            var c = document.getElementById("eventForm");
            function u() {
                fv.resetForm();
                q.val(0).trigger("change");
                w.value = "";
                k.value = "";
                E.value = "";
                M.value = "";
            }

            (fv = FormValidation.formValidation(c, {
                fields: {
                    eventTitle: {
                        validators: {
                            notEmpty: {
                                message: "Obligatorio ingresar un titulo",
                            },
                        },
                    },
                    eventStartDate: {
                        validators: {
                            notEmpty: {
                                message: "Please enter start date ",
                            },
                        },
                    },
                    eventEndDate: {
                        validators: {
                            notEmpty: { message: "Please enter end date " },
                        },
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: "",
                        rowSelector: function (e, t) {
                            return ".mb-4";
                        },
                    }),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                },
            })
                .on("core.form.valid", function () {
                    r = !0;
                })
                .on("core.form.invalid", function () {
                    r = !1;
                })),
                h &&
                    h.addEventListener("click", (e) => {
                        L.classList.remove("d-none");
                    }),
                y.addEventListener("click", (e) => {
                    var t, n;
                    if (y.classList.contains("btn-add-event")) {
                        r &&
                            insert().then((newId) => {
                                n = {
                                    id: newId,
                                    title: E.value,
                                    start: k.value,
                                    end: w.value,
                                    startStr: k.value,
                                    endStr: w.value,
                                    display: "block",
                                    extendedProps: {
                                        calendar: q.val(),
                                        price: M.value,
                                    },
                                };
                                l.push(n);
                                i.refetchEvents();
                                C.hide();
                            });
                    } else {
                        r &&
                            ((n = {
                                id: a.id,
                                title: E.value,
                                start: k.value,
                                end: w.value,
                                extendedProps: {
                                    calendar: q.val(),
                                    price: M.value,
                                },
                                display: "block",
                                allDay: "0",
                            }),
                            ((t = n).id = parseInt(t.id)),
                            (l[l.findIndex((e) => e.id === t.id)] = t),
                            i.refetchEvents(),
                            C.hide(),
                            update(a.id));
                    }
                }),
                S.addEventListener("click", (e) => {
                    var t;
                    (t = parseInt(a.id)),
                        (l = l.filter(function (e) {
                            return e.id != t;
                        })),
                        i.refetchEvents(),
                        C.hide();
                }),
                p.addEventListener("hidden.bs.offcanvas", function () {
                    u();
                }),
                h.addEventListener("click", (e) => {
                    // DOM Insert OffCanvas
                    b && (b.innerHTML = "Agregar Evento"),
                        (y.innerHTML = "Agregar"),
                        y.classList.remove("btn-update-event"),
                        y.classList.add("btn-add-event"),
                        S.classList.add("d-none"),
                        m.classList.remove("show"),
                        f.classList.remove("show");
                }),
                A &&
                    A.addEventListener("click", (e) => {
                        e.currentTarget.checked
                            ? document
                                  .querySelectorAll(".input-filter")
                                  .forEach((e) => (e.checked = 1))
                            : document
                                  .querySelectorAll(".input-filter")
                                  .forEach((e) => (e.checked = 0)),
                            i.refetchEvents();
                    }),
                F &&
                    F.forEach((e) => {
                        e.addEventListener("click", () => {
                            document.querySelectorAll(".input-filter:checked")
                                .length <
                            document.querySelectorAll(".input-filter").length
                                ? (A.checked = !1)
                                : (A.checked = !0),
                                i.refetchEvents();
                        });
                    }),
                e.config.onChange.push(function (e) {
                    i.changeView(
                        i.view.type,
                        moment(e[0]).format("YYYY-MM-DD")
                    ),
                        s(),
                        m.classList.remove("show"),
                        f.classList.remove("show");
                });
        }
        let csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        function insert() {
            return new Promise((resolve, reject) => {
                let eventLabelSelect = document.getElementById("eventLabel"),
                    dataId =
                        eventLabelSelect.selectedOptions[0].getAttribute(
                            "data-id"
                        );

                let formData = new FormData(c);
                formData.append("data-id", dataId);

                fetch("insertHours", {
                    method: "POST",
                    body: formData,
                })
                    .then((response) => {
                        if (!response.ok) {
                            return response.json().then((errorData) => {
                                throw new Error(
                                    errorData.message ||
                                        "Hubo un problema al procesar el formulario."
                                );
                            });
                        }
                        return response.json();
                    })
                    .then((data) => {
                        if (data.status === "success") {
                            resolve(data.calendar_id); // Resolver la promesa con `calendar_id`
                        } else {
                            throw new Error(
                                data.message ||
                                    "Hubo un problema con la respuesta del servidor."
                            );
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error.message);
                        reject(error);
                    });
            });
        }
        function update(id) {
            console.log(id);
        }

        function checkHoliday(date) {
            return new Promise((resolve, reject) => {
                fetch("validateHoliday", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({ date: date }),
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
                        resolve(data);
                    })
                    .catch((error) => {
                        console.error("Error:", error.message);
                        reject(error);
                    });
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
    });
