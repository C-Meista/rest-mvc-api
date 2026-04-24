<?php
    require_once ROOT_DIR . "Models/ProductModel.php";

    class ProductController extends Controller{
        
        public static function createProduct($tbl,$payload){
            if (PayloadValidator::validateProduct($payload)) { //auslagerbar (validation klasse)
                //response class handler maybe
                http_response_code(400);
                echo json_encode(["error" => "Missing data"]);
                return;
            }

            return ProductModel::createItemProduct($tbl,$payload);
        }

        public static function modifyProduct($tbl,$id,$payload){
            if (PayloadValidator::validateProduct($payload)) {
                    http_response_code(400);
                    echo json_encode(["error" => "No content to modify"]);
                    return;
            }

            return ProductModel::modifyItemProduct($tbl,$id,$payload);

        }
    }

?>