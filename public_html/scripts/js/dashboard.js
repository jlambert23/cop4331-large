$(window).on("load", function() {
  $("body").css("visibility", "visible");
});

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
    eventLimit: true, // allow "more" link when too many events
    events: '../scripts/php/getEvents.php'
  });
});

$(document).on('mouseenter', '.dropdown-toggle', function () {
  $(this).trigger('click');
  repad_wrapper();
});

$('#logout').click(function () {
  $.ajax({
    type: 'POST',
    url: '/scripts/php/logout.php',
    data: { logout: 'true' },
    success: function (data) {
      window.location = data;
    }
  })
});

$('#wrapper').ready(repad_wrapper);
// $(window).resize(repad_wrapper);
// $(window).load(repad_wrapper);

function repad_wrapper() {
  $('#wrapper').css('padding-top', $('#mainNav').height() + 50);
}