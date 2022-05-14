<?php

// declar constantele
// const CST = 34; // valabilitate LOCALĂ
define('APP_PATH', 'myApp/');
define('MODELS', 'models/');
define('VIEWS', 'views/');
define('CONTROLLERS', 'controllers/');

// autoloader - pentru clase
spl_autoload_register(function($className){

    $relPath = '';

    $class = strtolower($className); // litere mici 

    if(substr_count($class, 'controller')) $relPath = CONTROLLERS;
    if(substr_count($class, 'model')) $relPath = MODELS;
    if(substr_count($class, 'view')) $relPath = VIEWS; // linie teoretc inutilă

    // calea în care voi căuta fișierul

    if($relPath == '') die ('invalid PATH!');

    $filePath = APP_PATH . $relPath . $className .'.php';

    // echo $filePath;

    if(file_exists($filePath)){
        require_once $filePath;
    }
    else {
        die("File NOT found! - $filePath");
    }
});

// ...