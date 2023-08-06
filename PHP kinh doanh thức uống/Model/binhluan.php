<?php
    class binhluan{
        function __construct(){}

        function insertComment($mahh, $makh, $noidung){
            $db = new database();
            $date = new DateTime("now");
            $datecreate=$date->format("Y-m-d");

            $query="insert into binhluan(ID_binhluan, ID_kh, ID_hh, ngaybl, noidung) 
            values(Null, $makh, $mahh, '$datecreate', '$noidung')";

            $db->insertData($query);
        }

        function getCountComment($mahh){
            $db = new database();
            $query="select count(ID_binhluan) from binhluan where ID_hh = $mahh";
            $result = $db->getList($query);
            return $result[0];
        }

        function getNoidungComment($mahh){
            $db = new database();
            $query="select a.noidung, a.ngaybl, b.Name_kh from binhluan a INNER JOIN khachhang b on a.ID_kh=b.ID_kh where a.ID_hh = $mahh";
            $result = $db->getList($query);
            return $result;
        }
    }
?>