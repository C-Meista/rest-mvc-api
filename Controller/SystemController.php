<?php
    require_once ROOT_DIR . "Model/System.php";
    class SystemController{

        /*
            Zu adden: 
                -validation:
                    -id validation
                    -name && surname validation

        */

        public function showAllUsers(){
            $users = User::getAllUsers();
            echo json_encode($users);
        }
        public function showUser($id){
            $user = User::getUser($id);
            echo json_encode($user);
        }

        public function createUser(){
            $data=json_decode(file_get_contents("php://input"),true);

            if (!isset($data["name"]) || !isset($data["surname"])) {
                http_response_code(400);
                echo json_encode(["error" => "Missing data"]);
                return;
            }

            $user = User::create($data["name"], $data["surname"]);

            http_response_code(201);

            echo json_encode($user);
        }

        public function modifyUser($id){
            $user=User::getUser($id);
            $data=json_decode(file_get_contents("php://input"), true);
            if(!isset($data["name"]) || !isset($data["surname"])){
                http_response_code(204);
                echo json_encode(["error" => "No content to modify"]);
                return;
            }
            User::modify($id,$data["name"],$data["surname"]);
            http_response_code(200);
            echo json_encode($user);
        }

        public function deleteUser($id){
            User::delete($id);
            http_response_code(200);
            return json_encode(["message" => "User deleted!"]);
        }
    }

?>