<?php

    class UserModel extends Model{

        public static function createItemUser($tbl,$payload){
            $pdo = DB::$connection;
            $sql = <<<SQL
                INSERT INTO tbl_$tbl (u_name, u_surname)
                VALUES (:name,:surname)
            SQL;
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name',$payload['name'],PDO::PARAM_STR);
            $stmt->bindParam(':surname',$payload['surname'],PDO::PARAM_STR);
            $stmt->execute();
            return self::getItem($tbl, $pdo->lastInsertId());
        }

        public static function modifyItemUser($tbl,$id,$payload){
            $pdo = DB::$connection;
            $sql = <<<SQL
                UPDATE tbl_$tbl 
                SET u_name=:name, u_surname=:surname
                WHERE u_id=:id
            SQL;
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name',$payload['name'],PDO::PARAM_STR);
            $stmt->bindParam(':surname',$payload['surname'],PDO::PARAM_STR);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->execute();
            return self::getItem($tbl, $pdo->lastInsertId());
        }


    }


?>