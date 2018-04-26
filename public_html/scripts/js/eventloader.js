$(".list-group").ready(function () {
    $.getJSON("/scripts/js/tmp/events.json", function (result) {
        $.each(result, function (i, field) {
            var event = $("<div>").addClass("list-group-item small").appendTo(".list-group");
            event.append($("<a>", { href: "#" }).append(field.title));
            event.append($("<div>").append(field.teamname));
            event.append($("<div>").
                append($("<span>").append(field.date + " from ")).
                append($("<span>").append(field.starttime + " - ")).
                append($("<span>").append(field.endtime)));
            event.append($("<div>").append(field.location));
        });
    });
});