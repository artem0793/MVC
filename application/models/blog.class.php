<?php

// Эмуляция запроса в базу данных.
$GLOBALS['database'] = array(
    'articles' => array(
        array(
            'id' => 1,
            'title' => 'Тестовая статья №1',
            'short' => 'Краткое описание тестовая статья №1',
            'full' => 'Очень полное описание тестовая статья №1',
        ),
        array(
            'id' => 2,
            'title' => 'Тестовая статья №2',
            'short' => 'Краткое описание тестовая статья №2',
            'full' => 'Очень полное описание тестовая статья №2',
        ),
        array(
            'id' => 3,
            'title' => 'Тестовая статья №3',
            'short' => 'Краткое описание тестовая статья №3',
            'full' => 'Очень полное описание тестовая статья №3',
        ),
        array(
            'id' => 4,
            'title' => 'Тестовая статья №4',
            'short' => 'Краткое описание тестовая статья №4',
            'full' => 'Очень полное описание тестовая статья №4',
        ),
        array(
            'id' => 5,
            'title' => 'Тестовая статья №5',
            'short' => 'Краткое описание тестовая статья №5',
            'full' => 'Очень полное описание тестовая статья №5',
        ),
    ),
);

class BlogModel extends AbstractModel {
    public function getArticleList() {
        global $database;

        return $database['articles'];
    }

    public function getArticleById($id) {
        global $database;

        foreach ($database['articles'] as $article) {
            if ($article['id'] == $id) {
                return $article;
            }
        }
    }
}
