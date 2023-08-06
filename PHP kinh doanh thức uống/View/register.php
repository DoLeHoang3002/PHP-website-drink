<div class="list-thuc-uong">
    <div class="container">
        <div class="d-flex justify-content-center align-item-center">
            <div class="card border-4 border-success mb-5" style="width: 500px;">
                <div class="card-header bg-success text-center text-white m-0 rounded-0">
                    <h2>Đăng ký</h2>
                </div>
            <form action="" method="post">
                <div class="card-body">
                    <span class="fst-italic fw-lighter text-danger">(*): Không được để trống</span><br>
                    <label for="" class="form-label">Tên khách hàng(*):</label>
                    <input type="text" class="form-control" name="Name_kh" value="<?php if (isset($_POST["Name_kh"])) {echo $_POST["Name_kh"];}?>" required>

                    <label for="" class="form-label">Tên tài khoản(*):</label>
                    <input type="text" class="form-control" name="Username" value="<?php if (isset($_POST["Username"])) {echo $_POST["Username"];}?>" required>
                    
                    <label for="" class="form-label">Mật khẩu(*):</label>
                    <input type="password" class="form-control" name="Password" value="<?php if (isset($_POST["Password"])) {echo $_POST["Password"];}?>" required>

                    <label for="" class="form-label">Nhập lại mật khẩu(*):</label>
                    <input type="password" class="form-control" name="Re_Password" required>

                    <label for="" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="Email" value="<?php if (isset($_POST["Email"])) {echo $_POST["Email"];}?>">

                    <label for="" class="form-label">Địa chỉ(*):</label>
                    <input type="text" class="form-control" name="Address" value="<?php if (isset($_POST["Address"])) {echo $_POST["Address"];}?>" required>

                    <label for="" class="form-label">Số điện thoại(*):</label>
                    <input type="text" class="form-control" name="Phonenumber" value="<?php if (isset($_POST["Phonenumber"])) {echo $_POST["Phonenumber"];}?>" required>
                    <br>
                    <div class="text-center">
                        <button class="btn btn-success text-center">Đăng ký</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>