<?php 

class ControllerListPage{
    
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

   public static function GetFilteredActivities(){
        global $pdo;

        header('Access-Control-Allow-Origin: *');  
        header('Content-Type: application/json; charset=utf-8'); 

        try{
        $sqltxt = 'SELECT id, name, description, image, level, coach, schedule_day, location FROM activities WHERE 1=1';

        $coach = $_GET['coach'] ?? null;
        $day = $_GET['schedule_day'] ?? null;
        $intensity = $_GET[''] ?? null;
        $location = $_GET['location'] ?? null;

        if(isset($coach)){
            $sqltxt .= "AND coach =.'$coach'";
        }

        if(isset($day)){
            $sqltxt .= "AND schedule_day =.'$day'"; 
        }

        if(isset($intensity)){
            $sqltxt .= "AND level =.'$intensity'";
        }

        if(isset($location)){
            $sqltxt .= "AND level =.'$location'";
        }

        $stmt = $pdo->query($sqltext);
        $ActFilters = $stmt->fetchAll();
        $echo json_encode($ActFilters);
        
        }
        catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }

}
}
?>