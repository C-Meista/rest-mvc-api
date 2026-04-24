<?php
    require_once ROOT_DIR . "Models/UserModel.php";

    class UserController extends Controller{
        
        public static function createUser($tbl,$payload){
            if (PayloadValidator::validateUser($payload)) {
                http_response_code(400);
                echo json_encode(["error" => "Missing data"]);
                return;
            }

            return UserModel::createItemUser($tbl,$payload);
        }

        public static function modifyUser($tbl,$id,$payload) {
            if(PayloadValidator::validateUser($payload)){
                http_response_code(204);
                echo json_encode(["error" => "No content to modify"]);
                return;
            }

            return UserModel::modifyItemUser($tbl,$id,$payload);
        }


    }


?>