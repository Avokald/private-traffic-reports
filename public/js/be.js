jQuery(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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

    $("body").on("change", ".ajax-image-upload", function () {
        var it = $(this);
        console.log(this.files);
        if (this.files && this.files[0]) {
            var data = new FormData();
            data.append('image', this.files[0]);
            $.ajax({
                method: 'POST',
                url: ajax_image_upload_url,
                data: data,
                success: function (response) {
                    it.siblings(".ajax-image-value").val(response['url']);
                    it.siblings().find(".ajax-image-preview").attr('src', response['url']);
                    it.siblings().find(".ajax-image-preview").removeAttr('hidden');
                },
                cache: false,
                contentType: false,
                processData: false,
            });
        }
    });
});
