const guests = document.getElementById("l-guests"),
    lpLane = document.getElementById("lp-lane"),
    lpGuests = document.getElementById("lp-guests"),
    lTotal = document.getElementById("l-total"),
    lHour1 = document.getElementById("l-hour1"),
    lHour2 = document.getElementById("l-hour2"),
    cHour1 = document.getElementById("hour1"),
    cHour2 = document.getElementById("hour2"),
    radioHours = document.querySelectorAll('input[name="c-hour"]');
priceShoe = 8;
let selectedButtonId = null;

generateRadioButtons(calendarItems);

function priceLeft(lane, shoe, cPrice, cShoe) {
    const plane = lane * cPrice;
    const pShoe = shoe * cShoe;
    const pTotal = plane + pShoe;

    lpLane.innerHTML = `S/. ${plane}.00`;
    lpGuests.innerHTML = `S/. ${pShoe}.00`;
    lTotal.innerHTML = `S/. ${pTotal}.00`;
}

// ----------------///
function formatTime(timeString) {
    const [hour, minutes] = timeString.split(":").slice(0, 2);
    const intHour = parseInt(hour);
    const intMinutes = parseInt(minutes);
    const period = intHour >= 12 ? "PM" : "AM";
    const formattedHour = intHour % 12 === 0 ? 12 : intHour % 12;
    return `${formattedHour}:${
        intMinutes < 10 ? "0" + intMinutes : intMinutes
    } ${period}`;
}

function getButtonNumber(buttonId) {
    return parseInt(buttonId.replace("time", ""));
}

function formatTime12h(time24h) {
    const [hours, minutes, seconds] = time24h.split(":").map(Number);
    const period = hours >= 12 ? "PM" : "AM";
    const adjustedHours = hours % 12 || 12;
    return `${adjustedHours.toString().padStart(2, "0")}:${minutes
        .toString()
        .padStart(2, "0")} ${period}`;
}

function formatTime12Hours(hours) {
    const period = hours >= 12 ? "PM" : "AM";
    const hour12 = hours % 12 || 12;
    return `${hour12}:00 ${period}`;
}

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

function formatHourRange(timeString, duration) {
    const date = new Date(`2000-01-01T${timeString}`);
    const startHour = formatTime12Hours(date.getHours());
    const endDate = new Date(date.getTime() + duration * 60 * 60 * 1000);
    const endHour = formatTime12Hours(endDate.getHours());
    return `${startHour} hasta ${endHour}`;
}

function getNextHours(value) {
    const [hour, minute, second] = value.split(":").map(Number);
    const baseDate = new Date();
    baseDate.setHours(hour, minute, second, 0);

    const oneHourLater = new Date(baseDate);
    oneHourLater.setHours(baseDate.getHours() + 1);

    const twoHoursLater = new Date(baseDate);
    twoHoursLater.setHours(baseDate.getHours() + 2);

    function formatTime(date) {
        const hours = date.getHours().toString().padStart(2, "0");
        const minutes = date.getMinutes().toString().padStart(2, "0");
        const seconds = date.getSeconds().toString().padStart(2, "0");
        return `${hours}:${minutes}:${seconds}`;
    }

    return [formatTime(oneHourLater), formatTime(twoHoursLater)];
}

function handleRadioChange(selectedRadio) {
    const selectedDate = document.getElementById("c-date").value;
    const selectGuests = document.getElementById("c-guests").value;
    selectedButtonId = selectedRadio.id;
    const buttonNumber = selectedRadio.value;
    const selectedPrice = selectedRadio.getAttribute("data-price");
    const dateTime = formatDateTime(selectedDate, buttonNumber);

    document.getElementById("l-date").innerHTML = dateTime;
    document.getElementById("l-hours").innerHTML = " X 1 hora:";
    document.getElementById(
        "l-guests"
    ).innerHTML = ` X ${selectGuests} Invitados`;

    priceLeft(1, selectGuests, selectedPrice, priceShoe);

    const [oneHourLater, twoHoursLater] = getNextHours(buttonNumber);

    lHour1.innerHTML = formatHourRange(buttonNumber, 1);
    cHour1.checked = true;
    document.getElementById("hour1").disabled = false;

    if (checkRadioButtonStatus(oneHourLater)) {
        lHour2.innerHTML = formatHourRange(buttonNumber, 2);
        document.getElementById("hour2").disabled = false;
    } else {
        lHour2.innerHTML = `<del>${formatHourRange(buttonNumber, 2)}</del>`;
        document.getElementById("hour2").disabled = true;
    }
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

    document.getElementById(
        "l-lane"
    ).innerHTML = `Pista Bowling <strong id='l-hours'></strong>`;

    calendarItems.forEach((item) => {
        const formattedTime = formatTime(item.hour);

        const radioInput = document.createElement("input");
        radioInput.type = "radio";
        radioInput.className = "btn-check";
        radioInput.id = `time${item.hour}`;
        radioInput.name = "time";
        radioInput.value = item.hour; // Mantener el valor original para procesamiento posterior
        radioInput.setAttribute("data-price", item.price);
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

const getProductCalendar = async (productId, date) => {
    try {
        const response = await fetch(`/updateUI/${productId}/${date}`);
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

        priceLeft(0, 0, 0, 0);

        lHour1.innerHTML = "1 Hora";
        cHour1.checked = false;
        cHour1.disabled = true;

        lHour2.innerHTML = "2 Horas";
        cHour2.checked = false;
        cHour2.disabled = true;

        generateRadioButtons(hours);
    } catch (error) {
        console.error("Error al actualizar la interfaz de usuario:", error);
    }
};

document.getElementById("c-date").addEventListener("change", updateUI);

document.getElementById("c-guests").addEventListener("change", (e) => {
    guests.innerHTML = ` X ${e.target.value} Invitados`;
    const selectGuests = e.target.value;

    if (selectedButtonId) {
        const selectedPrice = document
            .getElementById(selectedButtonId)
            .getAttribute("data-price");
        priceLeft(1, selectGuests, selectedPrice, priceShoe);
    } else {
        console.error("No se ha seleccionado ningún botón de tiempo.");
    }
});

let selectHour = null;

radioHours.forEach((hours) => {
    hours.addEventListener("input", function () {
        if (this.checked) {
            const selectHour = parseInt(this.value);
            const pluralSuffix = selectHour > 1 ? "s" : "";
            document.getElementById(
                "l-hours"
            ).innerHTML = ` X ${selectHour} Hora${pluralSuffix}`;
        }
    });
});
