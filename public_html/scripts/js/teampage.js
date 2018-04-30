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
          term: request.term,
          t_id: getTeamId()
        },
        success: function (data) {
          $.each(data, function (i, field) {
            var name = field.fname + " " + field.lname + " (" + field.email + ")";
            arr.push(name);
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
    if (data.length <= 0) return false;

    $.each(data, function (i, field) {
      var item = $("<div>").addClass("list-group-item small").appendTo("#member-list");
      item.append($("<div>").append($("<h6>").append(field.fname + " " + field.lname)));
      item.append($("<div>").append(field.email));
    });


  }).fail(function(data) {
    alert("getTeamsUsers test - ERROR: " + JSON.stringify(data));
  })
});

$("#add-tm-btn").click(function() {
  var regExp = /\(([^)]+)\)/;
  var matches = regExp.exec($("#teammate-auto").val());
  var email = matches[1];

  $.post("../scripts/php/addTeamMember.php", { 
    email: email,
    t_id: getTeamId()
  }, function(data) {
    window.location = data;
  });
});