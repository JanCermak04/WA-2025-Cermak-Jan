<?php

 

class users {
    private $db;

 

    public function __construct($db) {
        $this->db = $db;
    }

 

    public function create($id, $username, $email, $password_hash, $role, $name, $surname, $created_at, $updated_at) {
       
        
        $sql = "INSERT INTO users (id, username, email, password_hash, role,  name, surname)
                VALUES (:id, :username, :email, :password_hash, role, name, :surname)";
       
        $stmt = $this->db->prepare($sql);
       
        return $stmt->execute([
            ':id' => $id,
            ':username' => $username,
            ':password_hash' => $password_hash,
            ':name' => $name,
            ':surname' => $surname,
            ':email' => $email,
            ':role' => $role,
            
        ]);
    }

 

    public function getAll() {
        $sql = "SELECT * FROM users ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

 

    public function getById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

 

    public function update($id, $username, $email, $password_hash, $role, $name, $surname, $created_at, $updated_at) {
        $sql = "UPDATE users
                SET username = :username,
                    password_hash = :password_hash,
                    name = :name,
                    surname = :surname,
                    email = :email,
                    role = :role,
                WHERE id = :id";
   
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':username' => $username,
            ':password_hash' => $password_hash,
            ':name' => $name,
            ':surname' => $surname,
            ':email' => $email,
        ]);
    }
}