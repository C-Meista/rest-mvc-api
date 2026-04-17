
<?php
class User {
    public static function getAllUsers() {
        $pdo = DB::$connection;
        $stmt = $pdo->query("SELECT * FROM tbl_users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUser($id){
        $pdo = DB::$connection;
        $stmt = $pdo->prepare("SELECT * FROM tbl_users where u_id = :id");
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($name,$surname){
        $pdo = DB::$connection;
        $stmt = $pdo->prepare("INSERT INTO tbl_users (u_name, u_surname)VALUES (:name, :surname)");
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':surname',$surname,PDO::PARAM_STR);
        $stmt->execute();
        return self::getUser($pdo->lastInsertId());
    }

    public static function modify($id,$name,$surname){
        $pdo = DB::$connection;
        $stmt = $pdo->prepare("UPDATE tbl_users set u_name=':name', u_surname=':surname' where u_id=':id'");
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->bindParam(':surname',$surname,PDO::PARAM_STR);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        return self::getUser($pdo->lastInsertId());
    }

    public static function delete($id){
        $pdo = DB::$connection;
        $stmt = $pdo->prepare("DELETE from tbl_users where u_id=':id'");
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        return self::getUser($pdo->lastInsertId());
    }

    
}
?>