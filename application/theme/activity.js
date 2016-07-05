(function($) {
  'use strict';

  $(function($) {
    $('.ui.form').form({
      fields: {
        name: {
          identifier: 'name',
          rules: [{
            type: 'empty',
            prompt: 'Поле "Название" должно быть заполнено'
          }]
        },
        short: {
          identifier: 'short',
          rules: [{
            type: 'empty',
            prompt: 'Поле "Краткое название" должно быть заполнено'
          }]
        }
      }
    });
  });
})(jQuery);
