<div class="list-thuc-uong">
    <div class="container">
        <div class="d-flex justify-content-center align-item-center">
            <div class="card border-4 border-success mb-5" style="width: 500px;">
                <div class="card-header bg-success text-center text-white m-0 rounded-0">
                    <h2>Quên mật khẩu</h2>
                </div>
            <form action="index.php?menu=forgetps&action=submit" method="post">
                <div class="card-body">
                    <label for="" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" required>

                    <br>
                    <div class="text-center">
                        <button class="btn btn-success text-center">Gửi mã</button>
                        <a href="index.php?menu=login" class="btn btn-success text-center">Đăng nhập</a>
                        <a href="index.php?menu=register" class="btn btn-success text-center">Đăng ký</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>