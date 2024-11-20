<!DOCTYPE html>

<html lang="th">

<head>
    <title>Employee List</title>
</head>

<body>
    <h1>รายชื่อพนักงาน</h1>

    <form method="POST" action="example_4.php">
        <input type="text" name="empName" placeholder="ค้นหาชื่อพนักงาน">
        <input type="submit" value="ค้นหา">
    </form>

    <ul>
        <?php
        include 'conn.php';

        function getEmployeeNames($conn, $empName = "")
        {
            $sql = "SELECT EmpName FROM EmployeeBackup";
            if (!empty($empName)) {
                $sql .= " WHERE EmpName LIKE ?";
            }

            $stmt = $conn->prepare($sql);
            if (!empty($empName)) {
                $searchTerm = "%" . $empName . "%";
                $stmt->bind_param("s", $searchTerm);
            }

            $stmt->execute();
            return $stmt->get_result();
        }

        $empName = isset($_POST['empName']) ? $_POST['empName'] : "";
        $result = getEmployeeNames($conn, $empName);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . htmlspecialchars($row["EmpName"]) . "</li>";
            }
        } else {
            echo "ไม่มีข้อมูลพนักงาน";
        }

        $conn->close();
        ?>
    </ul>
</body>

</html>