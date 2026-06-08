<?php

class Database {
    private $host = "localhost";
    private $db_name = "si_gudang";
    private $username = "root";
    private $password = "";

    public $conn;

    public function connect(){
        $this->conn = mysqli_connect(
            $this->host,
            $this->username,
            $this->password,
            $this->db_name
        );
        if (!$this->conn) {
            die("koneksi gagal " . mysqli_connect_error());
        }
        
        return $this->conn;
    }
}