displayResults = function (data) {
    let amount = data.length

    for (var i = 0; i < amount; i++) {
        let margin = 34 * i;
        let width = $('#search_input').width();

        let record = data[i];
        let icon = ``;

        switch (record.type) {
            case 'pages':
                icon = `<i class="far fa-bookmark px-2"></i>`;
                break;
            case 'wikis':
                icon = `<i class="fas fa-book px-2"></i>`;
                break;
            case 'spaces':
                icon = `<i class="fas fa-book-open px-2"></i>`;
                break;
            default:
                icon = `<i class="fas fa-question-circle px-2"></i>`;
        }


        var searchResultDetailTemplate = `${icon}<span> ${record.title}</span>`;
        var resultTemplate = `<div class="w-full bg-white border hover:bg-blue-100 py-2 result__item overflow-hidden" style="position: absolute; width: ${width}; margin-top: ${margin}px;">${searchResultDetailTemplate}</div>`;
        var completeTemplate = `<a class="results__item" href="${record.url}">` + resultTemplate + `</a>`;
        $('#search_container').append(completeTemplate);
    }
}

doAjax = function (searchText) {
    $.ajax({
        type: 'POST',
        url: '/search?search=' + searchText,
        success: function (data) {
            $('.results__item').remove();
            displayResults(data);
        }
    });
}

destroyOldResults = function () {
    $('.results__item').remove();
}

$(function () {
    var element = $('#search_input');

    $(element).on('keyup', function () {
        $('.search__glass').css('opacity', '1');
        let searchText = $('#search_input').val();
        doAjax(searchText);
    });

    $('.search__glass').on('click', function () {
        let searchText = $('#search_input').val();
        doAjax(searchText);
    });

    $(element).on('blur', function () {
        $(this).val(null);
        $('.search__glass').css('opacity', '0');
        window.setTimeout(destroyOldResults, 300);
    });
});
