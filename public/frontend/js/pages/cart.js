const guests = document.getElementById("l-guests"),
    lpLane = document.getElementById("lp-lane"),
    ldiscount = document.getElementById("l-discount"),
    lpGuests = document.getElementById("lp-guests"),
    lTotal = document.getElementById("l-total"),
    lHour1 = document.getElementById("l-hour1"),
    lHour2 = document.getElementById("l-hour2"),
    cHour1 = document.getElementById("hour1"),
    cHour2 = document.getElementById("hour2"),
    xwyz = document.getElementById("xwyz").getAttribute("data-id"),
    btnCoupon = document.getElementById("btnCoupon"),
    inputCoupon = document.getElementById("couponCode"),
    csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    inputGuests = document.getElementById("c-guests"),
    limitRound = "",
    labelLine = document.getElementById("n-lane");
localStorage.setItem("limit", "");

const radioHours = document.querySelectorAll('input[name="c-hour"]'),
    priceShoe = xwyz === "4" ? 0 : 8,
    typeLane = xwyz == 4 ? "" : "Alquiler Calzado";
let selectedButtonId = null,
    selectedPrice,
    line = 1,
    globalDiscount = 0,
    globalDiscountType = "",
    plane = "";

generateRadioButtons(calendarItems);

function priceLeft(lane, shoe, cPrice, cShoe, lines) {
    plane = lane * cPrice * line;
    const pShoe = shoe * cShoe;

    let discountAmount = 0;

    if (globalDiscountType === "percentage") {
        discountAmount = (plane * globalDiscount) / 100;
    } else if (globalDiscountType === "fixed") {
        discountAmount = globalDiscount;
    }

    discountAmount = discountAmount.toFixed(2);
    const pTotal = (plane - discountAmount + pShoe).toFixed(2);

    ldiscount.innerHTML = `- S/. ${discountAmount}`;
    lpLane.innerHTML = `S/. ${plane.toFixed(2)}`;
    lpGuests.innerHTML = `S/. ${pShoe.toFixed(2)}`;
    lTotal.innerHTML = `S/. ${pTotal}`;
}

function getNextHalfHours(timeString) {
    const [hour, minutes] = timeString.split(":").slice(0, 2);
    const intHour = parseInt(hour);
    const intMinutes = parseInt(minutes);

    const now = new Date();
    now.setHours(intHour);
    now.setMinutes(intMinutes);
    now.setSeconds(0);

    const oneHalfHourLater = new Date(now);
    const twoHalfHoursLater = new Date(now);
    const threeHalfHoursLater = new Date(now);

    // Agregar 30 minutos para obtener la siguiente media hora
    oneHalfHourLater.setMinutes(now.getMinutes() + 30);

    // Manejar el desbordamiento de los minutos
    if (oneHalfHourLater.getMinutes() >= 60) {
        oneHalfHourLater.setHours(now.getHours() + 1);
        oneHalfHourLater.setMinutes(now.getMinutes() - 30);
    }

    // Agregar 1 hora y 30 minutos para obtener 2 horas después
    twoHalfHoursLater.setHours(now.getHours() + 1);

    // Manejar el desbordamiento de los minutos para twoHalfHoursLater
    if (twoHalfHoursLater.getMinutes() >= 60) {
        twoHalfHoursLater.setHours(now.getHours() + 1);
    }

    // Agregar 1 hora y 30 minutos para obtener 2 horas después
    threeHalfHoursLater.setHours(now.getHours() + 1);
    threeHalfHoursLater.setMinutes(now.getMinutes() + 30);
    // Manejar el desbordamiento de los minutos para twoHalfHoursLater
    if (threeHalfHoursLater.getMinutes() >= 60) {
        threeHalfHoursLater.setHours(now.getHours() + 1);
        threeHalfHoursLater.setMinutes(now.getMinutes() + 30);
    }

    const formattedOneHalfHourLater = formatTime24Hours(
        oneHalfHourLater.toTimeString().split(" ")[0]
    );
    const formattedTwoHalfHoursLater = formatTime24Hours(
        twoHalfHoursLater.toTimeString().split(" ")[0]
    );
    const formattedThreeHalfHoursLater = formatTime24Hours(
        threeHalfHoursLater.toTimeString().split(" ")[0]
    );

    return [
        formattedOneHalfHourLater,
        formattedTwoHalfHoursLater,
        formattedThreeHalfHoursLater,
    ];
}

