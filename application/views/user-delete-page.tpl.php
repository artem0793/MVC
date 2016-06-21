<h3 class="text-center">Удаление</h3>
<p>Вы действительно хотите удалить пользователя "<?php print $user->lastname; ?> <?php print $user->firstname; ?>"?</p>
<a href="/" class="btn btn-link">Отмена</a>
<a href="/user/<?php print $user->uid; ?>/delete/?confirm=1" class="btn btn-danger">Удалить</a>
