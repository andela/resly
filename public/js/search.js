$(document).ready(function() {
    $(".search-icon").click(function() {
        $(".search-text").focus();
    });
    $(".search-text").on("focus", function () {
        $(this).css( "background", "#eee" );
        $(".search-row").css( "border-bottom", "3px solid #fff" );
        $(this).attr('placeholder', "Search for restaurant... name or location.");
    });
    $(".search-text").on("blur", function () {
        $(this).css( "background", "none" );
        $(".search-row").css( "border-bottom", "1px solid #fff" );
        $(".search-text").attr('placeholder', "")
    });
});