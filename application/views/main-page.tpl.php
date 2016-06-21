<h3 class="text-center">Добро пожаловать</h3>

<p>
    <a href="/user/add" class="btn btn-success btn-xs">
        <span class="glyphicon glyphicon-plus"></span> Добавить пользователя
    </a>
</p>

<table class="table table-bordered table-hover">
    <tr>
        <th width="50">ID</th>
        <th>Фамилия, Имя</th>
        <th>Почта</th>
        <th width="120">Действия</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td class="text-right"><?php print $user->uid; ?></td>
            <td>
                <?php print $user->lastname; ?>
                <?php print $user->firstname; ?>
            </td>
            <td><?php print $user->mail; ?></td>
            <td class="text-center">
                <a href="/user/<?php print $user->uid; ?>/edit" class="btn btn-primary btn-xs">
                    <span class="glyphicon glyphicon-cog"></span>
                </a>
                <a href="/user/<?php print $user->uid; ?>/delete" class="btn btn-danger btn-xs">
                    <span class="glyphicon glyphicon-remove"></span>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if (!count($users)): ?>
        <tr>
            <td colspan="4" class="text-center">
                Нет пользователей. <a href="/user/add">Добавить пользователя</a>
            </td>
        </tr>
    <?php endif; ?>
</table>
