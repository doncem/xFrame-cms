$(document).ready(function() {
    var showContainer = function(id) {
        var elem = $("#" + id);
        elem.show("slow");
        elem.parent(".segment").removeClass("loading");
    }

    // setup container

    var nextIncompleteStep = function() {
        $("#setup-container .step:not(.completed):first").addClass("active").each(function() {
            showContainer($(this).attr("id") + "-container");
        });
    }
    nextIncompleteStep();

    // forms

    $(".ui.form.disabled").removeClass("disabled").parent(".segment").addClass("disabled");

    $(".ui.form[name='setup-database']").form({
        on: "blur",
        inline: true,
        fields: {
            password: formFieldRules.password("db-password")
        }
    });

    // ajax

    $.fn.api.settings.api = {
        "save setup": "/setup-save/{step}",
        "verify setup": "/setup-verify/{step}"
    };

    $.fn.checkSuccess = function(response, field, clazz, text) {
        if (response[field]) {
            this.text("OK").delay(2000).queue(function(next) {
                $(this).text(text);
                next();
            });
        } else {
            this.text("Fail").addClass("red").removeClass(clazz).delay(2000).queue(function(next) {
                $(this).removeClass("red").addClass(clazz).text(text);
                next();
            });
        }

        return response[field];
    };

    $(".ui.form[name*='setup-'] .verify").api({
        method : "POST",
        serializeForm: true,
        onSuccess: function(response) {
            $(this).checkSuccess(response, "verified", "green", "Verify");
        },
        onFailure: function(response) {
            $(this).checkSuccess({"success":false}, "success", "green", "Verify");
        }
    });

    $(".ui.form[name*='setup-'] .save").api({
        method : "POST",
        serializeForm: true,
        onSuccess: function(response) {
            var isSuccess = $(this).checkSuccess(response, "success", "primary", "Save")

            if (isSuccess) {
                var form = $(this).closest("form");
                var formName = form.attr("name");
                var formNameSplit = formName.split("-");

                if ("setup" === formNameSplit[formNameSplit.length - 1]) {
                    location.href = "/";
                } else {
                    $("#" + formName).addClass("completed").removeClass("active");
                    $(this).closest(".segment").addClass("loading")
                    $("#" + formName + "-check").children(".button").removeClass("red").addClass("green").children(".icon").removeClass("minus square outline").addClass("checkmark box");
                    form.parent(".hidden").hide("fast", function() {
                        nextIncompleteStep();
                    });
                }
            }
        }
    });

    $("#setup-container > .link.step").on("click", function() {
        $("#setup-container > .active").removeClass("active");
        var id = $(this).addClass("active").attr("id");
        $(".segment > .hidden:visible").hide("fast", function() {
            $("#" + id + "-container").show("slow");
        })
    });

    $("#setup-setup-container .ui.button").on("click", function() {
        $("#setup-container > .active").removeClass("active");
        var id = $(this).parent("p").attr("id").split("-");
        var stepId = id[0] + "-" + id[1];
        $("#" + stepId).addClass("active");
        $(this).closest(".hidden").hide("fast", function() {
            $("#" + stepId + "-container").show("fast");
        })
    });
});
