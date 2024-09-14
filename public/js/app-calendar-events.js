"use strict";
let events = [];

$.ajax({
    url: "schemaEvents",
    method: "GET",
    async: false,
}).done((data) => {
    events = data.data.map((event) => ({
        id: event.id,
        title: event.title,
        start: new Date(event.start),
        end: new Date(event.end),
        extendedProps: { calendar: event.calendar, price: event.price, quantity: event.quantity },
    }));
});
