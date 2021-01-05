(function ($) {
    $('.todo-list-container').on('submit', '.todo-status', function (e) {
        e.preventDefault();
        let $form = $(this);
        let $button = $form.find('button');
        $.post('../../functions/switchTodoStatus.php', { name: $button.attr('name') })
            .done((data, text, jqxhr) => {
                $button.find('img').toggle();
                $form.parent().toggleClass('todo-checked');
            })
            .fail(jqxhr => {
                alert(jqxhr.responseText);
            });
    });

    $('.todo-list-container').on('submit', '.todo-delete', function (e) {
        e.preventDefault();
        let $form = $(this);
        let $button = $form.find('button');
        $.post('../../functions/deleteTodo.php', { name: $button.attr('name') })
            .done((data, text, jqxhr) => {
                $form.parent().fadeOut();
            })
            .fail(jqxhr => {
                alert(jqxhr.responseText);
            });
    });

    $('.profile-picture').on('click', function (e) {
        console.log('oui');
        let $menu = $('.profile-settings-container');
        $menu.animate({
            height: "toggle",
            opacity: "toggle"
        }, "fast");
    });
})(jQuery);