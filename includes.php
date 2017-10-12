<?php

// ini_set('display_errors', 1);
//import calsses
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});