const updateHourLabelsAndStatus = (
    buttonNumber,
    oneHourLater,
    twoHoursLater,
    threeHoursLater
) => {
    const isOneHourLaterAvailable = checkRadioButtonStatus(oneHourLater),
        isTwoHoursLaterAvailable = checkRadioButtonStatus(twoHoursLater),
        isThreeHoursLaterAvailable = checkRadioButtonStatus(threeHoursLater),
        hour1Label = document.getElementById("hour1"),
        hour2Label = document.getElementById("hour2");

    // Update for one hour later
    if (isOneHourLaterAvailable) {
        lHour1.innerHTML = formatHourRange(buttonNumber, 1);
        cHour1.setAttribute("data-one", buttonNumber);
        cHour1.setAttribute("data-two", oneHourLater);
        hour1Label.checked = true;
        hour1Label.disabled = false;
    } else {
        lHour1.innerHTML = `<del>${formatHourRange(buttonNumber, 1)}</del>`;
        hour1Label.disabled = true;
        lHour2.innerHTML = `<del>${formatHourRange(oneHourLater, 2)}</del>`;
        hour2Label.disabled = true;
    }

    // Update for two hours later
    if (isTwoHoursLaterAvailable && isOneHourLaterAvailable) {
        lHour2.innerHTML = formatHourRange(buttonNumber, 2);
        cHour2.setAttribute("data-one", buttonNumber);
        cHour2.setAttribute("data-two", oneHourLater);
        cHour2.setAttribute("data-three", twoHoursLater);
        cHour2.setAttribute("data-four", threeHoursLater);
        hour2Label.disabled = false;
    } else {
        lHour2.innerHTML = `<del>${formatHourRange(buttonNumber, 2)}</del>`;
        hour2Label.disabled = true;
    }

    // Update for three hours later
    if (
        isTwoHoursLaterAvailable &&
        isOneHourLaterAvailable &&
        isThreeHoursLaterAvailable
    ) {
        lHour2.innerHTML = formatHourRange(buttonNumber, 2);
        hour2Label.disabled = false;
    } else {
        lHour2.innerHTML = `<del>${formatHourRange(buttonNumber, 2)}</del>`;
        hour2Label.disabled = true;
    }
};

function handleRadioChange(selectedRadio) {
    const selectedDate = document.getElementById("c-date").value;

    selectedButtonId = selectedRadio.id;
    const buttonNumber = selectedRadio.value;
    selectedPrice = selectedRadio.getAttribute("data-price");
    const dateTime = formatDateTime(selectedDate, buttonNumber);

    const [oneHourLater, twoHoursLater, threeHoursLater] =
        getNextHalfHours(buttonNumber);

    updateHourLabelsAndStatus(
        buttonNumber,
        oneHourLater,
        twoHoursLater,
        threeHoursLater
    );

    updateGuests(
        selectedDate,
        buttonNumber,
        oneHourLater,
        twoHoursLater,
        threeHoursLater
    );

    const selectGuests = inputGuests.value;
    document.getElementById("l-date").innerHTML = dateTime;
    document.getElementById("l-hours").innerHTML = " X 1 hora:";
    document.getElementById(
        "l-guests"
    ).innerHTML = ` ${typeLane} <strong> X ${selectGuests} Invitados </strong>`;

    priceLeft(1, selectGuests, selectedPrice, priceShoe, line);
}

function checkRadioButtonStatus(value) {
    const radioButtons = document.querySelectorAll('input[type="radio"]');
    let status = false;

    radioButtons.forEach((radioButton) => {
        if (radioButton.value === value) {
            status = !radioButton.disabled;
        }
    });

    return status;
}

// ----------------///
function generateRadioButtons(calendarItems) {
    const container = document.getElementById("radioContainer");
    container.innerHTML = "";

    // Filtra los elementos para excluir aquellos con la hora '23:00:00'
    const filteredItems = calendarItems.filter(
        (item) => item.hour !== "23:00:00"
    );

    filteredItems.forEach((item) => {
        const formattedTime = formatTime(item.hour);

        const radioInput = document.createElement("input");
        radioInput.type = "radio";
        radioInput.className = "btn-check";
        radioInput.id = `time${item.hour}`;
        radioInput.name = "time";
        radioInput.value = item.hour;
        radioInput.setAttribute("data-price", item.price);
        radioInput.setAttribute("data-subcategory", item.subcategory);
        if (item.available === 0) radioInput.disabled = true;

        const radioLabel = document.createElement("label");
        radioLabel.htmlFor = `time${item.hour}`;
        radioLabel.className = "btn btn-outline-secondary btn-lg btn-custom";
        radioLabel.innerHTML =
            item.available === 0
                ? `<del>${formattedTime}</del>`
                : `<span>${formattedTime}</span>`;

        const colDiv = document.createElement("div");
        colDiv.className =
            "col-12 col-md-6 radio-container d-flex justify-content-center";

        radioInput.addEventListener("change", function () {
            handleRadioChange(this);
        });

        colDiv.appendChild(radioInput);
        colDiv.appendChild(radioLabel);
        container.appendChild(colDiv);
    });
}

