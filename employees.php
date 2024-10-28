<?php
include 'db.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   if (isset($_POST['add_employee'])) {
      $depCode = $_POST['depCode'];
      $empLName = $_POST['empLName'];
      $empFName = $_POST['empFName'];
      $empRPH = $_POST['empRPH'];

      $sql = "INSERT INTO employees (depCode, empLName, empFName, empRPH) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $depCode, $empLName, $empFName, $empRPH);
      $stmt->execute();
      $stmt->close();
   }
   if (isset($_POST['edit_employee'])) {
      $empID = $_POST['empID'];
      $depCode = $_POST['depCode'];
      $empLName = $_POST['empLName'];
      $empFName = $_POST['empFName'];
      $empRPH = $_POST['empRPH'];

      $sql = "UPDATE employees SET depCode=?,  empLName=?, empFName=?, empRPH=? WHERE empID=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("isssi", $depCode, $empLName, $empFName, $empRPH, $empID);
      $stmt->execute();
      $stmt->close();
   }
   if (isset($_POST['delete_employee'])) {
      $empID = $_POST['empID'];

      $sql = "DELETE from employees WHERE empID = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('i', $empID);
      $stmt->execute();
      $stmt->close();
   }

}

$resultDepartment = $conn->query("SELECT depCode from departments");
$resultEmployee = $conn->query("SELECT * FROM employees");
?>

<body>
   <div class="container">
      <div class="top-menu">
         <button id="linkstyle" onclick="document.getElementById('addEmployeeModal').style.display='block'">Add Employee Here</button>
         | <a href="index.php">Back to menu</a>
      </div>
      <div class="table-container">
         <table>
            <tr>
               <th>ID</th>
               <th>Dept</th>
               <th>LastName</th>
               <th>FirstName</th>
               <th>Rate/Hour</th>
               <th>Actions</th>
            </tr>
            <?php while ($row = $resultEmployee->fetch_assoc()): ?>
               <tr>
                  <td><?php echo $row['empID']; ?></td>
                  <td><?php echo $row['depCode']; ?></td>
                  <td><?php echo $row['empLName']; ?></td>
                  <td><?php echo $row['empFName']; ?></td>
                  <td><?php echo $row['empRPH']; ?></td>
                  <td class="actions">
                     <button id="linkstyle" 
                     onclick="editEmployee(
                     <?php echo $row['empID']; ?>,
                     '<?php echo $row['depCode']; ?>',
                     '<?php echo $row['empLName']; ?>',
                     '<?php echo $row['empFName']; ?>',
                     '<?php echo $row['empRPH']; ?>'
                     )">Edit</button>
                     <form method="post">
                        <input type="hidden" name="empID" value="<?php echo $row['empID']; ?>">
                        <input id="linkstyle" type="submit" name="delete_employee" value="Delete" onclick="return confirm('Are you sure you want to delete this employee?');">
                     </form>
                  </td>
               </tr>
            <?php endwhile; ?>
         </table>
      </div>

      <div id="addEmployeeModal" class="modal">
         <form method="post">
            <h3>Add Employee</h3>
            <div class="form-input">
               <label for="depCode">Department Code:</label>
               <select name="depCode" id="depCode" required>
                  <option value="">Select department code...</option>
                  <?php while ($row = $resultDepartment->fetch_assoc()): ?>
                     <option value="<?php echo $row['depCode']; ?>"> <?php echo $row['depCode']; ?> </option>
                  <?php endwhile; ?>
               </select>
            </div>
            <div class="form-input">
               <label for="empFName">First Name:</label>
               <input type="text" name="empFName" required>
            </div>
            <div class="form-input">
               <label for="empLName">Last Name:</label>
               <input type="text" name="empLName" required>
            </div>
            <div class="form-input">
               <label for="empRPH">Rate per Hour:</label>
               <input type="text" name="empRPH" required>
            </div>
            <div class="actions">
               <input type="submit"  name="add_employee" value="Add Employee">
               <button type="button" onclick="document.getElementById('addEmployeeModal').style.display='none'">Close</button>
            </div>
         </form>
      </div>

      <div id="editEmployeeModal" class="modal">
         <form method="post">
            <h3>Edit Employee</h3>
            <input type="hidden"  name="empID" id="editEmpID">
            <div class="form-input">
               <label>Department Code:</label>
               <input type="text" id="editDepCode" name="depCode" required>
            </div>
            <div class="form-input">
               <label>Last Name:</label>
               <input type="text" id="editEmpLName" name="empLName" required>
            </div>
            <div class="form-input">
               <label>First Name:</label>
               <input type="text" id="editEmpFName" name="empFName" required>
            </div>
            <div class="form-input">
               <label>Rate per Hour:</label>
               <input type="text" id="editRPH" name="empRPH" required>
            </div>
            <div class="actions">
               <input type="submit" name="edit_employee" value="Edit Employee">
               <button type="button" onclick="document.getElementById('editEmployeeModal').style.display='none'">Close</button>
            </div>

         </form>
      </div>
   </div>


</body>
<script>
   function editEmployee(empID, depCode, empLName, empFName, empRPH){
      document.getElementById('editEmpID').value = empID;
      document.getElementById('editDepCode').value = depCode;
      document.getElementById('editEmpLName').value = empLName;
      document.getElementById('editEmpFName').value = empFName;
      document.getElementById('editRPH').value = empRPH;
      document.getElementById('editEmployeeModal').style.display="block";
   }
</script>
