<?php

class FeedbackController extends AbstractController {
    function constructor() {
        return $this->view->render('feedback-page', array());
    }
}
