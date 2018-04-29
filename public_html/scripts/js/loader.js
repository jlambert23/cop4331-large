// Profile loader
$(document).ready(function () {
  $.getJSON('../scripts/giveUserInfo.php', function (user) {
    $('#firstname').append(user.fname + ' ');
    $('#lastname').append(user.lname);
    $('#email').append(user.email).attr('href', 'mailto:' + user.email);

    if (user.hasOwnProperty('image')) {
      $.get(user.image)
        .done(function () {
          $('#profile').attr('src', user.image);
        }).fail(function () {
          $('#profile').attr('src', '../img/default.jpg');
        });
    }
    else {
      $('#profile').attr('src', '../img/default.jpg');
    }

    if (user.hasOwnProperty('phone')) {
      $('#phone').append(user.phone).attr('href', 'tel:' + user.phone);
    }
  });
});

// Event loader
$("#event-list").ready(function () {
  $.getJSON("../scripts/js/tmp/events.json", function (result) {
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

      event.append($("<div>").append($("<span>").append(start)).
                              append($("<span>").append(end)));
      // event.append($("<div>").append(start));
      // event.append($("<div>").append(end));
      event.append($("<div>").append(field.location));
    });
  });
});

// Team loader
$("#team-dropdown").ready(function () {
  $.getJSON("../scripts/getTeams.php", function (teams) {
    if (teams.length <= 0) {
      var message = "Click here to create your<br>first team and get started!";
      $("#team-dropdown").append($("<a>", { href: "#create-team-modal", "data-toggle": "modal", "data-target": "#create-team-modal" }).addClass("dropdown-item").append(message));
    }
    else {
      $.each(teams, function (i, field) {
        $("#team-dropdown").append($("<a>", { href: "#" }).addClass("dropdown-item").append(field.team));
      });
    }
  });
});