<?php
// Truy vấn để lấy tất cả đơn chăm sóc
$sql = "SELECT COUNT(*) AS total_orders FROM thucung"; // Thay "don_cham_soc" bằng tên bảng của bạn
$sql2 = "SELECT COUNT(*) AS total_kh FROM khachhang";
$result = $conn->query($sql);
$result2 = $conn ->query($sql2);
$row2 = $result2->fetch_assoc();
$total_kh = $row2['total_kh'];
// Kiểm tra và lấy số tổng
if ($result) {
    $row = $result->fetch_assoc();
    $total_orders = $row['total_orders'];
} else {
    echo "Lỗi: " . $conn->error; // Hiển thị lỗi nếu có
}

?>