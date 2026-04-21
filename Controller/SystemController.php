<?php
    require_once ROOT_DIR . "Model/System.php"; //autoload
    class SystemController{

        /*
            Zu adden: 
                -validation:
                    -id validation
                    -name && surname validation

        */

        public function getAll($tbl){
            $items = System::getAllItems($tbl);
            echo json_encode($items);
        }
        public function get($tbl,$id){
            $item = System::getItem($tbl, $id);
            echo json_encode($item);
        }

        public function create($tbl){
            $data=json_decode(file_get_contents("php://input"),true);

            if (!isset($data["name"]) || !isset($data["surname"])) {
                http_response_code(400);
                echo json_encode(["error" => "Missing data"]);
                return;
            }

            $item = System::createItem($tbl, $data["name"], $data["surname"]);

            http_response_code(201);

            echo json_encode($item);
        }

        public function modify($tbl, $id){
            $item=System::getItem($tbl,$id);
            $data=json_decode(file_get_contents("php://input"), true);
            if(!isset($data["name"]) || !isset($data["surname"])){
                http_response_code(204);
                echo json_encode(["error" => "No content to modify"]);
                return;
            }
            System::modifyItem($tbl,$id,$data["name"],$data["surname"]);
            http_response_code(200);
            echo json_encode($item);
        }

        public function delete($tbl,$id){
            System::deleteItem($tbl, $id);
            http_response_code(200);
            return json_encode(["message" => "Item deleted!"]);
        }
    }

?>