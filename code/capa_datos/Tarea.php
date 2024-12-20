<?php 

require_once 'conexion.php';

class Tarea {
    private $conn;
    private $table_tareas = "tareas";
    private $table_usuarios = "usuarios";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function show() {
        $query = "SELECT id_Tarea, titulo, descripcion, date_asig, estado, 
                        " . $this->table_usuarios . ".username, date_create, update_at FROM"
                         . $this->table_tareas . "INNER JOIN " . $this->table_usuarios . " 
                         ON " . $this->table_tareas . ".user_id = " . $this->table_usuarios . ".id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function create($titulo, $descripcion, $date_asig, $estado, $user_id) {
        $query = "INSERT INTO " . $this->table_tareas . " (titulo, descripcion, date_asig, estado, user_id) 
                    VALUES (:titulo, :descripcion, :date_asig, :estado, :user_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':date_asig', $date_asig);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':user_id', $user_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editById($id_Tarea, $titulo, $descripcion, $estado) {
        $query = "UPDATE " . $this->table_tareas . " 
                  SET titulo = :titulo, descripcion = :descripcion, estado = :estado, update_at = CURRENT_TIMESTAMP
                  WHERE id_Tarea = :id_Tarea";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id_Tarea', $id_Tarea);
    
        return $stmt->execute();
    }

    public function deleteById($id_Tarea) {
        $query = "DELETE FROM " . $this->table_tareas . " WHERE id_Tarea = :id_Tarea";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_Tarea', $id_Tarea);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getTareasByUserId($user_id) {
        $query = "SELECT id_Tarea, titulo, descripcion, date_asig, estado, date_create, update_at 
                  FROM " . $this->table_tareas . " 
                  WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }
    public function getById($id_Tarea) {
        $query = "SELECT * FROM " . $this->table_tareas . " WHERE id_Tarea = :id_Tarea";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_Tarea', $id_Tarea);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>