<?php
if(!defined('DB_SERVER')){
    require_once(__DIR__.'/../initialize.php');
}
class DBConnection{
    private $host = DB_SERVER;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $database = DB_NAME;
    private $port = DB_PORT;

    public $conn;

    public function __construct(){
        if(!isset($this->conn)){
            $this->conn = mysqli_init();
            $flags = 0;
            if(DB_SSL){
                // Most free cloud MySQL hosts require SSL
                $this->conn->ssl_set(NULL, NULL, NULL, NULL, NULL);
                $flags = MYSQLI_CLIENT_SSL | MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT;
            }
            $ok = @$this->conn->real_connect(
                $this->host, $this->username, $this->password,
                $this->database, $this->port, NULL, $flags
            );
            if(!$ok){
                echo 'Cannot connect to database server: '.mysqli_connect_error();
                exit;
            }
        }
    }
    public function __destruct(){
        if($this->conn instanceof mysqli){
            @$this->conn->close();
        }
    }
}
?>
