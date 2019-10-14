require('./bootstrap');

$('#delete_item_button').on('click', function () {
    return confirm('You are about to delete this wiki and all spaces and pages within. Are you sure?');
});

$('#content').children().find('a').attr("target", "_blank");
