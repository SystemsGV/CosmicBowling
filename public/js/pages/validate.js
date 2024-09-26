!(function () {
    var e = document.querySelectorAll(".phone-mask"),
        az = document.querySelector("#autosize-demo"),
        r = document.querySelectorAll(".dob-picker"),
        o = document.querySelectorAll(".form-check-input-payment");
    e &&
        e.forEach(function (e) {
            new Cleave(e, { phone: !0, phoneRegionCode: "US" });
        }),
        az && autosize(az),
        r &&
            r.forEach(function (e) {
                e.flatpickr({ monthSelectorType: "static" });
            }),
        o &&
            o.forEach(function (e) {
                e.addEventListener("change", function (e) {
                    "credit-card" === e.target.value
                        ? document
                              .querySelector("#form-credit-card")
                              .classList.remove("d-none")
                        : document
                              .querySelector("#form-credit-card")
                              .classList.add("d-none");
                });
            });
})(),
    $(function () {
        var e,
            t = $(".select2");
        t.length &&
            t.each(function () {
                var e = $(this);
                select2Focus(e),
                    e.wrap('<div class="position-relative"></div>').select2({
                        placeholder: "Select value",
                        dropdownParent: e.parent(),
                    });
            });

        $("#searchCode").click(function () {
            var e = $("#code").val();
            searchCode(e);
        });

        $("#validateCode").click(function () {
            var e = $("#code").val();
            validateR(e);
        });

        function searchCode(i) {
            blockUI();
            fetch("searchReserve/" + i, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then((data) => {
                    console.log(data);
                    document.getElementById("subcategory").value =
                        data.subcategory;
                    document.getElementById("date").value = data.shop;
                    document.getElementById("quantity").value = data.quantity;
                    document.getElementById("hours").value = data.hours;
                    document.getElementById("guests").value = data.guests;

                    document.getElementById("typeDoc").value = data.typeDoc;
                    document.getElementById("numberDoc").value = data.numberDoc;
                    document.getElementById("names").value = data.client;
                })
                .catch((error) => {
                    console.error(
                        "There was a problem with the fetch operation:",
                        error
                    );
                })
                .finally(() => {
                    $.unblockUI();
                });
        }

        function validateR(i) {
            blockUI();
            fetch("validateR/" + i, {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    return response.json();
                })
                .then((data) => {
                    Toast.fire({
                        icon: data.icon,
                        title: data.message,
                    });
                })
                .catch((error) => {
                    console.error(
                        "There was a problem with the fetch operation:",
                        error
                    );
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
