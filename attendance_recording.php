<?php
include 'db.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
   if (isset($_POST['record_attendance'])) {
      $empID = $_POST['empID'];
      $attDate = $_POST['attDate'];
      $attTimeIn = $_POST['attTimeIn'];
      $attTimeOut = $_POST['attTimeOut'];

      $sql = "INSERT INTO attendance (empID, attDate, attTimeIn, attTimeOut, attStatus) values (?, ?, ?, ?, 'active')";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("isss", $empID, $attDate, $attTimeIn, $attTimeOut);
      $stmt->execute();
      $stmt->close();
   }
   if (isset($_POST['cancel_attendance'])) {
      $attRN = $_POST['attRN'];
      $attStatus = 'cancelled';

      $sql = "UPDATE attendance SET attStatus=? WHERE attRN=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("si", $attStatus, $attRN);
      $stmt->execute();
      $stmt->close();
   }
}

$resultAttendance = $conn->query("SELECT * FROM attendance WHERE attStatus != 'cancelled'");
$resultEmployee = $conn->query("SELECT * FROM employees");
?>


<head>
   <title>Attendance Recording</title>
</head>
<body>
   <div class="container">
      <div class="top-menu">
         <button id="linkstyle" onclick="document.getElementById('recordAttendanceModal').style.display='block'">Record Attendance Here</button> |
         <a href="index.php">Back to Menu</a>
      </div>
      <div class="table-container">
         <table>
            <tr>
               <th>Record #</th>
               <th>Emp ID</th>
               <th>Date Time In</th>
               <th>Date Time Out</th>
               <th>Actions</th>
            </tr>
            <?php while ($row = $resultAttendance->fetch_assoc()): ?>
               <tr>
                  <td> <?php echo $row['attRN']; ?> </td>
                  <td> <?php echo $row['empID']; ?> </td>
                  <td> <?php echo $row['attTimeIn']; ?> </td>
                  <td> <?php echo $row['attTimeOut']; ?> </td>
                  <td actions>
                     <form method="post">
                        <input type="hidden" name="attRN" value="<?php echo $row['attRN']; ?>">
                        <input id="linkstyle" type="submit" name="cancel_attendance" value="Cancel" onclick="return confirm('Are you sure to cancel this attendance record?');">
                     </form>
                  </td>
               </tr>
            <?php endwhile; ?>
         </table>
      </div>

      <div id="recordAttendanceModal" class="modal">
         <form method="post">
            <h3>Record Attendance</h3>

            <div class="form-input">
               <label>Employee ID:</label>
               <select name="empID" id="empID" required>
                  <option value="">Select employee id here...</option>
                  <?php while ($row = $resultEmployee->fetch_assoc()): ?>
                     <option value="<?php echo $row['empID']; ?>"><?php echo $row['empID']; ?></option>
                  <?php endwhile; ?>
               </select>
            </div>
            <div class="form-input">
               <label>Date:</label>
               <input type="date" name="attDate" required>
            </div>
            <div class="form-input">
               <label>Time In:</label>
               <input type="time" name="attTimeIn" required>
            </div>
            <div class="form-input">
               <label>Time Out:</label>
               <input type="time" name="attTimeOut" required>
            </div>
            <div class="action">
               <input type="submit" name="record_attendance" value="Record Attendance">
               <button type="button" onclick="document.getElementById('recordAttendanceModal').style.display='none'">Close</button>
            </div>
         </form>
      </div>
   </div>   
   


</body>
</html>