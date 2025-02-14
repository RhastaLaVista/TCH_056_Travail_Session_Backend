<?php 

class ControllerMainPage {

    public static function getRandomActivities(){
        global $pdo;

        header('Access-Control-Allow-Origin: *');  
        header('Content-Type: application/json; charset=utf-8');  

        try {
            echo json_encode($pdo->query('SELECT * from activities ORDER BY RAND() LIMIT 4')->fetchALL());
        }
        catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public static function getAllCoaches(){
        global $pdo;

        header('Access-Control-Allow-Origin: *');  
        header('Content-Type: application/json; charset=utf-8');  

        try {
            echo json_encode($pdo->query('SELECT * from coaches')->fetchALL());
        }
        catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public static function getAllLevels(){
        global $pdo;

        header('Access-Control-Allow-Origin: *');  
        header('Content-Type: application/json; charset=utf-8');  

        try {
            echo json_encode($pdo->query('SELECT * from levels')->fetchALL());
        }
        catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public static function getAllActivities(){
        global $pdo;

        header('Access-Control-Allow-Origin: *');  
        header('Content-Type: application/json; charset=utf-8');  

        try {
            echo json_encode($pdo->query('SELECT * from activities ORDER BY id')->fetchALL());
        }
        catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public static function getAllLocations(){
        global $pdo;

        header('Access-Control-Allow-Origin: *');  
        header('Content-Type: application/json; charset=utf-8');  

        try {
            echo json_encode($pdo->query('SELECT * from locations ORDER BY id')->fetchALL());
        }
        catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}



?>