(function($) {
  'use strict';

  $(function($) {
    $('.ui.form').form({
      fields: {
        'user[mail]': {
          identifier: 'user[mail]',
          rules: [{
            type: 'empty',
            prompt: 'E-mail пользователя должен быть заполнен'
          }, {
            type: 'email',
            prompt: 'Вы ввели не валидный E-mail адрес'
          }]
        },
        'user[password]': {
          identifier: 'user[password]',
          rules: [{
            type: 'empty',
            prompt: 'Пароль пользователя должн быть заполнен'
          }]
        }
      }
    });
  });
})(jQuery);
