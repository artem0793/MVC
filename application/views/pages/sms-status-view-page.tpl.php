<?php include DAPP . '/views/blocks/main-menu.tpl.php'; ?>
<div class="pusher">
    <div class="ui basic segment">
        <h3 class="ui header">Отчет отправки CMC</h3>
        <button class="ui labeled icon blue button">
            <i class="refresh icon"></i> Проверить статусы
        </button>
        <table class="ui celled table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Статус</th>
                <th>Имя</th>
                <th>Номер</th>
                <th>Альфа Имя</th>
                <th>Сообщение</th>
                <th>Время отправки</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="collapsing">1</td>
                <td class="collapsing status"><b>Отправка</b></td>
                <td><a href="/user/1/edit">Вася</a></td>
                <td>+380666520019</td>
                <td>Альфа Имя</td>
                <td><pre>06.07.16
пш 7кл: 19.71грн
пш 2кл: 9.97грн
пш 6кл: 12.03грн</pre></td>
                <td class="collapsing">06.07.16 14:33</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
