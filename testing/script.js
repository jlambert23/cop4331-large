$('.modal-toggle').click(function (e) {
    var tab = e.target.hash;
    $('li > a[href="' + tab + '"]').tab("show");
});

$('.nav-tabs').on('shown.bs.tab', function() {
    // $(':input[type!=hidden]:first').focus();
    
    var activeTab = $('.nav-tabs .active').text();
    if ( activeTab == 'Log In' ) {
        // Focus in login-frm
        alert( $('#login-frm input:first').value );
        //$('#login-frm input:enabled:visible:first').focus();
    }
    else if ( activeTab == 'Sign Up' ) {
        // Focus in signup-frm
        alert(activeTab);
    
    }    
});

$('#login').on('shown.bs.tab', function () {
    alert('see?');
    document.getElementById('login-frm').focus();
});
