<h3 class="text-center">Настройка доступов к базе данных.</h3>
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
    <p class="alert alert-info">Скрипт работает с базой данных MySQL, порт по умолчанию 3306</p>
    <div class="form-group">
        <label for="host">Хост</label>
        <input type="text" class="form-control" id="host" placeholder="localhost" name="host" value="localhost">
    </div>
    <div class="form-group">
        <label for="username">User name</label>
        <input type="text" class="form-control" id="username" name="username" value="root">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="text" class="form-control" id="password" name="password" value="cc">
    </div>
    <div class="form-group">
        <label for="dbname">Имя базы данных</label>
        <input type="text" class="form-control" id="dbname" name="dbname" value="mvc">
    </div>
    <div class="alert alert-info">
        <p>Перед установкой проекта необходимо:</p>
        <ol>
            <li>Создать пустой файл /application/config.php</li>
            <li>Добавить доступ на редактирование к PHP серверу на файл /application/config.php</li>
            <li>Создать базу данных в MySQL</li>
        </ol>
    </div>
    <button type="submit" class="btn btn-primary">Установить проект</button>
</form>
