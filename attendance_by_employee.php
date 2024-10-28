<?php
include 'db.php';
include 'header.php';

$emp_data = null;
$totalHours = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
   $empID = $_POST['empID'];

   $emp_result = $conn->query("SELECT
                                 e.empFName,
                                 e.empLName,
                                 e.empRPH,
                                 d.depFName
                                 FROM employees e JOIN departments d ON e.depCode = d.depCode
                                 WHERE e.empID = '$empID'");
   $emp_data = $emp_result->fetch_assoc();
   $att_result = $conn->query("SELECT * FROM attendance WHERE empID = $empID");

}
?>

<body>
   <div class="container">
      <div class="top-menu" style="justify-content: space-between;">

         <form method="post">
            <label>Input Employee #:</label>
            <input type="text" name="empID" required>
            <input type="submit" value="Search">       
         </form>
         <a href="index.php">Back to menu</a>   
      </div>
      <?php if ($emp_data && $empID): ?>
         <div class="emp-details">
            <label><strong>Name: </strong><?php echo $emp_data['empFName']. ' ' . $emp_data['empLName']; ?></label>
            <label><strong>Department: </strong><?php echo $emp_data['depFName']; ?></label>
         </div>

         <div class="table-container">
            <table>
               <tr>
                  <th>Record #</th>
                  <th>Emp ID</th>
                  <th>DateTime In</th>
                  <th>DateTime Out</th>
                  <th>Hours</th>
               </tr>
               <?php while  ($row = $att_result->fetch_assoc()): 
                     $timeIn = new DateTime($row['attTimeIn']);
                     $timeOut = new DateTime($row['attTimeOut']);
                     $interval = $timeIn->diff($timeOut);
                     $hours = $interval->h + ($interval->i / 60);
                     $totalHours += $hours;
                  ?>
                  <tr>
                     <td><?php echo $row['attRN']; ?></td>
                     <td><?php echo $row['empID']; ?></td>
                     <td><?php echo $row['attTimeIn']; ?></td>
                     <td><?php echo $row['attTimeOut']; ?></td>
                     <td><?php echo number_format($hours, 2); ?></td>
                  </tr>
               <?php endwhile; ?>
            </table>
         </div>

         <div class="emp-details">
            <label><strong>Rate per Hour: </strong><?php echo number_format($emp_data['empRPH'], 2); ?></label>
            <label><strong>Total Hours Worked:  </strong><?php echo number_format($totalHours, 2); ?></label>
         </div>
         <div class="emp-details">
            <label><strong>Salary: </strong><?php echo number_format($totalHours* $emp_data['empRPH'], 2); ?></label>
            <label><strong>Date Generated:  </strong><?php echo date('Y-m-d')?></label>
         </div>
         
      <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($emp_data)): ?>
         <div class="emp-details">
            <p>No employee data found for the entered ID.</p>
         </div>
      <?php else: ?>
         <div class="emp-details">
            <p>Please enter an Employee ID to view attendance details.</p>
         </div>
      <?php endif; ?>

   </div>
</body>