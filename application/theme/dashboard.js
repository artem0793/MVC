(function($) {
  'use strict';

  $(function($) {
    var $table = $('.dashboard.table'),
        $send_sms_popup = $('#send-sms-popup'),
        $send_sms_popup_list = $send_sms_popup.find('.sms-list'),
        $send_sms_popup_count = $send_sms_popup.find('.count'),
        $send_sms_popup_approve = $send_sms_popup.find('.approved'),
        $send_sms_popup_status_view = $send_sms_popup.find('.status-view'),
        $dashboard_form = $('#dashboard-form'),
        $rows = $table.find('tbody tr'),
        $select_all = $table.find('.select-all'),
        $all_activity = $table.find('.activity'),
        $all_attached = $table.find('.attached'),
        data = [],
        groups = {};
    $send_sms_popup_status_view.on('click', function(event) {
      event.preventDefault();
      window.location.href = l('/main/sms/view');
    });

    $send_sms_popup_approve.on('click', function(event) {
      event.preventDefault();

      if (!$send_sms_popup_approve.hasClass('loading')) {
        $send_sms_popup_approve.addClass('loading');

        $.ajax({
          async: false,
          url: l('/main/sms/send'),
          data: {
            sms_list: data
          },
          method: 'POST',
          success: function(data, textStatus, jqXHR) {
            if (jqXHR.status == 200) {
              $send_sms_popup_approve.removeClass('loading').prop('disabled', true);
              $send_sms_popup_status_view.prop('disabled', false);
              $all_attached.filter(':checked').prop('checked', false).trigger('change');
            }
            else {
              alert('Сетевая ошибка, проверьте соединение с интернет и обновите страницу');
            }
          }
        });
      }
    });

    $rows.each(function(index, item) {
      var $this = $(item);

      if (typeof groups[$this.attr('data-uid')] != 'undefined') {
        groups[$this.attr('data-uid')] = groups[$this.attr('data-uid')].add($this);
      }
      else {
        groups[$this.attr('data-uid')] = $this;
      }
    });

    $dashboard_form.on('submit', function(event) {
      event.preventDefault();

      $send_sms_popup_status_view.prop('disabled', true);
      $send_sms_popup_approve.prop('disabled', false);

      var $selected_items = $all_attached.filter(':checked'),
          count = 0,
          html = '';

      $selected_items.each(function() {
        var $this = $(this),
            $sms_text = $this.parents('tr').find('.output'),
            uid = $this.parents('tr').attr('data-uid'),
            name = groups[uid].first().children().first().html();

        $this.parents('tr').find('input.phone').filter(':checked').each(function() {
          var $_this = $(this),
              activities = {},
              $activities = groups[uid].find('.activity').filter(':checked');

          $activities.parents('td').prev('.col-price').find('input.price').each(function(i) {
            activities[$(this).attr('data-aid')] = this.value;
          });

          data.push({
            uid: uid,
            phone: $_this.val(),
            text: $sms_text.val(),
            activities: activities
          });

          html += '<tr>';
          html += '<td>' + name + '</td>';
          html += '<td>' + $this.val() + '</td>';
          html += '<td>' + $_this.val() + '</td>';
          html += '<td><pre>' + $sms_text.val() + '</pre></td>';
          html += '</tr>';
          count++;
        });
      });

      $send_sms_popup_count.html(count);
      $send_sms_popup_list.html(html);
      $send_sms_popup.modal('show', data);
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

      $output.on('change keypress', (function on_output_change() {
        $count.html(38 - $output.val().length);

        return on_output_change;
      })());

      $all_attached.on('change', function() {
        var $all_attached_checked = $all_attached.filter(':checked'),
            count = 0;

        $all_attached_checked.each(function(index) {
          count +=$all_attached_checked.eq(index).parents('tr').find('input.phone').filter(':checked').length;
        });

        $submit_button_count.html(count);

        $submit_button.prop('disabled', !count);
      });

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
    });
  });
})(jQuery);
