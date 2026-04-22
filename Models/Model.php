
<?php
require_once ROOT_DIR . "Models/QueryBuilder.php";
class Model {
    public static function getAllItems($tbl) {
        $pdo = DB::$connection;
        //optional auslagern $sql
        $sql = <<<SQL
            SELECT *
            FROM tbl_$tbl;
        SQL;
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getItem($tbl,$id){
        $pdo = DB::$connection;
        if($tbl=="users"){
            $sql = <<<SQL
                SELECT *
                FROM tbl_$tbl
                WHERE u_id=:id
            SQL;
        }else if($tbl=="products"){
            $sql = <<<SQL
                SELECT *
                FROM tbl_$tbl
                WHERE pro_id=:id
            SQL;
        }
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function createItem($tbl,$v1,$v2,$v3){ //brauch 3 values
        $pdo = DB::$connection;
        $sql = <<<SQL
            INSERT INTO tbl_$tbl (u_name, u_surname)
            VALUES (:name,:surname)
        SQL;
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':surname',$surname,PDO::PARAM_STR);
        $stmt->execute();
        return self::getItem($tbl, $pdo->lastInsertId());
    }

    public static function modifyItem($tbl,$id,$v1,$v2,$v3){ //brauch 5 values
        $pdo = DB::$connection;
        $sql = <<<SQL
            UPDATE tbl_$tbl 
            SET u_name=:name, u_surname=:surname
            WHERE u_id=:id
        SQL;
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':surname',$surname,PDO::PARAM_STR);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        return self::getItem($tbl, $pdo->lastInsertId());
    }

    public static function deleteItem($tbl,$id){
        $pdo = DB::$connection;
        $sql = <<<SQL
            DELETE FROM tbl_$tbl 
            WHERE u_id=:id
        SQL;
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        return self::getItem($tbl, $pdo->lastInsertId());
    } 
}
?>