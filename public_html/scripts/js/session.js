document.write('<style>body { visibility: hidden; } </style>');

(function () {
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (!this.responseText)
        window.location = "/index.html";
    }
  }
  xhttp.open("GET", "/scripts/session.php", true);
  xhttp.send();
})();