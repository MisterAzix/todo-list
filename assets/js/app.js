(function ($) {
    $('.todo-list-container').on('submit', '.todo-status', function (e) {
        e.preventDefault();
        let $form = $(this);
        let $button = $form.find('button');
        $.post('../../functions/switchTodoStatus.php', { name: $button.attr('name') })
            .done((data, text, jqxhr) => {
                console.log(jqxhr.responseText);
                $button.find('img').toggle();
                $form.parent().toggleClass('todo-checked');
            })
            .fail(jqxhr => {
                alert(jqxhr.responseText);
            });
    });
})(jQuery);