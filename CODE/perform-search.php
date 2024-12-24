<?php
// Kết nối cơ sở dữ liệu
include("connect.php");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy từ khóa tìm kiếm từ form
$keyword = $_GET['keyword'] ?? '';

// Truy vấn tìm kiếm
$sql = "SELECT * FROM table_students WHERE fullname LIKE ? OR hometown LIKE ?";
$stmt = $conn->prepare($sql);
$search_keyword = "%" . $keyword . "%";
$stmt->bind_param("ss", $search_keyword, $search_keyword);

$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
</head>
<body>
    <h1>Kết quả tìm kiếm</h1>
    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Địa chỉ</th>
                    <th>Trình độ</th>
                    <th>ID Nhóm</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']) ?></td>
                        <td><?php echo htmlspecialchars($row['fullname']) ?></td>
                        <td><?php echo htmlspecialchars($row['dob']) ?></td>
                        <td><?php echo htmlspecialchars($row['gender']) ?></td>
                        <td><?php echo htmlspecialchars($row['hometown']) ?></td>
                        <td>
                            <?php 
                                if($row['lever']==0) echo("tiến sĩ");
                                else if($row['lever']==1) echo("thạc sĩ");
                                else if($row['lever']==2) echo("kỹ sư");
                                else echo("khác");
                            ?>
                        </td>
                        <td><?php echo("nhóm ".$row['group_id']) ?></td>
                        <td>
                            <a href="edit.php?hid=<?php echo htmlspecialchars($row['id']) ?>" class="btn btn-warning">Sửa</a> <a class="btn btn-danger" href="delete.php?hid=<?php echo htmlspecialchars($row['id']) ?>">Xóa</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Không tìm thấy kết quả nào phù hợp.</p>
    <?php endif; ?>

    <a href="index.html">Quay lại</a>
</body>
</html>
<?php
// Đóng kết nối
$conn->close();
?>
