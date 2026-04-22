<?php
    require_once ROOT_DIR . "Models/Model.php"; //autoload
    class Controller{

        /*
            Zu adden: 
                -validation:
                    -id validation
                    -name && surname validation

        */

        public function getAll($tbl){
            $items = Model::getAllItems($tbl);
            echo json_encode($items);
        }

        public function get($tbl,$id){
            $item = Model::getItem($tbl, $id);
            echo json_encode($item);
        }

        public function create($tbl){
            $data=json_decode(file_get_contents("php://input"),true);

            if(count($data)>2 && (str_contains($data,"name") && str_contains($data,"usage")&&str_contains($data,"price"))){//auslagerbar (validation klasse)
                if (!isset($data["name"]) || !isset($data["usage"]) || !isset($data["price"])) { //auslagerbar (validation klasse)
                    http_response_code(400);
                    echo json_encode(["error" => "Missing data"]);
                    return;
                }

                $item = Model::createItem($tbl, $data["name"], $data["usage"], $data["price"]);

                
            }else if(count($data)<=2 &&(str_contains($data,"name") && str_contains($data,"surname"))){
                if (!isset($data["name"]) || !isset($data["surname"])) {
                    http_response_code(400);
                    echo json_encode(["error" => "Missing data"]);
                    return;
                }
                $item = Model::createItem($tbl, $data["name"], $data["surname"], null);
            }

            http_response_code(201);

            echo json_encode($item);
        }

        public function modify($tbl, $id){
            $item=Model::getItem($tbl,$id);
            $data=json_decode(file_get_contents("php://input"), true);
            if(count($data)>2 && (str_contains($data,"name") && str_contains($data,"usage")&&str_contains($data,"price"))){
                if (!isset($data["name"]) || !isset($data["usage"]) || !isset($data["price"])) {
                    http_response_code(400);
                    echo json_encode(["error" => "No content to modify"]);
                    return;
                }
                Model::modifyItem($tbl,$id,$data["name"],$data["usage"],$data["price"]);
            }else if(count($data)<=2 &&(str_contains($data,"name") && str_contains($data,"surname"))){

                if(!isset($data["name"]) || !isset($data["surname"])){
                    http_response_code(204);
                    echo json_encode(["error" => "No content to modify"]);
                    return;
                }
                Model::modifyItem($tbl,$id,$data["name"],$data["surname"],null);
            }
            http_response_code(200);
            echo json_encode($item);
        }

        public function delete($tbl,$id){
            Model::deleteItem($tbl, $id);
            http_response_code(200);
            return json_encode(["message" => "Item deleted!"]);
        }
    }

?>