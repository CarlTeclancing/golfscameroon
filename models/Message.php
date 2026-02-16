<?php
require_once __DIR__ . '/../config/database.php';

class Message {
    private $conn;
    private $table = 'messages';

    public function __construct($db = null) {
        if ($db) $this->conn = $db; else { $database = new Database(); $this->conn = $database->getConnection(); }
    }

    public function create($data) {
        $sql = "INSERT INTO " . $this->table . " (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':message' => $data['message'],
        ]);
    }
}

?>