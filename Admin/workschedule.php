<?php
// Kết nối cơ sở dữ liệu
include('../php/connect.php');
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail($to, $subject, $body)
{
    $mail = new PHPMailer(true);
    try {
        // Cấu hình máy chủ SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Thay bằng SMTP server của bạn
        $mail->SMTPAuth = true;
        $mail->Username = 'trantrongmanhvpbq@gmail.com'; // Thay bằng email của bạn
        $mail->Password = 'jrsw pafk fimn drrs'; // Thay bằng password của bạn
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587; // Cổng SMTP

        // Người gửi và người nhận
        $mail->setFrom('trantrongmanhvpbq@gmail.com', 'Trần Trọng Mạnh'); // Thay bằng email và tên của bạn
        $mail->addAddress($to); // Email người nhận

        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        echo 'Email đã được gửi thành công';
    } catch (Exception $e) {
        echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
    }
}

// Sửa lịch làm việc và gửi email sau khi cập nhật
if (isset($_POST['update'])) {
    $scheduleID = $_POST['ScheduleID'];
    $employeeID = $_POST['EmployeeID'];
    $workDate = $_POST['WorkDate'];
    $startTime = $_POST['StartTime'];
    $endTime = $_POST['EndTime'];

    // Cập nhật lịch làm việc
    $sql = "UPDATE workschedule SET EmployeeID='$employeeID', WorkDate='$workDate', StartTime='$startTime', EndTime='$endTime' WHERE ScheduleID='$scheduleID'";

    if ($conn->query($sql) === TRUE) {
        // Lấy email của nhân viên từ cơ sở dữ liệu
        $emailQuery = "SELECT Email FROM employees WHERE EmployeeID = '$employeeID'";
        $result = $conn->query($emailQuery);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $employeeEmail = $row['Email']; // Lấy địa chỉ email

            // Nội dung email kèm theo thông tin lịch làm việc đã sửa
            $subject = 'Thông báo lịch làm việc đã được cập nhật';
            $body = "Chào bạn, lịch làm việc của bạn đã được cập nhật với các chi tiết sau:<br>
                     - Ngày làm việc: $workDate<br>
                     - Giờ bắt đầu: $startTime<br>
                     - Giờ kết thúc: $endTime<br>";

            // Gửi email
            sendEmail($employeeEmail, $subject, $body);

            // Chuyển hướng sau khi cập nhật thành công và gửi email
            header('Location: workschedule.php?message=updated');
            exit;
        } else {
            echo "Không tìm thấy email cho nhân viên với ID: $employeeID";
        }
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Xóa lịch làm việc
if (isset($_GET['delete'])) {
    $scheduleID = $_GET['delete'];
    $sql = "DELETE FROM workschedule WHERE ScheduleID='$scheduleID'";
    if ($conn->query($sql) === TRUE) {
        header('Location: workschedule.php?message=deleted');
        exit;
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Lấy dữ liệu để sửa
$editRow = null;
if (isset($_GET['edit'])) {
    $scheduleID = $_GET['edit'];
    $sql = "SELECT * FROM workschedule WHERE ScheduleID='$scheduleID'";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $editRow = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy lịch làm việc với ID: $scheduleID";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch làm việc của nhân viên</title>
    <link rel="stylesheet" href="../css/workschedule.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <style>
        /* Nút Trở về Trang Chủ */
        #backToHomeBtn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        #backToHomeBtn:hover {
            background-color: #45a049;
        }

        /* Thông báo ở góc trên bên phải */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            display: none;
        }

        .notification.error {
            background-color: #f44336;
            /* Màu đỏ cho thông báo lỗi */
        }
    </style>
</head>

<body>

    <!-- Nút trở về trang chủ -->
    <a href="../Admin/admin.php" class="btn" id="backToHomeBtn">Trở về Trang Chủ</a>

    <!-- Thông báo -->
    <div id="notification" class="notification"></div>

    <!-- Nút để thêm lịch làm việc -->
    <button class="btn" id="addScheduleBtn">Thêm Lịch Làm Việc Mới</button>
    <div class="form-container" id="scheduleForm" style="display: <?php echo isset($editRow) ? 'block' : 'none'; ?>;">
        <h2><?php echo isset($editRow) ? "Sửa Lịch Làm Việc" : "Thêm Lịch Làm Việc Mới"; ?></h2>
        <form action="workschedule.php" method="POST">
            <?php if (isset($editRow)) { ?>
                <input type="hidden" name="ScheduleID" value="<?php echo $editRow['ScheduleID']; ?>">
            <?php } ?>

            <label for="EmployeeID">Mã nhân viên:</label>
            <input type="text" id="EmployeeID" name="EmployeeID" class="form-control" value="<?php echo isset($editRow) ? $editRow['EmployeeID'] : ''; ?>" required>

            <label for="WorkDate">Ngày làm việc:</label>
            <input type="text" id="WorkDate" name="WorkDate" class="form-control datepicker" value="<?php echo isset($editRow) ? $editRow['WorkDate'] : ''; ?>" required>

            <label for="StartTime">Giờ bắt đầu:</label>
            <input type="time" id="StartTime" name="StartTime" class="form-control" value="<?php echo isset($editRow) ? $editRow['StartTime'] : ''; ?>" required>

            <label for="EndTime">Giờ kết thúc:</label>
            <input type="time" id="EndTime" name="EndTime" class="form-control" value="<?php echo isset($editRow) ? $editRow['EndTime'] : ''; ?>" required>

            <input type="submit" name="<?php echo isset($editRow) ? 'update' : 'add'; ?>" class="btn" value="<?php echo isset($editRow) ? 'Cập Nhật Lịch Làm Việc' : 'Thêm Lịch Làm Việc'; ?>">

            <!-- Nút hủy -->
            <button type="button" class="cancel-btn" id="cancelEditBtn">Hủy</button>
        </form>
    </div>

    <h2>Lịch Làm Việc Hiện Tại</h2>

    <?php
    // Lấy và hiển thị lịch làm việc
    $sql = "SELECT ScheduleID, EmployeeID, WorkDate, StartTime, EndTime FROM workschedule";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<table>
            <tr>
                <th>Mã Lịch</th>
                <th>Mã Nhân Viên</th>
                <th>Ngày Làm Việc</th>
                <th>Giờ Bắt Đầu</th>
                <th>Giờ Kết Thúc</th>
                <th>Thao Tác</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row["ScheduleID"] . "</td>
                <td>" . $row["EmployeeID"] . "</td>
                <td>" . $row["WorkDate"] . "</td>
                <td>" . $row["StartTime"] . "</td>
                <td>" . $row["EndTime"] . "</td>
                <td>
                    <a href='?edit=" . $row["ScheduleID"] . "'>Sửa</a> | 
                    <a href='?delete=" . $row["ScheduleID"] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa lịch làm việc này không?\")'>Xóa</a>
                </td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "Chưa có lịch làm việc nào.";
    }

    // Thông báo cho người dùng
    if (isset($_GET['message'])) {
        echo "<script>
            document.getElementById('notification').innerText = 'Lịch làm việc đã được cập nhật thành công!';
            document.getElementById('notification').style.display = 'block';
        </script>";
    }
    ?>

    <script src="../Js/workshedule.js"></script>

</body>

</html>
