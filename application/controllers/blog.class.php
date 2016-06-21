<?php

class BlogController extends AbstractController {
    function constructor() {
        if ($this->args(0)) {
            $article = $this->model->getArticleById($this->args(0));

            if ($article) {
                return $this->view->render('blog-article-view-page', array(
                    'article' => $article,
                ));
            }

            Router::setError(404);
        }
        else {
            return $this->view->render('blog-list-page', array(
                'list' => $this->model->getArticleList(),
            ));
        }
    }
}
