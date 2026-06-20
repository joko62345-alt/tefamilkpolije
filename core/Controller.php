<?php

class Controller {
    public function view($view, $data = []) {
        if (!empty($data)) {
            extract($data);
        }
        
        $viewFile = '../views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View {$view} not found!");
        }
    }

    public function model($model) {
        $modelFile = '../app/Models/' . $model . '.php';
        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $model;
        } else {
            die("Model {$model} not found!");
        }
    }
}
