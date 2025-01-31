<?php
class ContactFormRepository {
    private $connection;

    public function __construct() {
        $this->connection = DatabaseConnection::getInstance();
    }

    public function getAllEntries() {
        $sql = "SELECT * FROM contact_form ORDER BY created_at DESC";
        $stmt = $this->connection->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
