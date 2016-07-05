<?php include DAPP . '/views/blocks/main-menu.tpl.php'; ?>
<div class="pusher">
    <div class="ui basic segment">
        <form method="post" class="ui activity form <?php print $is_edit ? 'edit blue' : 'add green'; ?> segment">
            <?php if ($is_edit): ?>
                <h4 class="ui header">Редактировать деятельность "<?php print $activity->name;?>"</h4>
            <?php else: ?>
                <h4 class="ui header">Добавить деятельность</h4>
            <?php endif; ?>

            <div class="field">
                <div class="fields">
                    <div class="twelve wide field required">
                        <label>Название продукта</label>
                        <input type="text" name="name" value="<?php print $values['name']; ?>" placeholder="Пшеница 6 класс">
                    </div>
                    <div class="four wide field required">
                        <label>Коротко <small>(для смс)</small></label>
                        <input type="text" name="short" value="<?php print $values['short']; ?>" placeholder="Пш 6кл">
                    </div>
                </div>
            </div>
            <div class="ui error message"></div>
            <a href="<?php print l('/activity/list'); ?>" class="ui basic teal button">Назад</a>
            <?php if ($is_edit): ?>
                <button type="submit" class="ui green button">Обновить</button>
            <?php else: ?>
                <button type="submit" class="ui blue button">Создать</button>
            <?php endif; ?>
        </form>
    </div>
</div>
