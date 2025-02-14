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

get('/api/levels', function(){
    ControllerMainPage::getAllLevels();
});

get('/api/activities/filter', function($coach, $level, $location){
    ControllerListPage::getFilteredActivities($coach, $level, $location);
});

get('/api/activities/$id', function($id){
    ControllerFormPage::getSpecificActivity($id);
});

get('/api/locations', function(){
    ControllerMainPage::getAllLocations();
});



put('/api/activities/$id', function($id){
    ControllerFormPage::updateActivity($id);
});

post('/api/activities', function(){
    ControllerFormPage::addActivity();
});

any('/404', function() {
    http_response_code(404);
    echo json_encode(["error" => "route not found"]);
});

?>