<div class="ui left vertical menu inverted sidebar">
    <a href="<?php print l('/'); ?>" class="item">
        <b><i class="home icon"></i> Dashboard</b>
    </a>
    <div class="item">
        <div class="header">
            <i class="university icon"></i> Деятельность
        </div>
        <div class="menu">
            <a class="item" href="<?php print l('/activity/list'); ?>">Список</a>
            <a class="item" href="<?php print l('/activity/add'); ?>">Добавить</a>
        </div>
    </div>
    <div class="item">
        <div class="header">
            <i class="users icon"></i> Пользователи
        </div>
        <div class="menu">
            <a class="item" href="<?php print l('/user/list'); ?>">Список</a>
            <a class="item" href="<?php print l('/user/add'); ?>">Добавить</a>
<!--            <a class="item">Роли пользователей</a>-->
<!--            <a class="item">Права пользователей</a>-->
        </div>
    </div>
    <a class="item">
        <b><i class="history icon"></i> История</b>
    </a>
    <a href="<?php print l('/settings'); ?>" class="item">
        <b><i class="settings icon"></i> Настройки</b>
    </a>
    <a href="<?php print l('/logout'); ?>" class="item">
        <b><i class="sign out icon"></i> Выйти</b>
    </a>
</div>
