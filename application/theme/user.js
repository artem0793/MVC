(function($) {
  'use strict';

  $(function($) {

    var $form = $('.ui.form'),
        fields = {
          name: {
            identifier: 'name',
            rules: [{
              type: 'empty',
              prompt: 'Имя пользователя должно быть заполнено'
            }]
          },
          mail: {
            identifier: 'mail',
            rules: [{
              type: 'empty',
              prompt: 'E-mail пользователя должен быть заполнен'
            }, {
              type: 'email',
              prompt: 'Вы ввели не валидный E-mail адрес'
            }]
          },
          'phone[0]': {
            identifier: 'phone[0][value]',
            optional: true,
            rules: [{
              type: 'regExp[/^\\+\\d{12}$/]',
              prompt: 'Неверный формат телефона. Пример: +380001112233'
            }]
          },
          'phone[1]': {
            identifier: 'phone[1][value]',
            optional: true,
            rules: [{
              type: 'regExp[/^\\+\\d{12}$/]',
              prompt: 'Неверный формат телефона. Пример: +380001112233'
            }]
          },
          'activity[]': {
            identifier: 'activity',
            rules: [{
              type: 'maxLength[5]',
              prompt: 'Пользователь не может владеть больше 4 деятельностей'
            }]
          }
        };

    if ($form.length) {
      var $phone_0 = $('[name=phone\\[0\\]\\[value\\]]', $form),
          $phone_1 = $('[name=phone\\[1\\]\\[value\\]]', $form);

      if ($form.hasClass('add')) {
        fields['password'] = {
          identifier: 'password',
          rules: [{
            type: 'empty',
            prompt: 'Пароль пользователя должн быть заполнен'
          }]
        };
      }

      if ($form.find('[name=rid]').length) {
        fields['rid'] = {
          identifier: 'rid',
          rules: [{
            type: 'empty',
            prompt: 'Пользователь нолжен иметь роль'
          }]
        };
      }

      $form.form({
        fields: fields
      });

      $form.find('.activities').dropdown({
        maxSelections: 4
      });

      $phone_0.add($phone_1).on('change', function() {
        if (!$phone_0.val()) {
          $phone_1.val('');
        }
      });
    }
  });
})(jQuery);
