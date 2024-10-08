<?php
session_start();
include '../php/connect.php';

// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
//     header("Location: ../Auth/login_register.php");
//     exit;
// }

$conn = new mysqli('localhost', 'root', '', 'da');
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý tìm kiếm
$search = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $search = $conn->real_escape_string($search);
}

// Lấy danh sách nhân viên
$sql = "SELECT * FROM nhanvien WHERE ten LIKE '%$search%'";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'xoa_nhanvien') {
        $id = intval($_POST['id']);
        $stmt = $conn->prepare("DELETE FROM nhanvien WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "Xóa nhân viên thành công!";
        } else {
            echo "Lỗi khi xóa nhân viên!";
        }
        $stmt->close();
    } elseif (isset($_POST['ten'])) { // Thêm nhân viên
        $ten = $conn->real_escape_string($_POST['ten']);
        $chucvu = $conn->real_escape_string($_POST['chucvu']);
        $email = $conn->real_escape_string($_POST['email']);
        $luong = intval($_POST['luong']);
        $ngayvaolam = $conn->real_escape_string($_POST['ngayvaolam']);

        $stmt = $conn->prepare("INSERT INTO nhanvien (ten, chucvu, email, luong, ngayvaolam) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $ten, $chucvu, $email, $luong, $ngayvaolam);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "Thêm nhân viên thành công!";
        } else {
            echo "Lỗi khi thêm nhân viên!";
        }
        $stmt->close();
    } elseif (isset($_POST['id'])) { // Sửa nhân viên
        $id = intval($_POST['id']);
        $ten = $conn->real_escape_string($_POST['ten']);
        $chucvu = $conn->real_escape_string($_POST['chucvu']);
        $email = $conn->real_escape_string($_POST['email']);
        $luong = intval($_POST['luong']);
        $ngayvaolam = $conn->real_escape_string($_POST['ngayvaolam']);

        $stmt = $conn->prepare("UPDATE nhanvien SET ten=?, chucvu=?, email=?, luong=?, ngayvaolam=? WHERE id=?");
        $stmt->bind_param("sssisi", $ten, $chucvu, $email, $luong, $ngayvaolam, $id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "Sửa nhân viên thành công!";
        } else {
            echo "Lỗi khi sửa nhân viên!";
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Nhân viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-btn {
            cursor: pointer;
        }
    </style>
</head>
<body>

<h1>Quản lý Nhân viên</h1>

<form method="post">
    <input type="text" name="search" placeholder="Tìm kiếm nhân viên..." value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit">Tìm kiếm</button>
</form>

<button onclick="showAddEmployeeModal()">Thêm Nhân viên</button>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Chức vụ</th>
            <th>Email</th>
            <th>Lương</th>
            <th>Ngày vào làm</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['ten']; ?></td>
                <td><?php echo $row['chucvu']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['luong']; ?></td>
                <td><?php echo $row['ngayvaolam']; ?></td>
                <td>
                    <span class="action-btn" onclick="showEditEmployeeModal(<?php echo $row['id']; ?>)">Sửa</span>
                    <span class="action-btn" onclick="deleteEmployee(<?php echo $row['id']; ?>)">Xóa</span>
                    <span class="action-btn" onclick="viewEmployeeDetails(<?php echo $row['id']; ?>)">Chi tiết</span>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Modal Thêm Nhân viên -->
<div id="addEmployeeModal" style="display:none;">
    <h2>Thêm Nhân viên</h2>
    <form id="addEmployeeForm">
        <input type="text" name="ten" placeholder="Tên" required>
        <input type="text" name="chucvu" placeholder="Chức vụ" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="number" name="luong" placeholder="Lương" required>
        <input type="date" name="ngayvaolam" required>
        <button type="button" onclick="addEmployee()">Thêm</button>
        <button type="button" onclick="closeModal('addEmployeeModal')">Đóng</button>
    </form>
</div>

<!-- Modal Sửa Nhân viên -->
<div id="editEmployeeModal" style="display:none;">
    <h2>Sửa Nhân viên</h2>
    <form id="editEmployeeForm">
        <input type="hidden" name="id" id="editId">
        <input type="text" name="ten" id="editTen" placeholder="Tên" required>
        <input type="text" name="chucvu" id="editChucVu" placeholder="Chức vụ" required>
        <input type="email" name="email" id="editEmail" placeholder="Email" required>
        <input type="number" name="luong" id="editLuong" placeholder="Lương" required>
        <input type="date" name="ngayvaolam" id="editNgayVaoLam" required>
        <button type="button" onclick="editEmployee()">Sửa</button>
        <button type="button" onclick="closeModal('editEmployeeModal')">Đóng</button>
    </form>
</div>

<script>
    function showAddEmployeeModal() {
        document.getElementById('addEmployeeModal').style.display = 'block';
    }

    function showEditEmployeeModal(id) {
        // Fetch employee details using AJAX
        fetch(`get_employee.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('editId').value = data.id;
                document.getElementById('editTen').value = data.ten;
                document.getElementById('editChucVu').value = data.chucvu;
                document.getElementById('editEmail').value = data.email;
                document.getElementById('editLuong').value = data.luong;
                document.getElementById('editNgayVaoLam').value = data.ngayvaolam;
                document.getElementById('editEmployeeModal').style.display = 'block';
            });
    }

    function deleteEmployee(id) {
        if (confirm("Bạn có chắc chắn muốn xóa nhân viên này?")) {
            fetch('admin_employee.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=xoa_nhanvien&id=${id}`
            }).then(response => response.text())
              .then(result => {
                  alert(result);
                  location.reload();
              });
        }
    }

    function viewEmployeeDetails(id) {
        // Fetch employee details and display in alert or modal
        fetch(`get_employee.php?id=${id}`)
            .then(response => response.json())
            .then(data => {
                alert(`ID: ${data.id}\nTên: ${data.ten}\nChức vụ: ${data.chucvu}\nEmail: ${data.email}\nLương: ${data.luong}\nNgày vào làm: ${data.ngayvaolam}`);
            });
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    function addEmployee() {
        const form = document.getElementById('addEmployeeForm');
        const formData = new FormData(form);

        fetch('admin_employee.php', {
            method: 'POST',
            body: new URLSearchParams(formData),
        }).then(response => response.text())
          .then(result => {
              alert(result);
              location.reload();
          });
    }

    function editEmployee() {
        const form = document.getElementById('editEmployeeForm');
        const formData = new FormData(form);

        fetch('admin_employee.php', {
            method: 'POST',
            body: new URLSearchParams(formData),
        }).then(response => response.text())
          .then(result => {
              alert(result);
              location.reload();
          });
    }
</script>
</body>
</html>
