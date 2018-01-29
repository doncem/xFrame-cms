$(document).ready(function() {
    // ajax

    $.fn.api.settings.api = {
        "save admin": "/admin-save/{step}"
    };

    $(".ui.form[name*='admin-'] .save").api({
        method : "POST",
        serializeForm: true,
        onSuccess: function(response) {
            console.log(response);
            // var isSuccess = $(this).checkSuccess(response, "success", "primary", "Save")

            // if (isSuccess) {
            //     var form = $(this).closest("form");
            //     var formName = form.attr("name");
            //     var formNameSplit = formName.split("-");

            //     if ("setup" === formNameSplit[formNameSplit.length - 1]) {
            //         location.href = "/";
            //     } else {
            //         $("#" + formName).addClass("completed").removeClass("active");
            //         $(this).closest(".segment").addClass("loading")
            //         $("#" + formName + "-check").children(".button").removeClass("red").addClass("green").children(".icon").removeClass("minus square outline").addClass("checkmark box");
            //         form.parent(".hidden").hide("fast", function() {
            //             nextIncompleteStep();
            //         });
            //     }
            // }
        }
    });
});
