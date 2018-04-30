$(document).ready(function() {
  var str = parent.document.URL.substring(parent.document.URL.indexOf('?') + 1, parent.document.URL.length);
  var obj = { t_id : str.split('=')[1] };

  $.getJSON('../scripts/php/getTeamInfo.php', obj, function (data) {
    $('#teamName').append(data.team);
    alert(data);
  });
});