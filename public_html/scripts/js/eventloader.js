$(document).ready(function () {
    $.getJSON("/scripts/js/tmp/events.json", function (result) {
        $.each(result, function (i, field) {
            $("#event" + i + ' .title').append(field.title + " ");
        });
    });
});