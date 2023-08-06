<?php
    class type {
        function __construct(){}
        public function getListType() 
        {
            $db=new database();
            $select="select * 
            from type";
            $result=$db->getList($select);
            return $result;
        }
        public function getType($ID_Type) 
        {
            $db=new database();
            $select="select * 
            from type
            where ID_Type = $ID_Type";
            $result=$db->getList($select);
            return $result;
        }
        public function addType($Name_Type,$ID_Menu)
        {
            $db=new database();
            $insert = "insert INTO `type` (`ID_Type`, `Name_Type`, `ID_Menu`) VALUES (NULL, '$Name_Type', $ID_Menu)";
            $db->insertData($insert);
        }
        public function editType($ID_Type,$Name_Type,$ID_Menu)
        {
            $db=new database();
            $edit = "update type SET Name_Type='$Name_Type', ID_Menu=$ID_Menu WHERE ID_Type = $ID_Type";
            $db->insertData($edit);
        }
        public function delType($ID_Type)
        {
            $db=new database();
            $delete = "delete from type where ID_Type = $ID_Type";
            $db->deleteData($delete);
        }
    }
?>
