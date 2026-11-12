CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT PRIMARY KEY,username VARCHAR(80) UNIQUE NOT NULL,password_hash VARCHAR(255) NOT NULL) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS tintuc (id INT PRIMARY KEY,title VARCHAR(255) NOT NULL) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS products (id INT PRIMARY KEY,title VARCHAR(255) NOT NULL,img_url TEXT NOT NULL) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS rating_info (product_id INT PRIMARY KEY,rate_1 INT NOT NULL DEFAULT 0,rate_2 INT NOT NULL DEFAULT 0,rate_3 INT NOT NULL DEFAULT 0,rate_4 INT NOT NULL DEFAULT 0,rate_5 INT NOT NULL DEFAULT 0,FOREIGN KEY(product_id) REFERENCES products(id)) ENGINE=InnoDB;
INSERT IGNORE INTO products VALUES (1,'MB Gigabyte G1.Sniper B5','../assets/mainboard.svg'),(2,'Asus MeMo pad ME102A','../assets/tablet.svg'),(3,'LCD Philips 27 inch 273G3 DHSW','../assets/monitor.svg');
INSERT IGNORE INTO rating_info VALUES (1,2,4,5,1,2),(2,12,23,21,22,11),(3,2,2,1,1,2);
CREATE TABLE IF NOT EXISTS news (id INT PRIMARY KEY,title VARCHAR(255) NOT NULL,link VARCHAR(1000) NOT NULL,description VARCHAR(1000) NOT NULL) ENGINE=InnoDB;
INSERT IGNORE INTO news VALUES (1,'Làm quen với PHP','../bai8/index.php','Thực hành soạn thảo nội dung bằng CKEditor.'),(2,'Upload hình ảnh','../bai9/index.php','Kiểm tra và lưu ảnh được tải lên máy chủ.'),(3,'Session trong PHP','../bai10/index.php','Lưu thông tin phiên làm việc và bảo vệ trang quản trị.'),(4,'Phân trang dữ liệu','../bai11/index.php','Hiển thị dữ liệu MySQL theo từng trang.');
CREATE TABLE IF NOT EXISTS binhchon (idBC INT PRIMARY KEY,MoTa VARCHAR(255) NOT NULL,idLT INT NOT NULL,SoLanChon INT NOT NULL DEFAULT 0,AnHien TINYINT NOT NULL DEFAULT 1,ThuTu INT NOT NULL DEFAULT 0) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS phuongan (idPA INT PRIMARY KEY,MoTa VARCHAR(255) NOT NULL,SoLanChon INT NOT NULL DEFAULT 0,idBC INT NOT NULL,FOREIGN KEY(idBC) REFERENCES binhchon(idBC)) ENGINE=InnoDB;
INSERT IGNORE INTO `binhchon` (`idBC`, `MoTa`, `idLT`, `SoLanChon`, `AnHien`, `ThuTu`) VALUES
(1, 'Bạn nghĩ ute.com có giúp bạn học tập tốt hơn không ?', 1, 27, 1, 0),
(2, 'Bạn dự đoán Hoàng Long có trở thành chủ tịch nước năm nay không?', 1, 0, 1, 0),
(3, 'Bạn thích là developer hay coder ?', 1, 0, 1, 0),
(4, 'Bạn sẽ lấy vợ đẻ con khi nào ?', 9, 0, 1, 0);
INSERT IGNORE INTO `phuongan` (`idPA`, `MoTa`, `SoLanChon`, `idBC`) VALUES
(1, 'Là nơi để sinh viên tự học CNTT xịn nhất', 22, 1),
(2, 'Nội dung tẻ nhạt', 5, 1),
(3, 'Làm công chức nước nhà', 0, 3),
(4, 'Làm cho công ty tư nhân', 0, 3),
(5, 'Làm cho cơ quan nghiên cứu', 0, 3);
INSERT IGNORE INTO phuongan VALUES (6,'Có',0,2),(7,'Không',0,2),(8,'Chưa có kế hoạch',0,4),(9,'Khi phù hợp',0,4);
