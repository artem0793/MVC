<?php include DAPP . '/views/blocks/main-menu.tpl.php'; ?>
<div class="pusher">
    <div class="ui basic segment">
        <form method="post" class="ui user form <?php print $is_edit ? 'edit blue' : 'add green'; ?> segment">
            <?php if ($is_edit): ?>
                <h4 class="ui header">Редактировать пользователя "<?php print $user->name;?>"</h4>
            <?php else: ?>
                <h4 class="ui header">Добавить пользователя</h4>
            <?php endif; ?>
            <div class="field required">
                <label>Имя</label>
                <input type="text" name="name" placeholder="Kevin" value="<?php print $values['name']; ?>">
            </div>
            <div class="field required">
                <label>E-mail</label>
                <input type="text" name="mail" placeholder="admin@example.com"  value="<?php print $values['mail']; ?>">
            </div>
            <?php if (!$is_edit || $user->uid != 1): ?>
            <div class="field required">
                <label>Роль</label>
                <select  name="rid" class="ui dropdown">
                    <option value=""></option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?php print $role->rid; ?>" <?php print $values['rid'] == $role->rid ? 'selected' : ''; ?>><?php print $role->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php endif; ?>
            <div class="field<?php print $is_edit ? '' : ' required'; ?>">
                <label>Пароль</label>
                <input type="password" name="password">
            </div>

            <div class="ui purple segment profile">
                <h4 class="ui header">Профиль</h4>
                <div class="field">
                    <label>Телефоны</label>
                    <div class="field">
                        <input type="text" name="phone[0][value]" placeholder="Основной телефон" value="<?php print !empty($values['phone'][0]['value']) ? $values['phone'][0]['value'] : ''; ?>">
                    </div>
                    <div class="field">
                        <input type="text" name="phone[1][value]" placeholder="Дополнительный телефон" value="<?php print !empty($values['phone'][1]['value']) ? $values['phone'][1]['value'] : ''; ?>">
                    </div>
                    <p class="ui message">
                        Телефон должен быть в формате +380001112233
                    </p>
                </div>
                <div class="field">
                    <label>Деятельность</label>
                    <select id="activity" name="activity[]" multiple class="ui search dropdown custom activities">
                        <option value="">Добавьте деятельность</option>
                        <?php foreach ($activity_list as $aid => $name): ?>
                            <option value="<?php print $aid; ?>" <?php

                            print in_array($aid, (array) $values['activity']) ? 'selected' : '';

                            ?>><?php print $name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="ui error message"></div>
            <a href="<?php print l('/user/list'); ?>" class="ui basic teal button">Назад</a>
            <?php if ($is_edit): ?>
            <button type="submit" class="ui green button">Обновить</button>
            <?php else: ?>
            <button type="submit" class="ui blue button">Создать</button>
            <?php endif; ?>
        </form>
    </div>
</div>
