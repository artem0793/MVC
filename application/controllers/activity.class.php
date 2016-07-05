<?php

class ActivityController extends AbstractController {

    function constructor() {
        $args = $this->args();

        $this->view->addJS('/application/theme/activity.js');

        switch (array_pop($args)) {
            case '':
            case 'list':
                return $this->listPage();

            case 'add':
                return $this->addPage();

            case 'edit':
                $aid = array_pop($args);

                if (!is_numeric($aid)) {
                    Router::setError(404);
                }

                $activity = $this->model->activityLoad($aid);

                if (empty($activity)) {
                    Router::setError(404);
                }

                return $this->editPage($activity);

            case 'delete':
                $aid = array_pop($args);

                if (!is_numeric($aid)) {
                    Router::setError(404);
                }

                $activity = $this->model->activityLoad($aid);

                if (empty($activity)) {
                    Router::setError(404);
                }

                return $this->deletePage($activity);

            default:
                Router::setError(404);
        }
    }

    private function listPage() {
        return $this->view->render('activity-list-page', array(
            'items' => $this->model->getActivityList(),
        ));
    }

    private function addPage() {
        $values = get_request_data(array(
            'name' => TRUE,
            'short' => TRUE,
        ), 'post');

        if (!empty($values)) {
            $this->model->activitySave($values);

            header('Location: ' . l('/activity/list'));
            exit;
        }

        return $this->view->render('activity-edit-page', array(
            'is_edit' => FALSE,
            'values' => $values,
        ));
    }

    private function editPage($activity) {
        $values = get_request_data(array(
            'name' => TRUE,
            'short' => TRUE,
        ), 'post');

        if (!empty($values)) {
            $this->model->activitySave($values + array('aid' => $activity->aid));

            header('Location: ' . l('/activity/list'));
            exit;
        }

        return $this->view->render('activity-edit-page', array(
            'is_edit' => TRUE,
            'values' => array_merge((array) $values, (array) $activity),
            'activity' => $activity,
        ));
    }

    private function deletePage($activity) {
        $values = get_request_data(array('confirm' => TRUE));

        if (!empty($values['confirm']) && $values['confirm'] == 'confirmed') {
            $this->model->activityDelete($activity->aid);
            header('Location: ' . l('/activity/list'));
            exit;
        }

        return $this->view->render('activity-delete-page', array(
            'activity' => $activity,
        ));
    }
}
