// Browser Height
onResize = function () {
    $("#page").css("min-height", $(window).height() - $("footer").height());
}
$(document).ready(onResize);
$(window).bind('resize', onResize);

// Form Selected
$("#mat").change(function () {
    $("#show_mat").val($("#mat option:selected").val() + " kg/dm³");
});

// replaces commas versus points
$(".weights-calculator input[type=text]").change(function () {
    $(this).val($(this).val().replace(/,/, "."));
});
