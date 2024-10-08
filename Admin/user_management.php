
<?php
session_start();
include '../php/connect.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Account</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

header {
    background-color: #333;
    color: white;
    padding: 10px 0;
    text-align: center;
}

header h1 {
    margin: 0;
}

nav ul {
    list-style: none;
    padding: 0;
}

nav ul li {
    display: inline;
    margin: 0 15px;
}

nav ul li a {
    color: white;
    text-decoration: none;
}

.container {
    display: flex;
}

.sidebar {
    background-color: #2c3e50;
    width: 250px;
    padding: 15px;
    min-height: 100vh;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin: 10px 0;
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
}

.main-content {
    flex-grow: 1;       
    padding: 20px;
    background-color: white;
}

.main-content h2 {
    margin-top: 0;
}

.account-info p {
    font-size: 18px;
    line-height: 1.6;
}

footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px 0;
    position: fixed;
    width: 100%;
    bottom: 0;
}

    </style>
    
    <table>
        <thead>
            <tr>
                <th>STT</th> <!-- Thêm cột số thứ tự -->
                <th>ID</th> <!-- Thêm cột ID -->
                <th>Họ</th>
                <th>Tên</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Email</th>
                <th>Điện thoại</th>
                <th>Địa chỉ</th>
                <th>Lương</th>
                <th>Ngày tuyển dụng</th>
                <th>Trạng thái</th>
                <th>Tên đăng nhập</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stt = ($page - 1) * $limit; // Tính số thứ tự bắt đầu từ 1
            while ($employee = $result->fetch_assoc()): ?>
                <tr id="row-<?php echo $employee['username']; ?>"
                    data-firstname="<?php echo $username['FirstName']; ?>"
                    data-lastname="<?php echo $username['LastName']; ?>"
                    data-dateofbirth="<?php echo $username['username']; ?>"
                    data-gender="<?php echo $username['password']; ?>"> 
                    <td><?php echo $stt; ?></td> <!-- Hiển thị số thứ tự -->
                    <td><?php echo $employee['EmployeeID']; ?></td>
                    <td><?php echo $employee['FirstName']; ?></td>
                    <td><?php echo $employee['FirstName']; ?></td>
                    <
                        <button onclick="showEditForm('<?php echo $employee['EmployeeID']; ?>')">Sửa</button>
                        <button onclick="delete_id(<?php echo $employee['EmployeeID']; ?>)">Xóa</button>
                    </td>
                </tr>
            <?php
                $stt++; // Tăng số thứ tự
            endwhile; ?>
        </tbody>
    </table>

    <!-- Phân trang -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
    <button onclick="window.location.href='../Admin/admin.php'">Về trang chủ</button>
</body>
</html>
