<div class="install">
    <h2 class="ui teal image header">
        <i class="settings icon"></i>
        <div class="content">
            Конфигурация скрипта
        </div>
    </h2>
    <form method="post" class="ui form stacked segment">
        <div class="ui blue segment">
            <h4 class="ui header">MySQL</h4>
            <div class="fields">
                <div class="twelve wide field required">
                    <label>Хост</label>
                    <input type="text" name="db[host]" placeholder="localhost" value="localhost">
                </div>
                <div class="four wide field">
                    <label>Порт</label>
                    <input type="text" name="db[port]" placeholder="3306">
                </div>
            </div>
            <div class="two fields">
                <div class="field required">
                    <label>Имя пользователя</label>
                    <input type="text" name="db[username]" placeholder="root">
                </div>
                <div class="field">
                    <label>Пароль</label>
                    <input type="text" name="db[password]">
                </div>
            </div>
            <div class="field required">
                <label>Имя базы</label>
                <input type="text" name="db[name]" placeholder="mvc">
            </div>
        </div>
        <div class="ui green segment">
            <h4 class="ui header">Главный пользователь</h4>
            <div class="field required">
                <label>Имя</label>
                <input type="text" name="user[name]" placeholder="Admin">
            </div>
            <div class="field required">
                <label>E-mail</label>
                <input type="text" name="user[mail]" placeholder="admin@example.com">
            </div>
            <div class="field required">
                <label>Пароль</label>
                <input type="password" name="user[password]">
            </div>
        </div>
        <div class="ui error message"></div>
        <button class="ui positive button" type="submit">Установить</button>
    </form>
</div>
