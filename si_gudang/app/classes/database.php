<?php

class Database {

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "si_gudang";

    public $conn;

    public function connect()
    {
        $this->conn = mysqli_connect(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        if (!$this->conn) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }

        return $this->conn;
    }
}