<?php

//Route::group(['middleware' => ['siravel-analytics']], function () {                                                                                                                           
    $alias = 'public.';
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "admin.php";
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "components.php";
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "plugins.php";
    // include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "wiki.php";
    // include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "book.php";
//});    