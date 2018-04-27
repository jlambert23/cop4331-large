$(document).ready(function () {

  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay,listWeek'
    },
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    events: '/scripts/getEvents.php'
  });

});

$(document).on('mouseenter', '.dropdown-toggle', function () {
  $(this).trigger('click');
});

$('#logout').click( function() {
  $.ajax({
    type: 'POST',
    url: '/scripts/logout.php',
    data: { logout: 'true' },
    success: function(data) {
      window.location = data;
    }
  })
});