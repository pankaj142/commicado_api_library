<?php

require_once __DIR__. '/class/class-auth.php';
foreach(glob( __DIR__ . '/helpers/*.php') as $file){
    require_once $file;
}
foreach(glob( __DIR__ . '/class/*.php') as $file){
    require_once $file;
}