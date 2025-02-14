<?php 

class ControllerFormPage {

    
    public static function getSpecificActivity($id){
        global $pdo;

        header('Access-Control-Allow-Origin: *');  
        header('Content-Type: application/json; charset=utf-8');  

        if(isset($id)){
            try {
                echo json_encode($pdo->query("SELECT * FROM activities WHERE id = $id ")->fetchALL());
            }
            catch(PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }
        }
        else {
            echo json_encode(['error' => "There is no ID set for this activity"]);
        }
    }
                                                                                                                                                                                                                                                                                                                                                                                                                    
    public static function updateActivity($id) {
        global $pdo;
       
        header('Access-Control-Allow-Origin: *');  
        header('Content-Type: application/json; charset=utf-8');  

        $data = json_decode(file_get_contents('php://input'), true);

        if($data['name'] == null || $data['description'] == null || $data['image'] == null || $data['level_id'] == null 
        || $data['coach_id'] == null || $data['schedule_day'] == null || $data['schedule_time'] == null || $data['location_id'] == null || !isset($id))
        {
            echo json_encode(['error' => 'Data not complete', 'message' => 'Please make sure that every field is filled']);
            return json_encode(['error' => 'Data not complete', 'message' => 'Please make sure that every field is filled']);

        }

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

        echo json_encode(['success' => true, 'message' => 'Activité mis à jour avec succès']);
    }

    public static function addActivity() {
        global $pdo;
       
        header('Access-Control-Allow-Origin: *');  
        header('Content-Type: application/json; charset=utf-8');  

        $data = json_decode(file_get_contents('php://input'), true);

        if($data['name'] == null || $data['description'] == null || $data['image'] == null || $data['level_id'] == null 
        || $data['coach_id'] == null || $data['schedule_day'] == null || $data['schedule_time'] == null || $data['location_id'] == null)
        {
            echo json_encode(['error' => 'Data not complete', 'message' => 'Please make sure that every field is filled']);
            return json_encode(['error' => 'Data not complete', 'message' => 'Please make sure that every field is filled']);

        }
        $id = $pdo->query('SELECT id FROM activities ORDER BY id DESC LIMIT 1')->fetch(PDO::FETCH_ASSOC);
        $stmt = $pdo->prepare('INSERT INTO activities (name, description, image, level_id, coach_id, schedule_day, schedule_time, location_id, id) VALUE 
        (:name, :description, :image, :level_id, :coach_id, :schedule_day, :schedule_time, :location_id, :id)');
        $stmt->execute([
            ':name' => $data['name'],
            ':description' => $data['description'],
            ':image' => $data['image'],
            ':level_id' => $data['level_id'],
            ':coach_id' => $data['coach_id'],
            ':schedule_day' => $data['schedule_day'],
            ':schedule_time' => $data['schedule_time'],
            ':location_id' => $data['location_id'],
            ':id' => $id['id'] + 1
        ]);

        try {
            echo json_encode($pdo->query('SELECT * from activities ORDER BY id')->fetchALL());
        }
        catch(PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}


?>