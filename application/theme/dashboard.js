(function($) {
  'use strict';

  $(function($) {
    var $table = $('.dashboard.table'),
        $rows = $table.find('tbody tr'),
        $select_all = $table.find('.select-all'),
        $all_activity = $table.find('.activity'),
        $all_phones = $table.find('.input.phone'),
        $all_attached = $table.find('.attached'),
        groups = {};

    $rows.each(function(index, item) {
      var $this = $(item);

      if (typeof groups[$this.attr('data-uid')] != 'undefined') {
        groups[$this.attr('data-uid')] = groups[$this.attr('data-uid')].add($this);
      }
      else {
        groups[$this.attr('data-uid')] = $this;
      }
    });

    $select_all.on('change', function() {
      $all_activity.prop('checked', this.checked).trigger('change');
    });

    $.each(groups, function(uid, rows) {
      var $output = rows.first().find('.output'),
          $count = $output.next().find('.count'),
          $activities = rows.find('.activity'),
          $prices = rows.find('input.price'),
          $attached = rows.find('input.attached'),
          $phones = rows.find('input.phone'),
          $submit_button = $('.action-send'),
          $submit_button_count = $submit_button.find('.count');


      $output.on('change keypress', (function on_output_change(event) {
        $count.html(38 - $output.val().length);

        return on_output_change;
      })());

      $activities.add($prices).on('change', function() {
        var list = [];

        $.each($activities, function(index) {
          if (this.checked) {
            var price = $prices.eq(index).val();

            price = parseFloat(price) > 0 ? parseFloat(price) : 0.00;

            list.push(this.value + ': ' + price + 'грн');
          }
        });

        $output.html(list.length ? MVC.main.sms_pattern.replace('[list]', list.join("\r\n")) : '').trigger('change');
      });

      $output.add($phones).on('change mvc:change:trigger', function(index) {
        if ($output.val().length && $phones.filter(':checked').length) {
          $attached.prop('disabled', false);
        }
        else {
          $attached.prop('checked', false);
          $attached.prop('disabled', true);
        }
        $attached.trigger('change');
      }).trigger('change');

      $all_attached.on('change', function() {
        //var count = $all_phones.filter(':checked').length;
        var count = $all_attached.filter(':checked').length;

        $submit_button_count.html(count);

        $submit_button.prop('disabled', !count);
      });
    });
  });
})(jQuery);
