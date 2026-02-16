<?php
require_once __DIR__ . '/../config/database.php';

class Gallery {
    private $conn;
    private $table = 'gallery_images';

    public function __construct($db = null) {
        if ($db) $this->conn = $db; else { $database = new Database(); $this->conn = $database->getConnection(); }
    }

    public function all() {
        $sql = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    public function create($data) {
        $sql = "INSERT INTO " . $this->table . " (title, image) VALUES (:title, :image)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':title' => $data['title'] ?? null,
            ':image' => $data['image'] ?? null,
        ]);
    }

    public function find($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function delete($id) {
        $item = $this->find($id);
        if ($item && !empty($item['image'])) {
            @unlink(__DIR__ . '/../uploads/gallery/' . $item['image']);
            @unlink(__DIR__ . '/../uploads/gallery/thumbs/' . pathinfo($item['image'], PATHINFO_FILENAME) . '.webp');
        }
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}

?>