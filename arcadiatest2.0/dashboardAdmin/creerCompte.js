$(document).ready(function() {
    $('#createUserForm').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'mailUser.php',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success_message) {
                    $('#messages').html('<p class="success-message">' + response.success_message + '</p>');
                    $('#createUserForm')[0].reset();
                } else if (response.error_message) {
                    $('#messages').html('<p class="error-message">' + response.error_message + '</p>');
                }
            },
            error: function() {
                $('#messages').html('<p class="error-message">Une erreur s\'est produite. Veuillez réessayer.</p>');
            }
        });
    });

    $('.toggle-password').click(function() {
        var input = $('#' + $(this).data('toggle'));
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
        } else {
            input.attr('type', 'password');
        }
    });
});