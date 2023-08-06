<div class="list-thuc-uong">
    <div class="container">
        <div class="d-flex justify-content-center align-item-center">
            <div class="card border-4 border-success mb-5" style="width: 500px;">
                <div class="card-header bg-success text-center text-white m-0 rounded-0">
                    <h2>Nhập mật khẩu mới</h2>
                </div>
            <form action="index.php?menu=forgetps&action=resetps" method="post">
                <div class="card-body">
                    <label for="" class="form-label">mã xác nhận:</label>
                    <input type="password" class="form-control" name="code" required>
                    <label for="" class="form-label">Mật khẩu mới:</label>
                    <input type="password" class="form-control" name="password" required>
                    <br>
                    <div class="text-center">
                        <button class="btn btn-success text-center">Gửi mật khẩu</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>