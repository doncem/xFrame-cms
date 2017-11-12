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
  // checkboxes

  $('.ui.checkbox').checkbox();

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
});
