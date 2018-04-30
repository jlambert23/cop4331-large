$(document).ready(function() {
  var str = parent.document.URL.substring(parent.document.URL.indexOf('?') + 1, parent.document.URL.length);
  var obj = { tid : str.split('=')[1] };

  $.get('../scripts/php/getTeamInfo.php', obj, function (data) {
    alert(data);
  });
});