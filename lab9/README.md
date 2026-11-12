# Lab 9 — Bài 8 đến bài 15

Yêu cầu: XAMPP với PHP 8 trở lên, MySQL/MariaDB, extension pdo_mysql, fileinfo, dom. Không cần Composer, Node.js hoặc Internet khi chạy.

## Chạy bài

1. Bật Apache và MySQL trong XAMPP.
2. Mở http://localhost/Lap-9/lab9/setup.php và bấm **Khởi tạo dữ liệu mẫu**.
3. Mở http://localhost/Lap-9/lab9/ để chọn bài.
4. Bài 10 đăng nhập bằng `admin` / `admin123`.

Cấu hình kết nối tại `config.php`, mặc định root, mật khẩu rỗng, cổng 3306. Cơ sở dữ liệu riêng `php_lab9`; không thay đổi các database/bài tập hiện có. Chạy lại setup không xóa hoặc ghi đè dữ liệu. Nếu PHP giới hạn upload dưới 5 MB, chỉnh `upload_max_filesize=5M`, `post_max_size=8M` trong php.ini rồi khởi động lại Apache.

## Nội dung

| Bài | Đường dẫn | Chức năng |
| --- | --- | --- |
| 8 | bai8/ | CKEditor: khởi tạo JavaScript và hàm PHP; gửi HTML, xem kết quả và mã nguồn |
| 9 | bai9/ | Upload JPG/GIF/PNG, kiểm tra MIME/nội dung ảnh, giới hạn 5.000.000 byte, tránh trùng tên |
| 10 | bai10/ | Lưu/đọc/xóa tên và tuổi, bộ đếm, đăng nhập, trang quản trị, đăng xuất |
| 11 | bai11/ | MySQL LIMIT/OFFSET, 10 tin/trang, 105 tin mẫu, đầu/trước/sau/cuối |
| 12 | bai12/ | Danh sách/chi tiết sản phẩm, đánh giá 1–5 sao, trung bình và số lượt từng mức |
| 13 | bai13/ | Danh sách tin và nguồn RSS 2.0 UTF-8 hợp lệ |
| 14 | bai14/ | CAPTCHA ảnh SVG, lưu session, phân biệt hoa/thường, đổi mã và thông báo đúng/sai |
| 15 | bai15/ | Chọn khảo sát/phương án, cập nhật giao dịch, phần trăm và tổng lượt |

Session tồn tại theo phiên trình duyệt/cookie và thời gian dọn session của PHP; không bảo đảm tồn tại sau khi đóng hoàn toàn trình duyệt. Ghi nhớ chỉ lưu tên đăng nhập, không lưu mật khẩu hoặc tự cấp quyền quản trị qua cookie.

## Dữ liệu và thư viện

- `database.sql` dùng cấu trúc theo đề; số liệu đánh giá lấy từ `rating.sql`, câu hỏi và phương án bình chọn lấy từ `review.sql`. Tổng lượt khởi tạo được điều chỉnh theo tổng phương án; thêm phương án cho câu hỏi 2 và 4 còn thiếu trong file gốc. Setup tạo thêm tài khoản băm mật khẩu và 105 tin để thử phân trang.
- Bài 12 là bài đánh giá đơn giản trong tài liệu; `star.rar` và `coderszine_demo.sql` là mã/dữ liệu tham khảo của một hệ thống đánh giá khác, không cần import vào bài này.
- Ảnh minh họa sản phẩm là SVG vẽ trong mã, không phải ảnh sản phẩm thực tế.
- CKEditor 5 49.1.0 được lưu tại `assets/ckeditor5`, khởi tạo bản tự host với `licenseKey: 'GPL'`. Giấy phép gốc kèm trong thư mục đó. Mã bài thực hành được cung cấp theo GPL-2.0-or-later để dùng cùng thư viện. Tài liệu: https://ckeditor.com/docs/ckeditor5/latest/getting-started/installation/self-hosted/quick-start.html
- Nội dung HTML bài 8 hiển thị trong iframe sandbox. Các biểu mẫu thay đổi dữ liệu dùng POST và CSRF. Bình chọn/đánh giá cho phép gửi nhiều lượt để phục vụ thực hành.

## Kiểm tra đã thực hiện

Toàn bộ PHP qua kiểm tra cú pháp trên PHP 8.0.30. Đã qua 46 kiểm tra HTTP/chức năng trên MySQL thử nghiệm riêng: khởi tạo lặp lại, session, đăng nhập/đăng xuất và chặn truy cập, biên phân trang, đánh giá hợp lệ/không hợp lệ, bình chọn và rollback, RSS XML, sinh CAPTCHA và nhập sai, CSRF, upload ảnh thật và từ chối ảnh giả, gửi nội dung soạn thảo. SQL cuối cùng được kiểm tra trên database mới, tổng lượt khớp các phương án. Chưa kiểm tra trực quan bằng trình duyệt hoặc thao tác toolbar CKEditor do không có trình duyệt kết nối trong môi trường làm việc.
