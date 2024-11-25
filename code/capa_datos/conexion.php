<?php 
class Database {
    private $host = 'localhost';
    private $db_name = 'bd_tareasapp_arquitecturaencapas';
    private $username = 'root';
    private $password = '';
    
    public $conn;

    public function getConnection(){
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexión exitosa";
        } catch (PDOException $exception) {
            echo "Error en la conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}



?>