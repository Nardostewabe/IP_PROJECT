<?php
require_once "Database_connection.php";

class AccountModel extends Database_connection {
    public function deleteRecords($table, $column, $id) {
        $conn = $this->connect();
        $query = "DELETE FROM $table WHERE $column = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) return false;

        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
?>
