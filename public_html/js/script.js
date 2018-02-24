// This script will be primarily used so that backend developers can test their api.
// Ofcourse don't let that stop you from messing around with ajax and getting the hang of it.
// Front end will need to know how to parse and transpose the return data, afterall.

var testfile = "API/tests.php"

function testing() {
    ajax(testfile);
}

// Asynchronous Javascript and XML
// See: https://www.w3schools.com/xml/ajax_intro.asp
function ajax(filename) {
    var xhttp = new XMLHttpRequest();

    // Inline function-- It's basically an event listener.
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // We're changing the current viewed html to the responses text that is sent back!
            document.getElementById("test").innerHTML = this.responseText;
        }
    };

    xhttp.open("GET", filename, true);
    xhttp.send();
}

// This is what we're doing with the response.
function callbackFunc(response) {
    console.log(response);
}