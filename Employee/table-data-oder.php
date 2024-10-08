<?php
include('../php/connect.php');


$sql = "SELECT * FROM thucung"; // Thay đổi 'pet_table' thành tên bảng của bạn
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh sách đơn hàng | Quản trị Admin</title>
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
            class="app-menu__label">Quản lý đơn hàng</span></a></li>
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
      <ul class="app-breadcrumb breadcrumb side">
        <li class="breadcrumb-item active"><a href="#"><b>Danh sách đơn chăm sóc</b></a></li>
      </ul>
      <div id="clock"></div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <div class="row element-button">
              <div class="col-sm-2">

                <a class="btn btn-add btn-sm" href="form-add-don-hang.php" title="Thêm"><i class="fas fa-plus"></i>
                  Tạo mới đơn hàng</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm nhap-tu-file" type="button" title="Nhập" onclick="myFunction(this)"><i
                    class="fas fa-file-upload"></i> Tải từ file</a>
              </div>

              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i
                    class="fas fa-print"></i> In dữ liệu</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm print-file js-textareacopybtn" type="button" title="Sao chép"><i
                    class="fas fa-copy"></i> Sao chép</a>
              </div>

              <div class="col-sm-2">
                <a class="btn btn-excel btn-sm" href="" title="In"><i class="fas fa-file-excel"></i> Xuất Excel</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm pdf-file" type="button" title="In" onclick="myFunction(this)"><i
                    class="fas fa-file-pdf"></i> Xuất PDF</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm" type="button" title="Xóa" onclick="myFunction(this)"><i
                    class="fas fa-trash-alt"></i> Xóa tất cả </a>
              </div>
            </div>
            <!-- Bảng Sửa Thú Cưng -->
            <div id="editPetTable" style="display: none;">
              <h5>Sửa Thông Tin Thú Cưng</h5>
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td><strong>Mã Thú Cưng:</strong></td>
                    <td><input type="text" id="editMaThuCung" readonly></td>
                  </tr>
                  <tr>
                    <td><strong>Tên Thú Cưng:</strong></td>
                    <td><input type="text" id="editTenThuCung" required></td>
                  </tr>
                  <tr>
                    <td><strong>Loại Thú Cưng:</strong></td>
                    <td><input type="text" id="editLoaiThuCung" required></td>
                  </tr>
                  <tr>
                    <td><strong>Dịch Vụ Chọn:</strong></td>
                    <td><input type="text" id="editDichVuChon" required></td>
                  </tr>
                  <tr>
                    <td><strong>Trạng Thái Chưa Bệnh:</strong></td>
                    <td>
                      <select id="editTrangThaiChuaBenh">
                        <option value="1">Có</option>
                        <option value="0">Không</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>Ghi Chú:</strong></td>
                    <td><textarea id="editGhiChu"></textarea></td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <button id="saveEditPet" class="btn btn-primary">Lưu Thay Đổi</button>
                      <button id="cancelEditPet" class="btn btn-secondary">Hủy</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th width="10"><input type="checkbox" id="all"></th>
                  <th>Mã thú cưng</th>
                  <th>Tên thú cưng</th>
                  <th>Loại thú cưng</th>
                  <th>Mã khách hàng</th>
                  <th>Dịch vụ chọn</th>
                  <th>Trạng thái chưa bệnh</th>
                  <th>Thời gian nhận</th>
                  <th>Thời gian trả</th>
                  <th>Trạng thái trả</th>
                  <th>Hình ảnh</th>
                  <th>Ghi chú</th>
                  <th>Tính năng</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($result->num_rows > 0) {
                  // Xuất dữ liệu của mỗi hàng
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td width='10'><input type='checkbox' name='check1' value='" . $row['MaThuCung'] . "'></td>";
                    echo "<td>" . $row['MaThuCung'] . "</td>";
                    echo "<td>" . $row['TenThuCung'] . "</td>";
                    echo "<td>" . $row['LoaiThuCung'] . "</td>";
                    echo "<td>" . $row['MaKH'] . "</td>";
                    echo "<td>" . $row['DichVuChon'] . "</td>";
                    echo "<td>" . ($row['TrangThaiChuaBenh'] ? 'Có' : 'Không') . "</td>";
                    echo "<td>" . $row['ThoiGianNhan'] . "</td>";
                    echo "<td>" . ($row['ThoiGianTra'] ? $row['ThoiGianTra'] : 'Chưa trả') . "</td>";
                    echo "<td>" . ($row['TrangThaiTra'] ? 'Đã trả' : 'Chưa trả') . "</td>";
                    echo '<td><img class="img-card-person" src="data:image/jpeg;base64,' . base64_encode($row['HinhAnh']) . '" alt=""></td>';
                    echo "<td>" . $row['GhiChu'] . "</td>";
                    echo "<td>
                    <button class='btn btn-primary btn-sm edit' type='button' id='editt' title='Sửa' data-id='" . $row['MaThuCung'] . "'><i class='fa fa-edit'></i></button>
                    <button class='btn btn-danger btn-sm trash' type='button' title='Xóa' data-id='" . $row['MaThuCung'] . "'><i class='fas fa-trash-alt'></i></button>
                  </td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='13'>Không có dữ liệu</td></tr>";
                }

                // Đóng kết nối
                // $conn->close();
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- Essential javascripts for application to work-->
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="src/jquery.table2excel.js"></script>
  <script src="js/main.js"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="js/plugins/pace.min.js"></script>
  <!-- Page specific javascripts-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <!-- Data table plugin-->
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
  <script src="js/module.js"></script>
  <script type="text/javascript">
    $('#sampleTable').DataTable();
  </script>
  <script>
    //EXCEL
    // $(document).ready(function () {
    //   $('#').DataTable({

    //     dom: 'Bfrtip',
    //     "buttons": [
    //       'excel'
    //     ]
    //   });
    // });


    //Thời Gian
    function time() {
      var today = new Date();
      var weekday = new Array(7);
      weekday[0] = "Chủ Nhật";
      weekday[1] = "Thứ Hai";
      weekday[2] = "Thứ Ba";
      weekday[3] = "Thứ Tư";
      weekday[4] = "Thứ Năm";
      weekday[5] = "Thứ Sáu";
      weekday[6] = "Thứ Bảy";
      var day = weekday[today.getDay()];
      var dd = today.getDate();
      var mm = today.getMonth() + 1;
      var yyyy = today.getFullYear();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      nowTime = h + " giờ " + m + " phút " + s + " giây";
      if (dd < 10) {
        dd = '0' + dd
      }
      if (mm < 10) {
        mm = '0' + mm
      }
      today = day + ', ' + dd + '/' + mm + '/' + yyyy;
      tmp = '<span class="date"> ' + today + ' - ' + nowTime +
        '</span>';
      document.getElementById("clock").innerHTML = tmp;
      clocktime = setTimeout("time()", "1000", "Javascript");

      function checkTime(i) {
        if (i < 10) {
          i = "0" + i;
        }
        return i;
      }
    }
    //In dữ liệu
    var myApp = new function() {
      this.printTable = function() {
        var tab = document.getElementById('sampleTable');
        var win = window.open('', '', 'height=700,width=700');
        win.document.write(tab.outerHTML);
        win.document.close();
        win.print();
      }
    }
    // function showAddEmployeeModal() {
    //     document.getElementById('addEmployeeModal').style.display = 'block';
    // }

    // function showEditEmployeeModal(id) {
    //   // Fetch employee details using AJAX
    //   fetch(`get_employee.php?id=${id}`)
    //     .then(response => response.json())
    //     .then(data => {
    //       document.getElementById('editId').value = data.id;
    //       document.getElementById('editTen').value = data.ten;
    //       document.getElementById('editChucVu').value = data.chucvu;
    //       document.getElementById('editEmail').value = data.email;
    //       document.getElementById('editLuong').value = data.luong;
    //       document.getElementById('editNgayVaoLam').value = data.ngayvaolam;
    //       document.getElementById('editEmployeeModal').style.display = 'block';
    //     });
    // }



    // function deletePetOrder(id) {
    //   if (confirm("Bạn có chắc chắn muốn xóa đơn chăm sóc này?")) {
    //     fetch('./php/module.php', {
    //         method: 'POST',
    //         headers: {
    //           'Content-Type': 'application/x-www-form-urlencoded',
    //         },
    //         body: `action=delete_pet_order&id=${id}`
    //       }).then(response => response.text())
    //       .then(result => {
    //         alert(result); // Hiển thị thông báo từ server
    //         location.reload(); // Tải lại trang để cập nhật danh sách
    //       }).catch(error => {
    //         console.error('Error:', error);
    //         alert("Đã xảy ra lỗi khi xóa đơn chăm sóc thú cưng.");
    //       });
    //   }
    // }

    //     //Sao chép dữ liệu
    //     var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

    // copyTextareaBtn.addEventListener('click', function(event) {
    //   var copyTextarea = document.querySelector('.js-copytextarea');
    //   copyTextarea.focus();
    //   copyTextarea.select();

    //   try {
    //     var successful = document.execCommand('copy');
    //     var msg = successful ? 'successful' : 'unsuccessful';
    //     console.log('Copying text command was ' + msg);
    //   } catch (err) {
    //     console.log('Oops, unable to copy');
    //   }
    // });


    Modal
    $("#show-emp").on("click", function() {
      $("#ModalUP").modal({
        backdrop: false,
        keyboard: false
      })
    });
  </script>
</body>

</html>