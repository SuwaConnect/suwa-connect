<?php

class Controller
{
    // Load model
    public function model($model)
    {
        // Require model file
        require_once '../app/models/' . $model . '.php';

        // Instantiate model
        return new $model();
    }

    // Load view
    public function view($view, $data = [])
{
    // Extract variables from $data array
    foreach ($data as $key => $value) {
        $$key = $value; // Creates variables from data keys
    }

    // Load the view file
    if (file_exists('../app/views/' . $view . '.php')) {
        require_once '../app/views/' . $view . '.php';
    } else {
        die('View does not exist');
    }
}


    
}