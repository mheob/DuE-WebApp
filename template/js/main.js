// Browser Height
onResize = function () {
    $("#page").css("min-height", $(window).height() - $("footer").height() - 2);
}
$(document).ready(onResize);
$(window).bind('resize', onResize);

// Form Selected
$(document).ready(function () {
    $("#mat").change(function () {
        $("#show_mat").val($("#mat option:selected").val() + " kg/dm³");
    });
});

// replaces commas versus points
$(document).ready(function () {
    $(".weights-calculator input[type=text]").change(function () {
        $(this).val($(this).val().replace(/,/, "."));
    });
});