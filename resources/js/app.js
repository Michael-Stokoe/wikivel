require('./bootstrap');

$('#delete_item_button').on('click', function () {
    return confirm('You are about to delete this wiki and all spaces and pages within. Are you sure?');
});

$('#content').children().find('a').attr("target", "_blank");

var usersToInviteCount = 1;
window.addAnotherUser = function () {
    let template = $('#user_1').html();
    usersToInviteCount++;

    template = template.split('1').join(usersToInviteCount);

    $('#users').append(template);
    $('#users_to_invite_count').val(usersToInviteCount);
}
