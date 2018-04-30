var urlVar = parent.document.URL.substring(parent.document.URL.indexOf('?') + 1, parent.document.URL.length);

// Load event list.
$("#event-list").ready(function () {
  var script = "../scripts/php/" + (urlVar.includes("tid") ? "getTeamsEvents.php" : "getUsersEvents.php");
  var tid = (script) ? urlVar.split("=")[1] : "";

  $.getJSON(script, {t_id: tid }, function (events) {
    alert(JSON.stringify(events));
    if (events.length <= 0) {
      var item = $("<div>").addClass("list-group-item small").appendTo("#event-list");
      item.append($("<a>", { href: "#create-event-modal", "data-toggle": "modal", "data-target": "#create-event-modal" }).
        append($("<h6>").
          append($("<strong>").
            append("Click here to create a new event!"))));
      return false;
    }

    $.each(events, function (i, field) {
      if (i == 5) return false;

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

      var item = $("<div>").addClass("list-group-item small").appendTo("#event-list");
      item.append($("<a>", { href: "#" }).append(field.title));
      item.append($("<div>").append(field.team));

      item.append($("<div>").append($("<span>").append(start)).
        append($("<span>").append(end)));
      item.append($("<div>").append(field.location));
    });
  }).fail(function (data) {
    alert("ERROR: " + JSON.stringify(data));
    var item = $("<div>").addClass("list-group-item small").appendTo("#event-list");
    item.append($("<a>", { href: "#create-event-modal", "data-toggle": "modal", "data-target": "#create-event-modal" }).
      append($("<h6>").
        append($("<strong>").
          append("Click here to create a new event!"))));
  });
});

// Team loader for create events and team list.
$("#team-dropdown").ready(function () {
  $.getJSON("../scripts/php/getTeams.php", function (teams) {
    if (teams.length <= 0) {
      var message = "Click here to create your<br>first team and get started!";
      $("#team-dropdown").append($("<a>", { href: "#create-team-modal", "data-toggle": "modal", "data-target": "#create-team-modal" }).addClass("dropdown-item").append(message));
    }
    else {
      $.each(teams, function (i, field) {
        $("#team-dropdown").append($("<a>", { href: "teampage.html?tid=" + field.tid }).addClass("dropdown-item").append(field.team));
        $("#event-team").append($("<option>", { value: field.team }).append(field.team).attr("id", "t" + field.tid));
      });

      if (urlVar.includes("tid")) {
        $("#event-team option:selected").removeAttr("selected");

        var tid = urlVar.split('=')[1];
        $("#t" + tid).attr("selected", "");
      }
    }
  });
});