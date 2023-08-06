<?php
    function uploadimage()
    {
        // B1: tạo đường dẫn chứa hình
        $target_dir="E:\CMS\htdocs\PHP2\lab1\Content\Image\\";
        // b2: lấy tên hình về để vào đường dẫn
        $target_file=$target_dir.basename($_FILES['Image']['name']);
        // b3: lấy phần mở rộng để kiểm tra xem có phải là hình hay không
        $targetFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // b4: kiểm tra file đó có thật sự tồn tại trên server hay không
        $uploadhinh=1;
        // kiểm tra hình có tồn tại hay chưa
        if(file_exists( $target_file))
        {
            $uploadhinh=0;
            echo '<script> alert("Hình đã tồn tại");</script>';
        }
        // kiểm tra kích thước hình, 500kb
        if($_FILES['Image']['size']>1000000000)
        {
            $uploadhinh=0;
            echo '<script> alert("Hình vượt kích thước");</script>';
        }
        // kiểm tra có phải là hình hay ko
        if($targetFileType!='jpg' && $targetFileType!='jpeg' && $targetFileType!='png' 
        && $targetFileType!='gif')
        {
            $uploadhinh=0;
            echo '<script> alert("ko là hình");</script>';
        }
        if($uploadhinh==1)
        {
            if(move_uploaded_file($_FILES['Image']['tmp_name'],$target_file))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
?>