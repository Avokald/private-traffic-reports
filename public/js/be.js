jQuery(function() {
    $("body").on("click", ".repeater-add-el", function(event) {
        event.preventDefault();

        var clone = $(".block-saver > ." + $(this).attr('data-block-type')).clone();
        let counter = $(this).attr('data-counter');


        clone.html(clone.html().replace(/\<js-counter\>/g, counter));

        $(this).attr('data-counter', ++counter);
        $(this).closest(".repeater").find(".repeater-list").append(clone);

    });

    $("body").on("click", ".repeater-delete-el", function(event) {
        event.preventDefault();

        $(this).closest(".repeater-item").remove();
    });

    $('textarea').each(function () {
        this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
    }).on('input', function () {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
});
