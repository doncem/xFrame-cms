var formFieldRules = {
  email: function(id) {
    return {
      identifier: id,
      rules: [
        {
          type   : 'empty',
          prompt : 'I need an email'
        },
        {
          type   : 'maxLength[100]',
          prompt : 'Too long. Max {ruleValue} characters'
        },
        {
          type   : 'email',
          prompt : 'Must be an email'
        }
      ]
    };
  },
  password: function(id) {
    return {
      identifier: id,
      rules: [
        {
          type   : 'empty',
          prompt : 'I need a password'
        },
        {
          type   : 'minLength[8]',
          prompt : 'Password must be {ruleValue} character long'
        },
        {
          type   : 'regExp',
          value  : /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/,
          prompt : 'Alpha numeric with mixture of upper and lower cases required'
        }
      ]
    };
  },
  terms: function() {
    return {
      identifier: 'terms',
      rules: [
        {
          type   : 'checked',
          prompt : 'Check the terms and conditions'
        }
      ]
    }
  }
};

$(document).ready(function() {
  // forms

  $('.ui.form[name="login"]').form({
    on: 'blur',
    inline: true,
    fields: {
      email: formFieldRules.email('login-email'),
      password: formFieldRules.password('login-password'),
      terms: formFieldRules.terms()
    }
  });

  $('.ui.form[name="register"]').form({
    on: 'blur',
    inline: true,
    fields: {
      email: formFieldRules.email('register-email'),
      emailConfirm: {
        identifier: 'email-confirm',
        rules: [
          {
            type   : 'empty',
            prompt : 'Repeat the email'
          },
          {
            type   : 'match[register-email]',
            prompt : 'Email mismatch'
          }
        ]
      },
      terms: formFieldRules.terms()
    }
  });

  $('.ui.form[name="setup-db"]').form({
    on: 'blur',
    inline: true,
    fields: {
      password: formFieldRules.password('db-password')
    }
  });

  // ajax

  $.fn.api.settings.api = {
    'save setup': '/setup-save/{step}',
    'verify setup': '/setup-verify/{step}'
  };

  $.fn.checkSuccess = function(response, field, clazz, text) {
    if (response[field]) {
      this.text('OK').delay(2000).queue(function(next) {
        $(this).text(text);
        next();
      });
    } else {
      this.text('Fail').addClass('red').removeClass(clazz).delay(2000).queue(function(next) {
        $(this).removeClass('red').addClass(clazz).text(text);
        next();
      });
    }
  };

  $('.ui.form[name="setup-db"] .verify').api({
    method : 'POST',
    serializeForm: true,
    onSuccess: function(response) {
      $(this).checkSuccess(response, 'verified', 'green', 'Verify')
    }
  });

  $('.ui.form[name="setup-db"] .save').api({
    method : 'POST',
    serializeForm: true,
    onSuccess: function(response) {
      $(this).checkSuccess(response, 'success', 'primary', 'Save')
    }
  });
});
