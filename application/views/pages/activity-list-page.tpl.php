<?php include DAPP . '/views/blocks/main-menu.tpl.php'; ?>
<div class="pusher">
    <div class="ui basic segment">
        <h3 class="ui header">Деятельность</h3>

        <a href="<?php print l('/activity/add'); ?>" class="ui labeled icon blue button"><i class="plus icon"></i> Добавить деятельность</a>

        <table class="ui selectable padded table">
            <thead>
            <tr>
                <th width="100">ID</th>
                <th>Продукт</th>
                <th width="130">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $activity): ?>
                <tr>
                    <td><?php print $activity->aid; ?></td>
                    <td><?php print $activity->name; ?></td>
                    <td class="center aligned">
                        <a href="<?php print l('/activity/' . $activity->aid . '/edit'); ?>" class="ui small icon green button">
                            <i class="write icon"></i>
                        </a>
                        <a href="<?php print l('/activity/' . $activity->aid . '/delete'); ?>" class="ui small icon red button">
                            <i class="remove icon"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!count($items)): ?>
                <tr>
                    <td colspan="3" class="text-center">
                        Нет деятельностей. <a href="<?php print l('/activity/add'); ?>">Добавить деятельность</a>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
