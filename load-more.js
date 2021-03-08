jQuery(function ($) {
    $(".load-more").click(function () {
        var button = $(this),
            data = {
                action: "loadmore",
                query: spm_more_params.posts,
                page: spm_more_params.current_page,
            };

        $.ajax({
            url: spm_more_params.ajaxurl,
            data: data,
            type: "POST",
            beforeSend: function (xhr) {
                button.text("Loading..."); // change button text
            },
            success: function (data) {
                if (data) {
                    button.text("Load More"); // insert new posts

                    $(".append-posts").append(data);

                    spm_more_params.current_page++;

                    if (spm_more_params.current_page == spm_more_params.max_page)
                        button.remove(); // if last page, remove button
                } else {
                    button.remove(); // if no data, remove button
                }
            },
        });
    });
});