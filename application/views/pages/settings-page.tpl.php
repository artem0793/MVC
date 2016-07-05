<?php include DAPP . '/views/blocks/main-menu.tpl.php'; ?>
<div class="pusher">
    <div class="ui basic segment">
        <h3 class="ui header">Настройка скрипта</h3>
        <form method="post" class="ui form">
            <div class="ui top attached tabular menu">
                <a class="item active" data-tab="general">Основные</a>
                <a class="item" data-tab="sms">SMS</a>
            </div>
            <div class="ui bottom attached tab segment active" data-tab="general">
                <div class="field required">
                    <label>Часовой пояс</label>
                    <select name="time_zone" class="ui search selection dropdown">
                        <?php foreach (timezone_identifiers_list() as $zone): ?>
                            <option value="<?php print $zone; ?>" <?php print $zone == $date_timezone ? 'selected' : ''; ?>><?php print $zone ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="ui bottom attached tab segment" data-tab="sms">
                <div class="field">
                    <label>Шаблон СМС сообщения</label>
                    <textarea name="sms_pattern"><?php print $sms_pattern; ?></textarea>
                    <p class="ui ignored message">
                        [date] - Дата за которую отправляются данные.<br>
                        [list] - Список деятельностей.
                    </p>
                </div>
                <div class="field required">
                    <label>Шаблон СМС сообщения</label>
                    <input type="text" name="sms_datetime_format" value="<?php print $sms_datetime_format; ?>">
                    <p class="ui ignored message">
                        d - День месяца, 2 цифры с ведущим нулём (от 01 до 31)<br>
                        j - День месяца без ведущего нуля (от 1 до 31)<br>
                        N - Порядковый номер дня недели (от 1 (понедельник) до 7 (воскресенье))<br>
                        z - Порядковый номер дня в году (начиная с 0) (От 0 до 365)<br>
                        m - Порядковый номер месяца с ведущим нулём (от 01 до 12)<br>
                        n - Порядковый номер месяца без ведущего нуля (от 1 до 12)<br>
                        t - Количество дней в указанном месяце (от 28 до 31)<br>
                        Y - Порядковый номер года, 4 цифры (Порядковый номер года, 4 цифры)<br>
                        g - Часы в 12-часовом формате без ведущего нуля (от 1 до 12)<br>
                        G - Часы в 24-часовом формате без ведущего нуля (от 0 до 23)<br>
                        h - Часы в 12-часовом формате с ведущим нулём (от 01 до 12)<br>
                        H - Часы в 24-часовом формате с ведущим нулём (от 00 до 23)<br>
                        i - Минуты с ведущим нулём (от 00 до 59)<br>
                        s - Секунды с ведущим нулём (от 00 до 59)<br>
                        Подробнее на <a href="http://php.net/manual/ru/function.date.php#refsect1-function.date-parameters">php.net</a>
                    </p>
                </div>
                <div class="ui orange segment">
                    <h3 class="ui header">
                        <img class="ui image" src="https://smsclub.mobi/img/logo.png">
                        <div class="content">Подключение сервиса, API</div>
                    </h3>
                    <h4 class="ui header">HTTP-шлюз</h4>
                    <div class="field required">
                        <label>Адрес службы</label>
                        <input type="text" name="sms_host" value="<?php print $sms_host; ?>" placeholder="https://gate.smsclub.mobi/http/">
                        <p>Логин учетной записи пользователя.</p>
                    </div>
                    <div class="field required">
                        <label>Username</label>
                        <input type="text" name="sms_username" value="<?php print $sms_username; ?>">
                        <p>Логин учетной записи пользователя.</p>
                    </div>
                    <div class="field required">
                        <label>Password</label>
                        <input type="text" name="sms_password" value="<?php print $sms_password; ?>">
                        <p>Пароль учетной записи пользователя.</p>
                    </div>
                    <div class="field required">
                        <label>From</label>
                        <div id="sms_from_list" class="ui list"></div>
                        <div class="ui action input" id="sms_from_add_form" style="width: 400px;">
                            <input type="text" placeholder="Aльфа-имя">
                            <button class="ui blue button" type="button">Добавить</button>
                        </div>
                        <p>Aльфа-имя, от которого идет отправка (11 английских символов, цифры, пробел).</p>
                    </div>
                    <div class="field required">
                        <label>Lifetime</label>
                        <input type="number" step="1" min="0" name="sms_lifetime" value="<?php print $sms_lifetime; ?>">
                        <p>Установка срока жизни СМС, который указывается в минутах.</p>
                    </div>
                </div>
            </div>
            <button type="submit" class="ui green button">Сохранить</button>
        </form>
    </div>
</div>
