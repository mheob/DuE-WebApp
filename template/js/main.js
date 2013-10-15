$(document).ready(function () {
    // Browser Height
    $("#page").css("min-height", $(window).height() - $("footer").height() - 2);

    // Form Selected
    $("#milling").change(function () {
        $("#mill").val($("#milling option:selected").val());
    });

    $("#lathing").change(function () {
        $("#lathe").val($("#lathing option:selected").val());
    });

    $("#mat").change(function () {
        $("#show_mat").val($("#mat option:selected").val() + " kg/dm³");
    });

    // replaces commas versus points
    $("input[type=text]").change(function () {
        $(this).val($(this).val().replace(/,/, "."));
    });

    $("#print").click(function () {
        print();
    });
});
