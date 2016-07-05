(function($) {
  'use strict';

  $(function() {
    var $sms_from_list = $('#sms_from_list'),
        $sms_from_add_form = $('#sms_from_add_form'),
        $sms_from_button = $('button', $sms_from_add_form),
        $sms_from_input = $('input[type=text]', $sms_from_add_form),
        $sms_from_list_empty = $('<div class="ui blue message empty">Добавьте Aльфа-имя</div>').hide(),
        add_from_to_list = function(value) {
          var $template = $(
            '<div class="item">' +
            value +
            '<a href="'+ l('/settings/?action=sms_from_remove&value=' + MVC.sms_from[i]) + '">' +
            '<i class="remove red icon"></i>' +
            '</a>' +
            '</div>'
          ).hide();

          $template.find('a').on('click', function(event) {
            event.preventDefault();

            var $this = $(this),
                $icon = $this.find('i'),
                $item = $this.parents('.item');

            $icon.attr('class', 'notched circle loading icon');

            if (confirm('Вы действительно хотите удалить альфо-имя "' + value + '"')) {
              $.ajax({
                url: this.href,
                success: function(data, textStatus, jqXHR) {
                  if (jqXHR.status == 200) {
                    $item.fadeOut(200, function() {
                      $item.remove();
                      $sms_from_list.trigger('mvc:change');
                    });
                  }
                  else {
                    alert('Сетевая ошибка, проверьте соединение с интернет');
                    $icon.attr('class', 'warning orange icon');
                  }
                }
              });
            }
            else {
              $icon.attr('class', 'remove red icon');
            }
          });

          $sms_from_list.append($template);
          $template.fadeIn(200);
          $sms_from_list.trigger('mvc:change');
        };

    $sms_from_button.on('click', function(event) {
      event.preventDefault();

      if ($sms_from_input.val()) {
        $sms_from_button.addClass('loading');
        $.ajax({
          url: l('/settings/?action=sms_from_add&value=' + $sms_from_input.val()),
          success: function(data, textStatus, jqXHR) {
            if (jqXHR.status == 200) {
              add_from_to_list($sms_from_input.val());
              $sms_from_input.val('');
              $sms_from_button.removeClass('loading');
            }
            else {
              alert('Сетевая ошибка, проверьте соединение с интернет');
            }
          }
        });
      }
    });

    if (MVC.sms_from) {
      for (var i in MVC.sms_from) {
        if (MVC.sms_from.hasOwnProperty(i)) {
          add_from_to_list(MVC.sms_from[i]);
        }
      }
    }

    $sms_from_list.before($sms_from_list_empty);

    $sms_from_list.on('mvc:change', (function on_mvc_change() {
      if ($sms_from_list.children().length) {
        $sms_from_list_empty.fadeOut(100);
      }
      else {
        $sms_from_list_empty.fadeIn(100);
      }

      return on_mvc_change;
    })());
  });
})(jQuery);
