<?php

$servername = "localhost"; // Tên máy chủ MySQL (thường là localhost)
$username = "root"; // Tên tài khoản MySQL
$password = ""; // Mật khẩu (thường để trống nếu là localhost)
$dbname = "da"; // Tên database mà bạn muốn kết nối

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);


// Kiểm tra kêt nối 
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

session_start();

$message = ''; // Khởi tạo biến để chứa thông báo

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Câu truy vấn để kiểm tra đăng nhập
    $sql = 'SELECT * FROM userlogin WHERE username = ?';
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Lỗi: " . $conn->error); // Kiểm tra lỗi câu lệnh SQL
    }

    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      // Lấy dữ liệu từ kết quả truy vấn
      $user = $result->fetch_assoc();

      // So sánh mật khẩu (không mã hóa)
      if ($password === $user['password']) { // So sánh trực tiếp
        // Đăng nhập thành công, lưu trữ thông tin trong session
        $_SESSION['user'] = $username;
        $_SESSION['role'] = $user['role'];
        $message = 'Đăng nhập thành công';
        // Chuyển hướng người dùng dựa trên quyền
        if ($user['role'] == 'Admin') {
          header("Location: ../Admin/admin.php");
        } elseif ($user['role'] == 'employee') {
          header("Location: ../Employee/employee.php");
        } else {
          echo "Không xác định quyền của người dùng!";
        }
        exit; // Dừng thực thi sau khi chuyển hướng
      } else {
        $message = 'Sai mật khẩu!';
      }
    } else {
      $message = 'Sai tên đăng nhập hoặc mật khẩu';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Đăng nhập quản trị | Website quản trị v2.0</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="../Image/team.jpg" alt="IMG">
                </div>
                <!--=====TIÊU ĐỀ======-->
                <form class="login100-form validate-form" action="" method="POST">
                    <span class="login100-form-title">
                        <b>ĐĂNG NHẬP HỆ THỐNG POS</b>
                    </span>
                    <!--=====FORM INPUT TÀI KHOẢN VÀ PASSWORD======-->
                    <div class="wrap-input100 validate-input" data-validate="Tài khoản không được để trống">
                        <input class="input100" type="text" placeholder="Tài khoản quản trị" name="username" id="username" required>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class='bx bx-user'></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Mật khẩu không được để trống">
                        <input autocomplete="off" class="input100" type="password" placeholder="Mật khẩu" name="password" id="password-field" required>
                        <span toggle="#password-field" class="bx fa-fw bx-hide field-icon click-eye"></span>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class='bx bx-key'></i>
                        </span>
                    </div>

                    <!--=====THÔNG BÁO LỖI======-->
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-danger text-center">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>

                    <!--=====ĐĂNG NHẬP======-->
                    <div class="container-login100-form-btn">
                        <input type="submit" value="Đăng nhập" class="btn btn-primary" name="login" />
                    </div>
                    <!--=====LINK TÌM MẬT KHẨU======-->
                    <div class="text-right p-t-12">
                        <a class="txt2" href="../Auth/forgot.php">
                            Bạn quên mật khẩu?
                        </a>
                    </div>
                    <!--=====FOOTER======-->
                    <div class="text-center p-t-70 txt2">
                        Copyright <i class="far fa-copyright" aria-hidden="true"></i>
                        <script type="text/javascript">document.write(new Date().getFullYear());</script> <a
                            class="txt2" href="https://www.facebook.com/trm.204">Trần Trọng Mạnh</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Javascript-->
    <script src="./Js/main.js"></script>
    <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
    <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="../vendor/bootstrap/js/popper.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/select2/select2.min.js"></script>
    <script type="text/javascript">
        //show - hide mật khẩu
        $(".click-eye").click(function () {
            $(this).toggleClass("bx-show bx-hide");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
</body>

</html>
