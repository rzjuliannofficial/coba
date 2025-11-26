<?php

class Controller
{
    public function view($path, $data = [])
    {
        extract($data);
        require "../app/views/{$path}.php";
    }

    public function model($model)
    {
        require "../app/models/{$model}.php";
        return new $model;
    }

    public function modelWebsite($model)
    {
        require "../app/models/website/{$model}.php";
        return new $model;
    }
}
