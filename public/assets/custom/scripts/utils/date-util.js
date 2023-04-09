function getMondayToSundayHMS(date) {
    const d = new Date(date);
    const day = d.getDay();
    const diff = d.getDate() - day + (day === 0 ? -6 : 1); // adjust when day is Sunday
    const monday = new Date(d.setDate(diff)).toISOString().slice(0, 10);
    const tuesday = new Date(d.setDate(diff + 1)).toISOString().slice(0, 10);
    const wednesday = new Date(d.setDate(diff + 2)).toISOString().slice(0, 10);
    const thursday = new Date(d.setDate(diff + 3)).toISOString().slice(0, 10);
    const friday = new Date(d.setDate(diff + 4)).toISOString().slice(0, 10);
    const saturday = new Date(d.setDate(diff + 5)).toISOString().slice(0, 10);
    const sunday = new Date(d.setDate(diff + 6)).toISOString().slice(0, 10);
    return { monday, tuesday, wednesday, thursday, friday, saturday, sunday };
}

function getMondayToSundaySM(dateString) {
    var date = new Date(dateString);
    var dayOfWeek = date.getDay();
    var monday = new Date(date);
    var tuesday = new Date(date);
    var wednesday = new Date(date);
    var thursday = new Date(date);
    var friday = new Date(date);
    var saturday = new Date(date);
    var sunday = new Date(date);

    monday.setDate(date.getDate() - dayOfWeek + 1);
    tuesday.setDate(date.getDate() + (2 - dayOfWeek));
    wednesday.setDate(date.getDate() + (3 - dayOfWeek));
    thursday.setDate(date.getDate() + (4 - dayOfWeek));
    friday.setDate(date.getDate() + (5 - dayOfWeek));
    saturday.setDate(date.getDate() + (6 - dayOfWeek));
    sunday.setDate(date.getDate() + (7 - dayOfWeek));

    const options = { day: 'numeric', month: 'short' };
    monday = monday.toLocaleDateString('en-US', options);
    tuesday = tuesday.toLocaleDateString('en-US', options);
    wednesday = wednesday.toLocaleDateString('en-US', options);
    thursday = thursday.toLocaleDateString('en-US', options);
    friday = friday.toLocaleDateString('en-US', options);
    saturday = saturday.toLocaleDateString('en-US', options);
    sunday = sunday.toLocaleDateString('en-US', options);

    return { monday, tuesday, wednesday, thursday, friday, saturday, sunday };
}