const getProductCalendar = async (subcategory, date) => {
    try {
        const response = await fetch(`/updateUI/${subcategory}/${date}`);
        if (!response.ok) {
            throw new Error("No se pudo obtener la data");
        }
        const data = await response.json();
        return data;
    } catch (error) {
        console.error("Error al obtener la data:", error);
    }
};

const updateUI = async () => {
    try {
        const selectedDate = document.getElementById("c-date").value;
        document.getElementById("l-date").innerHTML = "----------------";

        priceLeft(0, 0, 0, 0, 1);

        lHour1.innerHTML = "1 Hora";
        cHour1.checked = false;
        cHour1.disabled = true;

        lHour2.innerHTML = "2 Horas";
        cHour2.checked = false;
        cHour2.disabled = true;

        const hours = await getProductCalendar(xwyz, selectedDate);

        generateRadioButtons(hours);
    } catch (error) {
        console.error("Error al actualizar la interfaz de usuario:", error);
    }
};

const updateGuests = async (date, one, two, three, four) => {
    try {
        const response = await fetch(`/updateGuests`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({ date, one, two, three, four }),
        });

        if (!response.ok) {
            throw new Error("No se pudo obtener la data");
        }

        const data = await response.json();
        localStorage.setItem("limit", data.limit);
        inputGuests.max = data.calculated;
        if (parseInt(inputGuests.value) > data.calculated) {
            inputGuests.value = data.calculated;
            guests.innerHTML = ` ${typeLane} <strong> X ${data.calculated} Invitados </strong>`;
            line = Math.ceil(inputGuests.value / data.limit);
            labelLine.innerHTML = line;

            const selectedPrice = document
                .getElementById(selectedButtonId)
                .getAttribute("data-price");

            priceLeft(
                selectHour,
                data.calculated,
                selectedPrice,
                priceShoe,
                line
            );
        }
        limitRound;
        return data;
    } catch (error) {
        console.error("Error al obtener la data:", error);
    }
};

const getCoupon = async (code) => {
    if (!code) {
        console.error("El código de cupón no está definido.");
        return;
    }

    try {
        const response = await fetch(`/api/coupon/${code}`);

        if (!response.ok) {
            if (response.status === 404) {
                console.error("Cupón no encontrado.");
                alert("Cupón no encontrado.");
                return { error: "Cupón no encontrado." };
            } else {
                throw new Error("Error en la respuesta de la API.");
            }
        }

        const data = await response.json();
        console.log(data);

        // Verificar si el cupón está activo
        if (!data.is_active) {
            alert("El cupón no está activo.");
            return { error: "El cupón no está activo." };
        }

        // Verificar la validez de la fecha
        const inputDate = new Date(document.getElementById("c-date").value);
        const startDate = new Date(data.valid_from);
        const endDate = new Date(data.valid_until);

        if (inputDate < startDate || inputDate > endDate) {
            alert("La fecha no está dentro del rango de validez del cupón.");
            return { error: "La fecha no es válida." };
        }

        // Verificar si el cupón ha alcanzado su límite de uso
        if (data.usage_limit !== null && data.used_count >= data.usage_limit) {
            alert("Este cupón ya ha sido usado el número máximo de veces.");
            return { error: "Límite de uso alcanzado." };
        }

        // Verificar si 'xwyz' se encuentra en 'subcategory_ids'
        const xwyz = "4"; // Ejemplo de cupón como cadena
        const xwyzNumber = parseInt(xwyz, 10); // Convertir a número
        if (!data.subcategory_ids.includes(xwyzNumber)) {
            alert("Este cupón no es válido para este producto.");
            return { error: "Cupón no válido para este producto." };
        }

        // Devolver el tipo de descuento y el monto
        const discountType = data.discount_type; // "percentage"
        const discountAmount = data.discount_amount; // "20.00"

        return { discountType, discountAmount };
    } catch (error) {
        console.error("Error al obtener la data:", error);
        alert("Error al obtener los datos del cupón.");
        return { error: "Error al obtener los datos del cupón." };
    }
};

