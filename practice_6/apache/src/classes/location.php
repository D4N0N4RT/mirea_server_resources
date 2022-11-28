<?php

class Location {
    private ?mysqli $conn;

    public int $id;
    public ?string $address;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "
        SELECT l.ID, l.address FROM locations AS l
        ORDER BY l.ID; 
        ";

        return $this->conn->query($query);
    }

    function readOne() {
        $query = "SELECT l.ID, l.address FROM locations AS l WHERE l.ID = " . $this->id . ";";
        return $this->conn->query($query)->fetch_row();
    }

    function create() {
        $this->address = htmlspecialchars(strip_tags($this->address));

        $query = "INSERT INTO locations(address) VALUE ('".$this->address."');";

        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function update() {
        $query = "
            UPDATE locations 
            SET address = '".$this->address."' 
            WHERE ID = ".$this->id.";
            ";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function delete() {
        $query = "DELETE FROM locations WHERE ID = ".$this->id.";";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }
}