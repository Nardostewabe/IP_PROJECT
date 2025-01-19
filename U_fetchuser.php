<?php

// I named it U_fetchuser because you can use the same logic for deleting a user or data if needed
require_once "Database_connection.php"

    public function U_fetchuser($id){
        if($id > 0){

            $db = new Database_connection();
            $conn = $db -> connect();

            $holder = $this ->$conn -> prepare("SELECT * FROM users WHERE id = ?");
            $holder -> bind_param("i", $id);
            $holder -> execute();
            $result = $holder->get_result();
            $bundle = $result -> fetch_assoc();

            $holder -> close();
            $conn -> close();

            return $bundle;
        }
    
}



?>