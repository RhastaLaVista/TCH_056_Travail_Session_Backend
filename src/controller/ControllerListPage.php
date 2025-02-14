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

   public static function GetFilteredActivities($coach, $level, $location){
        global $pdo;

        echo $coach;
        echo $level;
        echo $location;

        header('Access-Control-Allow-Origin: *');  
        header('Content-Type: application/json; charset=utf-8');

            $sql = $pdo->prepare('SELECT *
            FROM activities a
            JOIN coaches c ON a.coach_id = c.id
            JOIN levels l ON a.level_id = l.id
            JOIN locations loc ON a.location_id = loc.id
            WHERE (c.name = :coach OR :coach IS NULL)
            AND (l.name = :level OR :level IS NULL)
            AND (loc.name = :location OR :location IS NULL')->fetchALL();

            $sql->execute([
                ':coach' => $coach,
                ':level' => $level,
                ':location' => $location
            ]
            );

            echo json_encode(['success' => true, 'message' => 'Activité mis à jour avec succès']);
            

}
}
?>