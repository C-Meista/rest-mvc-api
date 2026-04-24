
<?php
class Model {
   
    public static function getAllItems($tbl) {
        $pdo = DB::$connection;
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