const LabelGuests = () => {
    const selectGuests = parseInt(inputGuests.value) || 0; // Asegúrate de que sea un número
    guests.innerHTML = ` ${typeLane} <strong> X ${selectGuests} Invitados</strong>`;

    if (selectedButtonId) {
        const selectedPrice = document
            .getElementById(selectedButtonId)
            .getAttribute("data-price");
        line = Math.ceil(selectGuests / localStorage.getItem("limit"));
        labelLine.innerHTML = line;
        priceLeft(selectHour, selectGuests, selectedPrice, priceShoe, line); // Calcula el precio
    } else {
        console.error("No se ha seleccionado ningún botón de tiempo.");
    }
};

document.getElementById("increment-btn").addEventListener("click", () => {
    let currentValue = parseInt(inputGuests.value) || 1; // Cambiado a 1 como valor inicial
    const maxGuests = parseInt(inputGuests.max) || 100; // Obtener el máximo actual
    if (currentValue < maxGuests) {
        inputGuests.value = currentValue + 1; // Aumenta el valor en 1
        LabelGuests(); // Llama a LabelGuests para actualizar la UI
    }
});

// Decrementar el valor del input
document.getElementById("decrement-btn").addEventListener("click", () => {
    let currentValue = parseInt(inputGuests.value) || 1; // Cambiado a 1 como valor inicial
    if (currentValue > 1) {
        // Asegúrate de que el valor no baje de 1
        inputGuests.value = currentValue - 1;
        LabelGuests(); // Llama a LabelGuests para actualizar la UI
    }
});

// Validar el valor del input directamente
inputGuests.addEventListener("input", () => {
    let currentValue = parseInt(inputGuests.value) || 1; // Cambiado a 1 como valor inicial
    const maxGuests = parseInt(inputGuests.max) || 100;
    if (currentValue > maxGuests) {
        inputGuests.value = maxGuests; // Restablecer al máximo si se excede
    } else if (currentValue < 1) {
        // Cambiado a 1 como mínimo
        inputGuests.value = 1; // No permitir valores menores a 1
    }
    LabelGuests(); // Llama a LabelGuests para actualizar la UI
});

document.getElementById("c-date").addEventListener("change", updateUI);

let selectHour = 1;

radioHours.forEach((hours) => {
    hours.addEventListener("input", function () {
        const selectedDate = document.getElementById("c-date").value,
            oneHour = this.getAttribute("data-one"),
            twoHour = this.getAttribute("data-two"),
            threeHour = this.getAttribute("data-three"),
            fourHour = this.getAttribute("data-four");

        updateGuests(selectedDate, oneHour, twoHour, threeHour, fourHour);

        if (this.checked) {
            selectHour = parseInt(this.value);

            const pluralSuffix = selectHour > 1 ? "s" : "";
            document.getElementById(
                "l-hours"
            ).innerHTML = ` X ${selectHour} Hora${pluralSuffix}`;

            if (this.checked) {
                const selectGuests = parseInt(inputGuests.value);

                const pluralSuffix = selectHour > 1 ? "s" : "";
                document.getElementById(
                    "l-hours"
                ).innerHTML = ` X ${selectHour} Hora${pluralSuffix}`;

                if (selectedButtonId) {
                    const selectedPrice = document
                        .getElementById(selectedButtonId)
                        .getAttribute("data-price");

                    // Calcular el número de pistas basado en la cantidad de invitados
                    line = Math.ceil(selectGuests / 5); // Divide por 5 y redondea hacia arriba

                    // Actualizar el número de pistas en el DOM
                    labelLine.innerHTML = line;

                    // Calcular el precio
                    priceLeft(
                        selectHour,
                        selectGuests,
                        selectedPrice,
                        priceShoe
                    ); // Llamar a la función con el número de pistas
                } else {
                    console.error(
                        "No se ha seleccionado ningún botón de tiempo."
                    );
                }
            }
        }
    });
});

btnCoupon.addEventListener("click", async () => {
    const couponData = await getCoupon(inputCoupon.value);

    if (couponData && !couponData.error) {
        console.log("Tipo de descuento:", couponData.discountType);
        console.log("Monto de descuento:", couponData.discountAmount);

        globalDiscountType = couponData.discountType;
        globalDiscount = parseFloat(couponData.discountAmount);

        console.log("Monto de descuento global:", globalDiscount);
        console.log("Tipo de descuento global:", globalDiscountType);

        // Aquí puedes actualizar la UI para mostrar el monto descontado y el nuevo monto total al usuario
        LabelGuests();
    } else {
        console.error("Error al obtener el cupón:", couponData.error);
    }
});

