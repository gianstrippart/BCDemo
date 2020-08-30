/*$(document).ready(function() {
    $('#longlink').val('');
    $("#link-form-guest").on('submit', function(e){
        e.preventDefault();
        var datastring = $("#link-form-guest").serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/home/shorten",
            data: datastring,
                success: function(response) {
                    $('#render-area').html(response);
            }
        });
    });
    
});*/