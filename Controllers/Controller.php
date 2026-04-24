<?php
    require_once ROOT_DIR . "Models/Model.php"; //autoload
    class Controller{

        /*
            Zu adden: 
                -validation:
                    -id validation (queryValidation.php in models)
                    -name && surname validation (payloadValidation.php in controllers)

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

            //get data array
            $payload=json_decode(file_get_contents("php://input"),true);
            //ifs(validations -> später auslagern)
            if(PayloadValidator::isProduct($payload)){//auslagerbar (validation klasse)  
                //item needs json response from method.
                $item = ProductController::createProduct($tbl, $payload);

            }else if(PayloadValidator::isProduct($payload)){
               
                $item = UserController::createUser($tbl, $payload);
           
            }
    
            //checkItem -> in responsehandler.php 

            http_response_code(201);

            echo json_encode($item);
        }

        public function modify($tbl, $id){
            $item=Model::getItem($tbl,$id);
            $payload=json_decode(file_get_contents("php://input"), true);

            if(PayloadValidator::isProduct($payload)){
                
                ProductController::modifyProduct($tbl,$id,$payload);
            
            }else if(PayloadValidator::isUser($payload)){

                UserController::modifyUser($tbl,$id,$payload);
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