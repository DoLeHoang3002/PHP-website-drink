<div class="list-thuc-uong">
    <div class="container">
        <div class="d-flex justify-content-center align-item-center">
            <div class="card border-4 border-success mb-5" style="width: 500px;">
                <div class="card-header bg-success text-center text-white m-0 rounded-0">
                    <h2>Đăng nhập</h2>
                </div>
            <form action="" method="post">
                <div class="card-body">
                    <label for="" class="form-label">Tên tài khoản:</label>
                    <input type="text" class="form-control" name="Username" value="<?php if (isset($_POST["Username"])) {echo $_POST["Username"];}?>" required>
                    
                    <label for="" class="form-label">Mật khẩu:</label>
                    <input type="password" class="form-control" name="Password" required>

                    <br>
                    <div class="text-center">
                        <button class="btn btn-success text-center">Đăng nhập</button>
                        <a href="index.php?menu=register" class="btn btn-success text-center">Đăng ký</a><br>
                        <a href="index.php?menu=forgetps&action=forget" class="float-start">Quên mật khẩu?</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>