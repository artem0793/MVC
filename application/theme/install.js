(function($) {
  'use strict';

  $(function($) {
    $('.ui.form').form({
      fields: {
        'db[host]': {
          identifier: 'db[host]',
          rules: [{
            type: 'empty',
            prompt: 'Поле "Хост" должно быть заполнено'
          }]
        },
        'db[port]': {
          identifier: 'db[port]',
          optional: true,
          rules: [{
            type: 'integer[1..9999]',
            prompt: 'Порт может быть от 1-9999'
          }]
        },
        'db[username]': {
          identifier: 'db[username]',
          rules: [{
            type: 'empty',
            prompt: 'Имя пользователя БД должно быть заполнено'
          }]
        },
        'db[name]': {
          identifier: 'db[name]',
          rules: [{
            type: 'empty',
            prompt: 'Имя БД должно быть заполнено'
          }]
        },
        'user[name]': {
          identifier: 'user[name]',
          rules: [{
            type: 'empty',
            prompt: 'Имя пользователя должно быть заполнено'
          }]
        },
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
