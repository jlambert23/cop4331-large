document.write('<style>body { visibility: hidden; } </style>');

(function () {
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (!this.responseText)
        window.location = "/";
    }
  }
  xhttp.open("GET", "../scripts/php/session.php", true);
  xhttp.send();
})();