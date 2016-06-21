<?php if ($is_edit): ?>
    <h4 class="text-center">Редактировать пользователя №<?php print $user->uid;?></h4>
<?php else: ?>
    <h4 class="text-center">Создать пользователя</h4>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php print $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post">
    <div class="form-group required<?php print !empty($errors['firstname']) ? ' has-error' : '' ?>">
        <label for="firstname">Имя</label>
        <input required type="text" class="form-control" id="firstname" placeholder="Иван" name="firstname" value="<?php print $values['firstname']; ?>">
    </div>
    <div class="form-group required<?php print !empty($errors['lastname']) ? ' has-error' : '' ?>">
        <label for="lastname">Фамилия</label>
        <input required type="text" class="form-control" id="lastname" placeholder="Петров" name="lastname" value="<?php print $values['lastname']; ?>">
    </div>
    <div class="form-group required<?php print !empty($errors['mail']) ? ' has-error' : '' ?>">
        <label for="mail">E-mail</label>
        <input required type="text" class="form-control" id="mail" placeholder="user@example.com" name="mail" value="<?php print $values['mail']; ?>">
    </div>

    <a href="/" class="btn btn-link">Назад</a>
    <?php if ($is_edit): ?>
        <button type="submit" class="btn btn-success">Обновить</button>
    <?php else: ?>
        <button type="submit" class="btn btn-default">Создать</button>
    <?php endif; ?>
</form>
