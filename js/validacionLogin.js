$('.ui.form')
  .form({
    name: {
      identifier  : 'user',
      rules: [
        {
          type   : 'empty',
          prompt : 'ingrese usuario'
        }
      ]
    },
    gender: {
      identifier  : 'password',
      rules: [
        {
          type   : 'empty',
          prompt : 'Ingrese password'
        }
      ]
    },
  })
;
$('.ui.dropdown')
  .form(validationRules, {
    inline : true,
    on     : 'blur'
  })
;