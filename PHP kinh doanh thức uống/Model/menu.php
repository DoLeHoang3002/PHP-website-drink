<?php
    class menu{
        function __construct(){}

        function getMenu(){
            $db = new database();
            $select = "select * from menu where ID_Menu_Parent IS NULL and Available = 1";
            $result = $db->getList($select);
            return $result;
        }
        function getMenuChild($ID_Parent){
            $db = new database();
            $select = "select * from menu where ID_Menu_Parent = $ID_Parent and Available = 1";
            $result = $db->getList($select);
            return $result;
        }
    }
?>
