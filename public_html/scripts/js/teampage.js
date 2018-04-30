$(function () {
  $("#teammate-auto").autocomplete({
    source: function (request, response) {
      var arr = [];
      $.ajax({
        url: '../scripts/php/getAddTeamMember.php',
        type: 'GET',
        dataType: 'json',
        data: {
          term: request.term
        },
        success: function (data) {
          $.each(data, function (i, field) {
            arr.push(field.fname + " " + field.lname);;
          });
          var users = JSON.stringify(arr);
          response(JSON.parse(users));
        },
        error: function(data) {
          alert("ERROR: " + JSON.stringify(data));
        }
      });
    },
    minLength: 1,
    delay: 100
  });
});

$(document).ready(function () {
  var str = parent.document.URL.substring(parent.document.URL.indexOf('?') + 1, parent.document.URL.length);
  var obj = { tid: str.split('=')[1] };

  $.get('../scripts/php/getTeamInfo.php', obj, function (data) {
    alert(data);
  });
});