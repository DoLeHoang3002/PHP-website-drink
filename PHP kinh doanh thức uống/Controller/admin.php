<?php
    if (isset($_SESSION["Customer"]) && $_SESSION["Customer"]["ID_Rank"]===4) {
        switch ($_GET['action']) {
            case 'list':
                include_once './View/admin.listproduct.php'; break;
            case 'add':
                if (isset($_POST['add_edit'])) {
                    $add = true;
                    $alert = "";
                    if (empty($_POST['Name_hh'])) {
                        $add = false;
                        $alert .= nl2br ("Tên không được để trống.\\n");
                    }
                    if (!isset($_POST['Sub_Name_hh'])) {
                        $add = false;
                        $alert .= nl2br ("Mô tả không tồn tại hoặc đã bị xoá khỏi giao diện.\\n");
                    }
                    if (empty($_POST['ID_Type'])) {
                        $add = false;
                        $alert .= nl2br ("Loại không xác định.\\n");
                    }
                    if (!isset($_POST['ID_Group'])) {
                        $add = false;
                        $alert .= nl2br ("Nhóm sản phẩm không tồn tại.\\n");
                    }
                    if (empty($_POST['price_size'])) {
                        $add = false;
                        $alert .= nl2br ("Giá không tồn tại.\\n");
                    } else {
                        $isset_price = false;
                        foreach ($_POST['price_size'] as $key=>$price) {
                            if (!empty($price)&&$price>0&&is_numeric($price)) {
                                $isset_price = true;
                                break;
                            }
                        }
                        if (!$isset_price) {
                            $add = false;
                            $alert .= nl2br ("Giá không tồn tại.\\n");
                        }
                    }
                    if (!isset($_POST['ID_Topping_List'])) {
                        $_POST['ID_Topping_List'] = [];
                    }
                    if (empty($_FILES['Image']['size'])) {
                        $add = false;
                        $alert .= nl2br ("Hình không được để trống.\\n");
                    }
                    if (!uploadimage()) {
                        $add = false;
                        $alert .= nl2br ("Upload hình không thành công.\\n");
                    }
                    if ($add) {
                        $product=new thucuong();
                        $success = $product->addProduct($_POST["Name_hh"],$_POST['Sub_Name_hh'],$_FILES['Image']['name'],$_POST['ID_Group'],$_POST['ID_Type'],$_POST['price_size'],$_POST['ID_Topping_List']);
                        if($success!==false)
                        {
                            echo '<script> alert("Insert thành công")</script>';
                            echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=admin&action=list'/>";
                        }
                        else
                        {
                            echo '<script> alert("Insert ko thành công")</script>';
                            echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=admin&action=add'/>";
    
                        }
                    } else {
                        echo "<script>alert('".$alert."');</script>";
                        include_once './View/admin.add_edit.php';
                    }
                    break;
                } else {
                    include_once './View/admin.add_edit.php'; break;
                }
            case 'edit':
                if (isset($_POST['edit'])) {
                    include_once './View/admin.add_edit.php'; break;
                } elseif (isset($_POST['delete'])) {
                    $product=new thucuong();
                    $product->deleteProduct($_POST['delete']);
                    echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=admin&action=list'/>";
                } elseif (isset($_POST['add_edit'])) {
                    $edit = true;
                    $alert = "";
                    if (empty($_POST['ID_hh'])) {
                        $edit = false;
                        $alert .= nl2br ("Mã sản phẩm không tồn tại.\\n");
                    }
                    if (empty($_POST['Name_hh'])) {
                        $edit = false;
                        $alert .= nl2br ("Tên không được để trống.\\n");
                    }
                    if (!isset($_POST['Sub_Name_hh'])) {
                        $edit = false;
                        $alert .= nl2br ("Mô tả không tồn tại.\\n");
                    }
                    if (empty($_POST['ID_Type'])) {
                        $edit = false;
                        $alert .= nl2br ("Loại không xác định.\\n");
                    }
                    if (!isset($_POST['ID_Group'])) {
                        $edit = false;
                        $alert .= nl2br ("Nhóm sản phẩm không tồn tại.\\n");
                    }
                    if (empty($_POST['price_size'])) {
                        $edit = false;
                        $alert .= nl2br ("Giá không tồn tại.\\n");
                    } else {
                        $isset_price = false;
                        foreach ($_POST['price_size'] as $key=>$price) {
                            if (!empty($price)&&$price>0&&is_numeric($price)) {
                                $isset_price = true;
                                break;
                            }
                        }
                        if (!$isset_price) {
                            $edit = false;
                            $alert .= nl2br ("Giá không tồn tại.\\n");
                        }
                    }
                    if (!isset($_POST['ID_Topping_List'])) {
                        $ID_Topping_List = [];
                    } else {
                        $ID_Topping_List = $_POST['ID_Topping_List'];
                    }
                    if ($edit) {
                        $product=new thucuong();
                        $success = $product->editProduct($_POST["ID_hh"],$_POST["Name_hh"],$_POST['Sub_Name_hh'],$_POST['ID_Group'],$_POST['ID_Type'],$_POST['price_size'],$ID_Topping_List);
                        if($success!==false)
                        {
                            echo '<script> alert("Chỉnh sửa thành công")</script>';
                            echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=admin&action=list'/>";
                        }
                        else
                        {
                            echo '<script> alert("Chỉnh sửa không thành công")</script>';
                            echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=admin&action=list'/>";
    
                        }
                    } else {
                        echo "<script>alert('".$alert."');</script>";
                        echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=admin&action=list'/>";
                    }
                    break;
                } else {
                    echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=admin&action=add'/>";
                    break;
                }
            case 'type':
                include_once './View/admin.listtype.php'; break;
            case 'add_type':
                if(isset($_POST['submit_file']))
                {
                    // b1: lấy file từ server về
                    $file=$_FILES['file']['tmp_name'];
                    // b2: \xEF\xBB\xBF, thay thế nó
                    file_put_contents($file,str_replace("\xEF\xBB\xBF","",file_get_contents($file)));
                    // b3: mở file ra
                    $file_open=fopen($file,'r');
                    // b4: đọc nd của file
                    $type = new type();
                    while(($csv=fgetcsv($file_open,1000,";"))!==false)
                    {
                        $tenloai=$csv[0];
                        $id_menu=$csv[1];
                        // thêm vào database
                        $type->addType($tenloai,$id_menu);
                    }
                    echo '<script>alert("Import thành công") </script>';
                    echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=admin&action=type'/>";
                    break;
                }
                if (isset($_POST['add_edit'])) {
                    $type = new type();
                    $type->addType($_POST['Name_Type'],$_POST['ID_Menu']);
                    echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=admin&action=type'/>";
                    break;
                } else {
                    include_once './View/admin.add_edit_type.php'; break;
                }
            case 'edit_type':
                if (isset($_POST['delete'])) {
                    $type = new type();
                    $type->delType($_POST['delete']);
                    echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=admin&action=type'/>";
                    break;
                } else if (isset($_POST['edit'])) {
                    include_once './View/admin.add_edit_type.php'; break;
                } else if (isset($_POST['add_edit'])) {
                    $type = new type();
                    $type->editType($_POST["ID_Type"], $_POST['Name_Type'], $_POST['ID_Menu']);
                    echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=admin&action=type'/>";
                    break;
                }
            case 'bill':
                include_once './View/admin.bill.php'; break;
            case 'edit_bill':
                if (isset($_POST['delete'])) {
                    $bills = new bill();
                    $bills->delBill($_POST['delete']);
                    echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=admin&action=bill'/>";
                    break;
                } else if (isset($_POST['edit'])) {
                    include_once './View/admin.edit_bill.php'; break;
                } else if (isset($_POST['add_edit'])) {
                    $bills = new bill();
                    $bills->editBill($_POST['ID_Bill'], $_POST['ID_kh']);
                    echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=admin&action=bill'/>";
                    break;
                }
            case 'detail_bill':
                include_once './View/admin.detail_bill.php'; break;
            case 'edit_detail_bill':
                if (isset($_POST['delete'])) {
                    $bills = new bill();
                    $bills->delDetailBill($_POST['delete']);
                    echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=admin&action=detail_bill&id=".$_POST['ID_Bill']."'/>";
                    break;
                } else if (isset($_POST['edit'])) {
                    include_once './View/admin.edit_detail_bill.php'; break;
                } else if (isset($_POST['add_edit'])) {
                    $bills = new bill();
                    $bills->editDetailBill($_POST['ID_detail_hoadon'], $_POST['ID_Size'], $_POST['Amount'], $_POST['Note']);
                    echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=admin&action=detail_bill&id=".$_POST['ID_Bill']."'/>";
                    break;
                }
            case 'statistics':
                include_once './View/admin.statistics.php'; break;
            
        }
    } else {
        echo "<meta http-equiv='refresh' content='0; url=./index.php?menu=thucuong&action=1'/>";
    }
?>