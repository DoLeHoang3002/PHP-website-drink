<?php
class Register {
    function __construct () {
        $this->alert = "";
    }
    public function alert_str($str)
    {
        echo "<script>console.log(`check1`)</script>";        
        if ($this->alert !== "") {
            $this->alert .= "\n";
        }
        $this->alert .= $str;
    }
    public function getUsername($Username)
    {
        $db=new database();
        $result = $db->getList("select * from khachhang where username like '".$_POST['Username']."%'");
        return $result;
    }
    public function addCustomer($Name_kh, $Username, $Password, $Email, $Address, $Phonenumber){
        $db = new database();
        $db->insertData("insert into khachhang (ID_kh ,Name_kh, username, password, email, address, phonenumber, point, ID_Rank) VALUES (NULL, '$Name_kh', '$Username', '$Password', '$Email', '$Address', '$Phonenumber', default, default)");
    }
    function getEmail($email)
    {
        $db=new database();
        $select="select * from khachhang where email='$email'";
        $result=$db->getList($select);
        return $result;
    }
    function updateCode($emailold,$codenew){
        $db=new database();
        $query="update khachhang set password='$codenew' where email='$emailold'";
        $db->insertData($query);
    }
    function getListUser() {
        $db = new database();
        $select = "select ID_kh, Name_kh from khachhang";
        $result = $db->getList($select);
        return $result;
    }
}
?>