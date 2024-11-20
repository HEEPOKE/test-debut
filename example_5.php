<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>กรอกข้อมูลพนักงาน</title>
    <script>
        function validateForm() {
            const empNum = document.forms["employeeForm"]["empNum"].value;
            const empName = document.forms["employeeForm"]["empName"].value;
            const position = document.forms["employeeForm"]["position"].value;

            if (empNum === "") {
                alert("คุณยังไม่ได้กรอกรหัสพนักงาน");
                return false;
            }

            if (empName === "") {
                alert("คุณยังไม่ได้กรอกชื่อพนักงาน");
                return false;
            }

            if (position === "") {
                alert("คุณยังไม่ได้เลือกตำแหน่ง");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <h1>กรอกข้อมูลพนักงาน</h1>
    <form name="employeeForm" onsubmit="return validateForm()">
        <label for="empNum">รหัสพนักงาน:</label>
        <input type="text" id="empNum" name="empNum" placeholder="กรอกรหัสพนักงาน"><br><br>

        <label for="empName">ชื่อพนักงาน:</label>
        <input type="text" id="empName" name="empName" placeholder="กรอกชื่อพนักงาน"><br><br>

        <label for="position">ตำแหน่ง:</label>
        <select id="position" name="position">
            <option value="">เลือกตำแหน่ง</option>
            <option value="Manager">Manager</option>
            <option value="Supervisor">Supervisor</option>
            <option value="Clerk">Clerk</option>
            <option value="Salesman">Salesman</option>
        </select><br><br>

        <input type="submit" value="บันทึกข้อมูล">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $empNum = $_POST['empNum'];
        $empName = $_POST['empName'];
        $position = $_POST['position'];

        include 'conn.php';
        $stmt = $conn->prepare("INSERT INTO Employee (EmpNum, EmpName, Position) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $empNum, $empName, $position);

        if ($stmt->execute()) {
            echo "<script>alert('บันทึกข้อมูลสำเร็จ!');</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->error . "');</script>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>

</html>