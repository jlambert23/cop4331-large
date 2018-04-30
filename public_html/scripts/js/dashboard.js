$(window).on("load", function() {
  $("body").css("visibility", "visible");
});

// Load calendar events.
$(document).ready(function () {
  $('#calendar').fullCalendar({
    customButtons: {
      create: {
        text: 'Create Event',
        click: function () {
          $('#create-event-modal').modal('show');
        }
      }
    },
    header: {
      left: 'create',
      center: 'title',
      right: 'prev,next today'
    },
    footer: {
      right: 'month,agendaWeek'
    },
    editable: true,
    // eventLimit: true, // allow "more" link when too many events
    // events: '../scripts/php/getEvents.php'
  });
});

// Profile loader
$(document).ready(function () {
  $.getJSON('../scripts/php/giveUserInfo.php', function (user) {
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

$(document).on('mouseenter', '.dropdown-toggle', function () {
  $(this).trigger('click');
  repad_wrapper();
});

$('#logout').click(function () {
  $.ajax({
    type: 'POST',
    url: '../scripts/php/logout.php',
    data: { logout: 'true' },
    success: function (data) {
      window.location = data;
    }
  })
});

$('#wrapper').ready(repad_wrapper);
$(window).resize(repad_wrapper);
// $(window).load(repad_wrapper);

function repad_wrapper() {
  $('#wrapper').css('padding-top', $('#mainNav').height() + 50);
}