<div class="login">
    <h2 class="ui teal image header">
        <i class="user icon"></i>
        <div class="content">
            Панель управления
        </div>
    </h2>
    <form method="post" class="ui form stacked segment">
        <div class="field required">
            <label>E-mail</label>
            <input type="text" name="user[mail]" placeholder="admin@example.com">
        </div>
        <div class="field required">
            <label>Пароль</label>
            <input type="password" name="user[password]">
        </div>
        <div class="ui error message"></div>
        <button class="ui primary button" type="submit">Войти</button>
    </form>
</div>
