<?php

    class ProductModel extends Model{

        public static function createItemProduct($tbl,$payload){
            $pdo = DB::$connection;
            $sql = <<<SQL
                INSERT INTO tbl_$tbl (pro_name, pro_usage, pro_price)
                VALUES (:name,:usage,:price)
            SQL;
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name',$payload['name'],PDO::PARAM_STR);
            $stmt->bindParam(':usage',$payload['usage'],PDO::PARAM_STR);
            $stmt->bindParam(':price',$payload['price'],PDO::PARAM_INT);
            $stmt->execute();
            return self::getItem($tbl, $pdo->lastInsertId());
        }

        public static function modifyItemProduct($tbl,$id,$payload){
            $pdo = DB::$connection;
            $sql = <<<SQL
                UPDATE tbl_$tbl 
                SET pro_name=:name, pro_usage=:usage, pro_price=:price
                WHERE pro_id=:id
            SQL;
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name',$payload['name'],PDO::PARAM_STR);
            $stmt->bindParam(':usage',$payload['usage'],PDO::PARAM_STR);
            $stmt->bindParam(':price',$payload['price'],PDO::PARAM_INT);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->execute();
            return self::getItem($tbl, $pdo->lastInsertId());
        }
  

    }


?>