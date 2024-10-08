$(document).ready(function () {
    // Cập nhật phần xử lý xóa trong jQuery
    $(".trash").click(function () {
        var row = $(this).closest("tr"); // Lấy dòng gần nhất
        var orderId = $(this).data("id"); // Lấy ID đơn hàng từ thuộc tính data-id

        swal({
            title: "Cảnh báo",
            text: "Bạn có chắc chắn là muốn xóa đơn hàng này?",
            buttons: ["Hủy bỏ", "Đồng ý"],
        }).then((willDelete) => {
            if (willDelete) {
                // Gửi yêu cầu xóa đến server
                $.ajax({
                    type: "POST",
                    url: "./php/module.php",
                    data: { action: 'delete_pet_order', id: orderId },
                    success: function (response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            swal("Đã xóa thành công!", {
                                icon: "success",
                            });
                            // Xóa dòng trong bảng
                            row.remove();
                        } else {
                            swal("Lỗi!", result.message, "error");
                        }
                    },
                    error: function () {
                        swal("Lỗi!", "Đã xảy ra lỗi khi thực hiện yêu cầu.", "error");
                    }
                });
            }
        });
    });

    // Thêm đơn hàng
    $('#addPetOrderForm').on('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('action', 'add_pet_order'); // Thêm action vào dữ liệu

        $.ajax({
            type: "POST",
            url: "./php/module.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                const result = JSON.parse(response); // Phân tích cú pháp phản hồi JSON
                if (result.status === 'success') {
                    // Xử lý hiển thị đơn hàng mới trên bảng
                    swal("Thêm thành công!", result.message, "success");
                    // Cập nhật bảng (có thể gọi hàm để cập nhật bảng từ cơ sở dữ liệu hoặc thêm dòng mới vào bảng)
                    // Ví dụ: loadPetOrders();
                } else {
                    swal("Lỗi", result.message, "error");
                }
            },
            error: function () {
                swal("Lỗi", "Không thể kết nối đến máy chủ.", "error");
            }
        });
    });

    $(document).ready(function() {
        // Khi nhấn nút sửa
        $('#editt').on('click', function() {
            var petId = $(this).data('id');
            
            // Gửi yêu cầu lấy thông tin thú cưng cần sửa
            $.ajax({
                url: './php/get_pet_info.php',
                type: 'POST',
                data: { 'MaThuCung': petId },
                success: function(response) {
                    var data = JSON.parse(response);
                    $('#editMaThuCung').val(data.MaThuCung);
                    $('#editTenThuCung').val(data.TenThuCung);
                    $('#editLoaiThuCung').val(data.LoaiThuCung);
                    $('#editDichVuChon').val(data.DichVuChon);
                    $('#editTrangThaiChuaBenh').val(data.TrangThaiChuaBenh);
                    $('#editGhiChu').val(data.GhiChu);
                    
                    // Hiện bảng sửa
                    $('#editPetTable').style.display = 'block';
                }
            });
        });
        
        // Khi nhấn nút Hủy
        $('#cancelEditPet').on('click', function() {
            $('#editPetTable').hide(); // Ẩn bảng sửa
        });
    
        // Khi nhấn nút Lưu Thay Đổi
        $('#saveEditPet').on('click', function() {
            // Gửi yêu cầu cập nhật
            var updatedPetData = {
                'editMaThuCung': $('#editMaThuCung').val(),
                'editTenThuCung': $('#editTenThuCung').val(),
                'editLoaiThuCung': $('#editLoaiThuCung').val(),
                'editDichVuChon': $('#editDichVuChon').val(),
                'editTrangThaiChuaBenh': $('#editTrangThaiChuaBenh').val(),
                'editGhiChu': $('#editGhiChu').val()
            };
            
            $.ajax({
                url: 'update_pet_info.php',
                type: 'POST',
                data: updatedPetData,
                success: function(response) {
                    alert(response);
                    $('#editPetTable').hide(); // Ẩn bảng sửa
                    location.reload(); // Tải lại trang để cập nhật bảng
                }
            });
        });
    });
    
});