inputCoupon.addEventListener("input", function () {
    if (this.value.length > 5) {
        btnCoupon.disabled = false;
    } else {
        btnCoupon.disabled = true;
    }
});

/**
 * Converts a time string in HH:MM format to 12-hour format with AM/PM.
 * @param {string} timeString - The time string in HH:MM format.
 * @returns {string} - The formatted time in 12-hour format with AM/PM.
 */
function formatTime(timeString) {
    const [hour, minutes] = timeString.split(":").map(Number);
    const period = hour >= 12 ? "PM" : "AM";
    const formattedHour = hour % 12 === 0 ? 12 : hour % 12;
    return `${formattedHour}:${minutes.toString().padStart(2, "0")} ${period}`;
}

/**
 * Converts a time string in HH:MM:SS format to 12-hour format with AM/PM.
 * @param {string} time24h - The time string in HH:MM:SS format.
 * @returns {string} - The formatted time in 12-hour format with AM/PM.
 */
function formatTime12h(time24h) {
    const [hours, minutes] = time24h.split(":").map(Number);
    const period = hours >= 12 ? "PM" : "AM";
    const adjustedHours = hours % 12 || 12;
    return `${adjustedHours.toString().padStart(2, "0")}:${minutes
        .toString()
        .padStart(2, "0")} ${period}`;
}

/**
 * Converts a time string in HH:MM format to 24-hour format with seconds.
 * @param {string} timeString - The time string in HH:MM format.
 * @returns {string} - The formatted time in 24-hour format with seconds.
 */
function formatTime24Hours(timeString) {
    const [hour, minutes] = timeString.split(":").map(Number);
    return `${hour.toString().padStart(2, "0")}:${minutes
        .toString()
        .padStart(2, "0")}:00`;
}

/**
 * Converts given hours and minutes to 12-hour format with AM/PM.
 * @param {number} hours - The hour in 24-hour format.
 * @param {number} [minutes=0] - The minutes.
 * @returns {string} - The formatted time in 12-hour format with AM/PM.
 */
function formatTime12Hours(hours, minutes = 0) {
    const period = hours >= 12 ? "PM" : "AM";
    const formattedHour = hours % 12 === 0 ? 12 : hours % 12;
    return `${formattedHour}:${minutes.toString().padStart(2, "0")} ${period}`;
}

// Function: Formats a date and time string to a readable datetime format in Spanish.
function formatDateTime(dateString, timeString) {
    const date = new Date(`${dateString}T${timeString}`);
    const daysOfWeek = [
        "domingo",
        "lunes",
        "martes",
        "miércoles",
        "jueves",
        "viernes",
        "sábado",
    ];
    const months = [
        "enero",
        "febrero",
        "marzo",
        "abril",
        "mayo",
        "junio",
        "julio",
        "agosto",
        "septiembre",
        "octubre",
        "noviembre",
        "diciembre",
    ];
    const dayOfWeek = daysOfWeek[date.getDay()];
    const month = months[date.getMonth()];
    const day = date.getDate();
    const year = date.getFullYear();
    const time12h = formatTime12h(timeString);
    return `${
        dayOfWeek.charAt(0).toUpperCase() + dayOfWeek.slice(1)
    }, ${day} de ${
        month.charAt(0).toUpperCase() + month.slice(1)
    } de ${year} <br> ${time12h}`;
}

// Function: Formats a time string and duration to a readable hour range in 12-hour format with AM/PM.
function formatHourRange(timeString, duration) {
    const startTime = new Date(`2000-01-01T${timeString}`);
    const endTime = new Date(startTime.getTime() + duration * 60 * 60 * 1000);

    const startHour = formatTime12Hours(
        startTime.getHours(),
        startTime.getMinutes()
    );
    const endHour = formatTime12Hours(endTime.getHours(), endTime.getMinutes());

    return `${startHour} hasta ${endHour}`;
}


document.addEventListener('DOMContentLoaded', function() {
    const loginModal = new bootstrap.Modal(document.getElementById("modal-login"));
    const registerModal = new bootstrap.Modal(document.getElementById("modal-register"));

    document.getElementById("btnNext").addEventListener("click", function () {
        loginModal.show();
    });

    document.getElementById("btnRegister").addEventListener("click", function () {
        loginModal.hide();
        registerModal.show();
    });

    document.getElementById("btnLogin").addEventListener("click", function () {
        registerModal.hide();
        loginModal.show();
    });
});
