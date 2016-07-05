<?php include DAPP . '/views/blocks/main-menu.tpl.php'; ?>
<div class="pusher">
    <div class="ui basic segment">
        <div class="ui red segment">
            <h4 class="ui header">Удаление</h4>
            <p>Вы действительно хотите удалить деятельность "<?php print $activity->name; ?>"?</p>
            <a href="<?php print l('/activity/list'); ?>" class="ui basic teal button">Отмена</a>
            <a href="<?php print l('/activity/' . $activity->aid . '/delete/?confirm=confirmed'); ?>" class="ui red button">Удалить</a>
        </div>
    </div>
</div>
