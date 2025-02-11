<?php 

class ControllerFormPage {

    
    public static function getSpecificActivity($id){
        global $pdo;

        header('Access-Control-Allow-Origin: *');  
        header('Content-Type: application/json; charset=utf-8');  

        try {
            echo json_encode($pdo->query("SELECT * FROM activities WHERE id = $id ")->fetchALL());
        }
        catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public static function updateActivity($id) {
        global $pdo;
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare('UPDATE activities SET name = :name, description = :description, image = :image, level_id = :level_id, coach_id = :coach_id , schedule_day = :schedule_day,
        schedule_time = :schedule_time, location_id = :location_id WHERE id = :id');
        $stmt->execute([
            ':name' => $data['name'],
            ':description' => $data['description'],
            ':image' => $data['image'],
            ':level_id' => $data['level_id'],
            ':coach_id' => $data['coach_id'],
            ':schedule_day' => $data['schedule_day'],
            ':schedule_time' => $data['schedule_time'],
            ':location_id' => $data['location_id'],
            ':id' => $id
        ]);

        echo json_encode(['success' => true, 'message' => 'Activité mise à jour avec succès']);
    }
}


?>