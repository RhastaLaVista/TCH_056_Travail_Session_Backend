<?php 

require_once (__DIR__.'/router.php');

require 'config.php';
require './src/controller/ControllerMainPage.php';
require './src/controller/ControllerFormPage.php';
require './src/controller/ControllerListPage.php';


get('/api/activities/random', function(){
    ControllerMainPage::getRandomActivities();
});

get('/api/activities', function(){
    ControllerMainPage::getAllActivities();
});

get('/api/coaches', function(){
    ControllerMainPage::getAllCoaches();
});

get('/api/activities/$id', function($id){
    ControllerFormPage::getSpecificActivity($id);
});

get('/api/locations', function(){
    ControllerFormPage::getAllLocations();
});

put('/api/activities/$id', function($id){
    ControllerFormPage::updateActivity($id);
})

?>