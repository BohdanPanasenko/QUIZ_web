$(document).ready(function () {
    $('#fetch-data-btn').click(function () {
        $.ajax({
            url: 'fetch_data.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                var usersList = $('#users-list');
                usersList.empty();
                data.users.forEach(function (user) {
                    usersList.append('<li>' + user.username + ' (' + user.email + ')</li>');
                });
                $('#server-time').text('Current Server Time: ' + data.server_time);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching data:', textStatus, errorThrown);
            }
        });
    });
});