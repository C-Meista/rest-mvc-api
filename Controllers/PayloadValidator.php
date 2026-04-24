<?php

    class PayloadValidator{

        public static function isProduct($payload){
            return (count($payload)>2 && (str_contains($payload,"name") && str_contains($payload,"usage")&&str_contains($payload,"price"))) ? true:false ;
        }

        public static function isUser($payload){
            return (count($payload)<=2 &&(str_contains($payload,"name") && str_contains($payload,"surname"))) ? true:false;  
        }

        public static function validateProduct($payload){ //verbesserbar (siehe regex)
            return (!isset($payload["name"]) || !isset($payload["usage"]) || !isset($payload["price"])) ? true:false;
        }

        public static function validateUser($payload){ //verbesserbar (siehe regex)
            return (!isset($payload["name"]) || !isset($payload["surname"])) ? true:false;
        }
            
    }

?>