$(".list-group").ready(function () {
    $.getJSON("/scripts/js/tmp/events.json", function (result) {
        $.each(result, function (i, field) {
            var dateformat = "dddd, MMM D YYYY";
            var start = moment(field.start).format("h:mm a " + dateformat);
            var end = field.hasOwnProperty("end") ? moment(field.end).format("h:mm a " + dateformat) : "";

            // All day conditions
            if (moment(field.start).format("H:mm") == "0:00") {
                if (end == "") {
                    start = moment(field.start).format(dateformat);
                }
                else if (moment(field.end).format("H:mm") == "0:00") {
                    start = moment(field.start).format(dateformat);
                    end = moment(field.end).format(dateformat);
                }                
            }

            if (end != "") start += " to ";

            var event = $("<div>").addClass("list-group-item small").appendTo(".list-group");
            event.append($("<a>", { href: "#" }).append(field.title));
            event.append($("<div>").append(field.team));
            event.append($("<div>").append(start));
            event.append($("<div>").append(end));
            event.append($("<div>").append(field.location));
        });
    });
});