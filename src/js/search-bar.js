jQuery(function ($) {
    $("#search-bar__form").hide();

    $("#search-bar__toggle").click(function () {
        $("#search-bar__form").toggle("medium", function () {
            $("#search-bar__field").focus();
        });
    });

    $("#search-bar__field").blur(function () {
        $("#search-bar__form").toggle("medium");
        $("#search-bar__toggle").focus();
    });
});