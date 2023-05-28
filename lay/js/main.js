$(document).ready(function () {
    /*****************************************************/
    //
    $('#toggleTypeText').on('click', function () {
        var input = $('#inputPassword');
        $(this).toggleClass('fa-eye fa-eye-slash');
        if ($(this).hasClass('fa-eye-slash')) {
            input.attr('type', 'text');
        } else {
            input.attr('type', 'password');
        }
    });
    //
    $('#toggleSidebar').on('click', function () {
        $('.sidebar').toggleClass('showSidebar');
        $('.content').toggleClass('showContent');
    });
    //
    $('.topbar .users-area i').on('click', function () {
        $('.topbar .users-area div').slideToggle(300);
    });
    //
    $('a[href="#delete"]').on('click', function () {
        var c = confirm('Do You Want To Delete ?');
        if (c == true) {
            location.href = $(this).data('page')+'.php?Page=Delete&ID='+$(this).data('id');
        }
    });
    //
    $('#search').click(function () {
        $('.search').slideToggle();
    });
    //
    $('.search input').on('input', function () {
        search($(this).val());
    });
    //
    function search (value) {
        $('table tbody tr').each(function () {
            let found = 'false';
            $(this).each(function () {
                if ($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) {
                    found = 'true';
                }
            });
            if (found == 'true') {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
    var inputPassword = $( 'input[type="password"]' );
    //
    $( '#showPassword' ).click( function () {
        $( this ).toggleClass( 'fa-eye fa-eye-slash' );
        if ( $( this ).hasClass( 'fa-eye' ) ) {
            inputPassword.attr( 'type' , 'password' );
        } else {
            inputPassword.attr( 'type' , 'text' );
        }
    } );
    //
    $('.chosen').chosen();
    /*****************************************************/
});















