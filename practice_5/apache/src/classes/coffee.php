<?php

class Coffee {
    private ?mysqli $conn;

    public int $id;
    public ?string $title;
    public float $volume;
    public int $price;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "
        SELECT p.ID, p.title, p.volume, p.price FROM products AS p
        ORDER BY p.ID; 
        ";

        return $this->conn->query($query);
    }

    function create() {
        $this->title = htmlspecialchars(strip_tags($this->title));

        $query = "INSERT INTO products(title, volume, price) VALUE ('".$this->title."', '".$this->volume."', '".$this->price."');";

        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function readOne() {
        $query = "SELECT p.ID, p.title, p.volume, p.price FROM products AS p WHERE p.ID = ".$this->id.";";
        return $this->conn->query($query)->fetch_row();
    }

    function update() {
        $query = "
            UPDATE products 
            SET title = '".$this->title."', volume = '".$this->volume."', price = '".$this->price."' 
            WHERE ID = ".$this->id.";
            ";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }

    function delete() {
        $query = "DELETE FROM products WHERE ID = ".$this->id.";";
        $stmt = $this->conn->query($query);
        $this->conn->commit();
        return $stmt;
    }
}