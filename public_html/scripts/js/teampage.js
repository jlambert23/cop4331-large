// Load team data.
$(document).ready(function () {
  var str = parent.document.URL.substring(parent.document.URL.indexOf('?') + 1, parent.document.URL.length);
  var obj = { t_id : str.split('=')[1] };

  $.getJSON('../scripts/php/getTeamInfo.php', obj, function (data) {
    $('#teamName').append(data.team);
    $('#description').append(data.description);
  });
});

function getTeamId() {
  var urlVar = parent.document.URL.substring(parent.document.URL.indexOf('?') + 1, parent.document.URL.length);
  var arr = urlVar.split('=');

  for (var i = 0; i < arr.length; i++) {
    if (arr[i] == "tid")
      return parseInt(arr[i+1]);
  }
}

// Autocomplete team member input box.
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

// Load team-members.
$('member-list').ready(function() {
  $.getJSON("../scripts/php/getTeamsUsers.php", { t_id: getTeamId }, function(data) {
    alert(data);
    
  }).fail(function(data) {
    alert("ERROR: " + JSON.stringify(data));
  })
});