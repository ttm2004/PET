<?php
include('../php/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $order_id = $_POST['order_id'] ?? '';
    $maKH = $_POST['MaKH'] ?? '';
    $customer_name = $_POST['customer_name'] ?? '';
    $customer_phone = $_POST['customer_phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $customer_address = $_POST['customer_address'] ?? '';
    $pet_name = $_POST['pet_name'] ?? '';
    $pet_type = $_POST['pet_type'] ?? '';
    $service_selected = $_POST['service_selected'] ?? '';
    $trangThaiChuaBenh = $_POST['ttchuabenh'] ?? '';
    $received_time = $_POST['received_time'] ?? '';
    $returned_time = $_POST['returned_time'] ?? '';
    $ghiChu = $_POST['notes'] ?? '';

    // Xử lý file hình ảnh
    if (isset($_FILES['Hinhanh']) && $_FILES['Hinhanh']['error'] == 0) {
        $hinhAnh = file_get_contents($_FILES['Hinhanh']['tmp_name']);
    } else {
        $hinhAnh = null;
    }

    // Kiểm tra xem khách hàng đã tồn tại trong bảng khachhang chưa
    $stmt = $conn->prepare("SELECT MaKH FROM khachhang WHERE MaKH = ?");
    $stmt->bind_param("s", $maKH);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Khách hàng chưa tồn tại, chèn vào bảng khachhang
        $stmt = $conn->prepare("INSERT INTO khachhang (MaKH, HoTen, SoDienThoai, Email, DiaChi) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $maKH, $customer_name, $customer_phone, $email, $customer_address);

        if (!$stmt->execute()) {
            echo "Lỗi khi thêm khách hàng: " . $stmt->error;
            exit();
        }
    }

    // Chèn thông tin vào bảng thucung
    $stmt = $conn->prepare("INSERT INTO thucung (MaThuCung, TenThuCung, LoaiThuCung, MaKH, DichVuChon, TrangThaiChuaBenh, ThoiGianNhan, ThoiGianTra, HinhAnh, GhiChu) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Kiểm tra câu lệnh đã chuẩn bị thành công
    if ($stmt === false) {
        echo "Lỗi khi chuẩn bị câu lệnh: " . $conn->error;
        exit();
    }

    $stmt->bind_param("isssssssss", $order_id, $pet_name, $pet_type, $maKH, $service_selected, $trangThaiChuaBenh, $received_time, $returned_time, $hinhAnh, $ghiChu);

    if ($stmt->execute()) {
        // Thêm thành công, trả về thông báo và thực hiện chuyển hướng
        echo "<script>
                alert('Đã thêm đơn hàng thành công.');
                setTimeout(function() {
                    window.location.href = 'table-data-oder.php'; 
                }, 5000);
              </script>";
    } else {
        echo "Lỗi khi thêm thú cưng: " . $stmt->error;
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh sách đơn chăm sóc</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <!-- or -->
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

</head>

<body onload="time()" class="app sidebar-mini rtl">
  <!-- Navbar-->
  <header class="app-header">
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
      aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">


      <!-- User Menu-->
      <li><a class="app-nav__item" href="/Employee.php"><i class='bx bx-log-out bx-rotate-180'></i> </a>

      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="../Image/employee1.jpeg" width="50px"
        alt="User Image">
      <div>
        <p class="app-sidebar__user-name"><b>Trần Trọng Mạnh</b></p>
        <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
      </div>
    </div>
    <hr>
    <ul class="app-menu">
      <li><a class="app-menu__item haha" href="phan-mem-ban-hang.php"><i class='app-menu__icon bx bx-cart-alt'></i>
          <span class="app-menu__label">POS Bán Hàng</span></a></li>
      <li><a class="app-menu__item " href="Employee.php"><i class='app-menu__icon bx bx-tachometer'></i><span
            class="app-menu__label">Bảng điều khiển</span></a></li>
      <li><a class="app-menu__item " href="table-data-table.php"><i class='app-menu__icon bx bx-id-card'></i>
          <span class="app-menu__label">Quản lý nhân viên</span></a></li>
      <li><a class="app-menu__item" href="#"><i class='app-menu__icon bx bx-user-voice'></i><span
            class="app-menu__label">Quản lý khách hàng</span></a></li>
      <li><a class="app-menu__item" href="table-data-product.php"><i
            class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Quản lý sản phẩm</span></a>
      </li>
      <li><a class="app-menu__item active" href="table-data-oder.php"><i class='app-menu__icon bx bx-task'></i><span
            class="app-menu__label">Quản lý đơn chăm sóc</span></a></li>
      <li><a class="app-menu__item" href="table-data-banned.php"><i class='app-menu__icon bx bx-run'></i><span
            class="app-menu__label">Quản lý nội bộ
          </span></a></li>
      <li><a class="app-menu__item" href="table-data-money.php"><i class='app-menu__icon bx bx-dollar'></i><span
            class="app-menu__label">Bảng kê lương</span></a></li>
      <li><a class="app-menu__item" href="quan-ly-bao-cao.php"><i
            class='app-menu__icon bx bx-pie-chart-alt-2'></i><span class="app-menu__label">Báo cáo doanh thu</span></a>
      </li>
      <li><a class="app-menu__item" href="page-calendar.php"><i class='app-menu__icon bx bx-calendar-check'></i><span
            class="app-menu__label">Lịch công tác </span></a></li>
      <li><a class="app-menu__item" href="#"><i class='app-menu__icon bx bx-cog'></i><span class="app-menu__label">Cài
            đặt hệ thống</span></a></li>
    </ul>
  </aside>
  <main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh sách đơn chăm sóc</li>
        <li class="breadcrumb-item"><a href="#">Thêm đơn chăm sóc</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Tạo mới đơn chăm sóc</h3>
          <div class="tile-body">
            <form class="row" action="" method="POST">
              <div class="form-group col-md-4">
                <label class="control-label">ID đơn chăm sóc ( Nếu không nhập sẽ tự động phát sinh )</label>
                <input class="form-control" type="text" name="order_id">
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Mã Khách hàng</label>
                <input class="form-control" type="text" name="MaKH" required>
              </div>

              <div class="form-group col-md-4">
                <label class="control-label">Tên khách hàng</label>
                <input class="form-control" type="text" name="customer_name" required>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Số điện thoại khách hàng</label>
                <input class="form-control" type="number" name="customer_phone" required>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Số điện thoại khách hàng</label>
                <input class="form-control" type="email" name="email" required>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Địa chỉ khách hàng</label>
                <input class="form-control" type="text" name="customer_address" required>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Tên thú cưng</label>
                <input class="form-control" type="text" name="pet_name" required>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label" required>Loại thú cưng</label>
                <select class="form-control" name="pet_type">
                  <option value="">-- Chọn loại thú cưng --</option>
                  <option value="Chó">Chó</option>
                  <option value="Mèo">Mèo</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label" required>Dịch vụ chọn</label>
                <select class="form-control" name="service_selected">
                  <option value="">-- Chọn dịch vụ --</option>
                  <option value="Khám sức khỏe tổng quát định kỳ">Khám sức khỏe tổng quát định kỳ</option>
                  <option value="Xét nghiệm thú cưng">Xét nghiệm thú cưng</option>
                  <option value="Chăm sóc thú cưng">Chăm sóc thú cưng</option>
                  <option value="Tiêm ngừa vắc xin">Tiêm ngừa vắc xin</option>
                  <option value="Phẫu thuật (thai sản, triệt sản, mắt, tai,...)">Phẫu thuật (thai sản, triệt sản, mắt, tai,...)</option>
                  <option value="Xuất cảnh">Xuất cảnh</option>
                  <option value="Khám bệnh &amp; điều trị">Khám bệnh &amp; điều trị</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label" required>Trạng thái chữa bệnh</label>
                <select class="form-control" name="ttchuabenh">
                  <option value="">Trạng thái chữa bệnh</option>
                  <option value="Khám sức khỏe tổng quát định kỳ">Đang chăm sóc</option>
                  <option value="Xét nghiệm thú cưng">Đã chăm sóc</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Thời gian nhận</label>
                <input class="form-control" type="datetime-local" name="received_time" required>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Thời gian trả</label>
                <input class="form-control" type="datetime-local" name="returned_time" required>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">HÌnh ảnh</label>
                <input class="form-control" type="file" name="Hinhanh" required>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Ghi chú</label>
                <textarea class="form-control" rows="4" name="notes"></textarea>
              </div>
              <div class="col-md-12">
                <button class="btn btn-save">Lưu lại</button>
                <a class="btn btn-cancel" href="../Employee/table-data-oder.php">Hủy bỏ</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
</body>

</html>