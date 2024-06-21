const guests = document.getElementById("l-guests"),
    lpLane = document.getElementById("lp-lane"),
    lpGuests = document.getElementById("lp-guests"),
    lTotal = document.getElementById("l-total"),
    lHour1 = document.getElementById("l-hour1"),
    lHour2 = document.getElementById("l-hour2"),
    cHour1 = document.getElementById("hour1"),
    cHour2 = document.getElementById("hour2"),
    xwyz = document.getElementById("xwyz").getAttribute("data-id"),
    radioHours = document.querySelectorAll('input[name="c-hour"]');
priceShoe = 8;
let selectedButtonId = null,
    selectedPrice,
    line = 1;


generateRadioButtons(calendarItems);

function priceLeft(lane, shoe, cPrice, cShoe, lines) {
    const plane = (lane * cPrice) * line;
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
    return `${formattedHour}:${intMinutes < 10 ? "0" + intMinutes : intMinutes
        } ${period}`;
}

function formatTime12h(time24h) {
    const [hours, minutes, seconds] = time24h.split(":").map(Number);
    const period = hours >= 12 ? "PM" : "AM";
    const adjustedHours = hours % 12 || 12;
    return `${adjustedHours.toString().padStart(2, "0")}:${minutes
        .toString()
        .padStart(2, "0")} ${period}`;
}

function formatTime24Hours(timeString) {
    const [hour, minutes] = timeString.split(":").slice(0, 2);
    return `${hour}:${minutes}:00`;
}

function formatTime12Hours(hours, minutes = 0) {
    const period = hours >= 12 ? "PM" : "AM";
    const formattedHour = hours % 12 === 0 ? 12 : hours % 12;
    return `${formattedHour}:${minutes < 10 ? "0" + minutes : minutes
        } ${period}`;
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
    return `${dayOfWeek.charAt(0).toUpperCase() + dayOfWeek.slice(1)
        }, ${day} de ${month.charAt(0).toUpperCase() + month.slice(1)
        } de ${year} <br> ${time12h}`;
}

function formatHourRange(timeString, duration) {
    // Parsear el tiempo inicial en una fecha
    const startTime = new Date(`2000-01-01T${timeString}`);

    // Calcular la fecha final sumando la duración en milisegundos
    const endTime = new Date(startTime.getTime() + duration * 60 * 60 * 1000);

    // Formatear las horas de inicio y fin en formato de 12 horas con AM/PM
    const startHour = formatTime12Hours(
        startTime.getHours(),
        startTime.getMinutes()
    );
    const endHour = formatTime12Hours(endTime.getHours(), endTime.getMinutes());

    return `${startHour} hasta ${endHour}`;
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

    return [formattedOneHalfHourLater, formattedTwoHalfHoursLater, formattedThreeHalfHoursLater];
}

const updateHourLabelsAndStatus = (
    buttonNumber,
    oneHourLater,
    twoHoursLater,
    threeHoursLater
) => {


    const isOneHourLaterAvailable = checkRadioButtonStatus(oneHourLater);
    const isTwoHoursLaterAvailable = checkRadioButtonStatus(twoHoursLater);
    const isThreeHoursLaterAvailable = checkRadioButtonStatus(threeHoursLater);

    const hour1Label = document.getElementById("hour1");
    const hour2Label = document.getElementById("hour2");

    // Update for one hour later
    if (isOneHourLaterAvailable) {
        lHour1.innerHTML = formatHourRange(buttonNumber, 1);
        hour1Label.checked = true;
        hour1Label.disabled = false;
    } else {
        lHour1.innerHTML = `<del>${formatHourRange(buttonNumber, 1)}</del>`;
        hour1Label.disabled = true;
        lHour2.innerHTML = `<del>${formatHourRange(buttonNumber, 2)}</del>`;
        hour2Label.disabled = true;
    }

    // Update for two hours later
    if (isTwoHoursLaterAvailable && isOneHourLaterAvailable) {
        lHour2.innerHTML = formatHourRange(buttonNumber, 2);
        hour2Label.disabled = false;
    } else {
        lHour2.innerHTML = `<del>${formatHourRange(buttonNumber, 2)}</del>`;
        hour2Label.disabled = true;
    }

    // Update for three hours later
    if (isTwoHoursLaterAvailable && isOneHourLaterAvailable && isThreeHoursLaterAvailable) {
        lHour2.innerHTML = formatHourRange(buttonNumber, 2);
        hour2Label.disabled = false;
    } else {
        lHour2.innerHTML = `<del>${formatHourRange(buttonNumber, 2)}</del>`;
        hour2Label.disabled = true;
    }
};

function handleRadioChange(selectedRadio) {
    const selectedDate = document.getElementById("c-date").value;
    const selectGuests = document.getElementById("c-guests").value;
    selectedButtonId = selectedRadio.id;
    const buttonNumber = selectedRadio.value;
    selectedPrice = selectedRadio.getAttribute("data-price");
    const dateTime = formatDateTime(selectedDate, buttonNumber);

    document.getElementById("l-date").innerHTML = dateTime;
    document.getElementById("l-hours").innerHTML = " X 1 hora:";
    document.getElementById(
        "l-guests"
    ).innerHTML = ` X ${selectGuests} Invitados`;

    priceLeft(1, selectGuests, selectedPrice, priceShoe, line);

    const [oneHourLater, twoHoursLater, threeHoursLater] = getNextHalfHours(buttonNumber);

    updateHourLabelsAndStatus(buttonNumber, oneHourLater, twoHoursLater, threeHoursLater);
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

    calendarItems.forEach((item) => {
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
        console.log(hours);
    } catch (error) {
        console.error("Error al actualizar la interfaz de usuario:", error);
    }
};

document.getElementById("c-date").addEventListener("change", updateUI);

document.getElementById("c-guests").addEventListener("change", (e) => {

    guests.innerHTML = ` X ${e.target.value} Invitados`;
    const selectGuests = e.target.value;

    if (selectedButtonId) {
        selectedPrice = document
            .getElementById(selectedButtonId)
            .getAttribute("data-price");
        if (selectGuests > 5) {
            line = 2;
            document.getElementById("n-lane").innerHTML = "2";
            priceLeft(selectHour, selectGuests, selectedPrice, priceShoe);

        } else {
            line = 1;
            document.getElementById("n-lane").innerHTML = "";
            priceLeft(selectHour, selectGuests, selectedPrice, priceShoe);

        }
    } else {
        console.error("No se ha seleccionado ningún botón de tiempo.");
    }

});

let selectHour = 1;

radioHours.forEach((hours) => {
    hours.addEventListener("input", function () {
        if (this.checked) {
            selectHour = parseInt(this.value);
            const selectGuests = parseInt(document.getElementById("c-guests").value);

            // Update the hours label
            const pluralSuffix = selectHour > 1 ? "s" : "";
            document.getElementById("l-hours").innerHTML = ` X ${selectHour} Hora${pluralSuffix}`;

            if (selectedButtonId) {
                const selectedPrice = document.getElementById(selectedButtonId).getAttribute("data-price");
                if (selectGuests > 5) {
                    document.getElementById("n-lane").innerHTML = "2";
                    line = 2;
                    priceLeft(selectHour, selectGuests, selectedPrice, priceShoe); // 2 lanes
                } else {
                    document.getElementById("n-lane").innerHTML = "";
                    line = 1;
                    priceLeft(selectHour, selectGuests, selectedPrice, priceShoe); // 1 lane
                }
            } else {
                console.error("No se ha seleccionado ningún botón de tiempo.");
            }
        }
    });
});
