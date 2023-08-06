# PHP-website-drink

*Lưu ý: khởi động XAMPP control panel bằng Run As Administrator

 Bước 1: Sử dụng XAMPP tạo localhost với port là 7000 và Start Apache và MySQL

(
    Trong giao diện XAMPP dòng Module Apache bấm Config chọn Apache (httpd.conf), sửa lại dòng 59 và 60 thành
	//#Listen 12.34.56.78:80
	//Listen 7000
)

 Bước 2: Mở Admin của MySQL trong giao diện XAMPP và import file php2_database.sql

 Bước 3: Thêm thư mục dự án và thư mục htdocs của XAMPP và chạy dự án trên trình duyệt
 thông qua đường dẫn: https://localhost:7000/[tên thư mục dự án]/index.php

Để thêm và chỉnh sửa sản phẩm, đăng nhập bằng:

- Tài khoản: 501210616

- Mật khẩu: 6543217