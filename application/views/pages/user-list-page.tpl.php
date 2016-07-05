<?php include DAPP . '/views/blocks/main-menu.tpl.php'; ?>
<div class="pusher">
    <div class="ui basic segment">
        <h3 class="ui header">Активные пользователи</h3>

        <a href="<?php print l('/user/add'); ?>" class="ui labeled icon blue button"><i class="add user icon"></i> Добавить пользователя</a>

        <table class="ui selectable padded table">
            <thead>
                <tr>
                    <th width="100">ID</th>
                    <th width="30%">Имя</th>
                    <th width="30%">E-mail</th>
                    <th>Роль</th>
                    <th width="130">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($user_list as $user): ?>
                <tr>
                    <td><?php print $user->uid; ?></td>
                    <td><?php print $user->name; ?></td>
                    <td><?php print $user->mail; ?></td>
                    <td>
                        <?php if ($user->uid > 1): ?>
                            <?php print $user->role; ?>
                        <?php else: ?>
                            Супер пользователь
                        <?php endif; ?>
                    </td>
                    <td class="center aligned">
                        <a href="<?php print l('/user/' . $user->uid . '/edit'); ?>" class="ui small icon green button">
                            <i class="write icon"></i>
                        </a>
                        <?php if ($user->uid != 1): ?>
                        <a href="<?php print l('/user/' . $user->uid . '/delete'); ?>" class="ui small icon red button">
                            <i class="remove user icon"></i>
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!count($user_list)): ?>
                <tr>
                    <td colspan="5" class="text-center">
                        Нет пользователей. <a href="<?php print l('/user/add'); ?>">Добавить пользователя</a>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
