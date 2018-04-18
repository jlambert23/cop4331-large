// Toggle to correct tab depending on button target.
$('.modal-toggle').click(function (e) {
    var tab = e.target.hash;
    $('li > a[href="' + tab + '"]').tab("show");
});

// Clear forms on modal exit.
$('#login-modal').on('hidden.bs.modal', function () {
    document.getElementById('login-frm').reset();
    document.getElementById('signup-frm').reset();
});

// Password matching.
$('#signup-frm').on("submit", function () {
    var psw = document.getElementById('psw');
    var pswRepeat = document.getElementById('psw-repeat');

    if (psw.val() != pswRepeat.val()) {
        pswRepeat.setCustomValidity("Password does not match.");
    } else {
        pswRepeat.setCustomValidity("");
    }
});