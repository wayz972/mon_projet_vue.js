<?php
class Database
{
  private $host = 'localhost';
  private $data = 'website';
  private $username = 'root';
  private $password = "";


  public function connect()
  {
    $connection = null;
    try {

      $connection = new PDO(
        "mysql:host=" . $this->host . ";dbname=" . $this->data,
        $this->username,
        $this->password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
      );
    } catch (Exception $e) {
    }

    return $connection;
  }
}
