<?php include DAPP . '/views/blocks/main-menu.tpl.php'; ?>
<div class="pusher">
    <div class="ui basic segment">
        <div class="ui red segment">
            <h4 class="ui header">Удаление</h4>
            <p>Вы действительно хотите удалить пользователя "<?php print $user->name; ?>"?</p>
            <a href="<?php print l('/user/list'); ?>" class="ui basic teal button">Отмена</a>
            <a href="<?php print l('/user/' . $user->uid . '/delete/?confirm=confirmed'); ?>" class="ui red button">Удалить</a>
        </div>
    </div>
</div>
