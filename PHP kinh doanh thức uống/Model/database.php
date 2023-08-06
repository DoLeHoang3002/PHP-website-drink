<?php
    $db = null;
    class database{
        function __construct(){
            $dsn = 'mysql:host=localhost;dbname=php2';
            $user = 'root';
            $pass = '';
            try {
                $this->db = new PDO($dsn, $user, $pass,
            array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
            } catch (\Throwable $th) {
                echo "Error: " . $th;
            }
        }
        public function getList($select){
            $result=$this->db->query($select);
            return $result->fetchAll();
        }
        public function insertData($insert){
            return $this->db->exec($insert);
        }
        public function deleteData($delete){
            $this->db->exec($delete);
        }
        public function LastInsertId($Name_Column) {
            return $this->db->lastInsertId($Name_Column);
        }
    }
?>