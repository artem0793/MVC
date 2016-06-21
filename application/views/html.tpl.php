<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8">
    <title>Веселый молочник</title>
    <style>
        @import 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css';
        @import '/application/theme/style.css';
    </style>
</head>
<body>
    <main class="wrapper">
        <header class="header">
            <h2>Демонстрация MVC шаблона</h2>
            <nav>
                <a href="/">Главная</a>
                <a href="/blog">Блог</a>
                <a href="/feedback">Обратная связь</a>
            </nav>
        </header>
        <div class="page-content"><?php print $page; ?></div>
        <footer class="footer"></footer>
    </main>
</body>
</html>
