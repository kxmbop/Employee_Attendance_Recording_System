<?php
include 'db.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
   if (isset($_POST['add_department']))  {
      $depFName = $_POST['depFName'];
      $depHead = $_POST['depHead'];
      $depTelNo = $_POST['depTelNo'];

      $sql = "INSERT INTO departments (depFName, depHead, depTelNo)
               VALUES (?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sss", $depFName, $depHead, $depTelNo);
      $stmt->execute();
      $stmt->close();
   }
   if (isset($_POST['edit_department'])) {
      $depCode = $_POST['depCode'];
      $depFName = $_POST['depFName'];
      $depHead = $_POST['depHead'];
      $depTelNo = $_POST['depTelNo'];

      $sql = "UPDATE departments SET depFName=?, depHead=?,  depTelNo=? WHERE depCode=?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $depFName, $depHead, $depTelNo, $depCode);
      $stmt->execute();
      $stmt->close();
   }
   if (isset($_POST['delete_department'])) {
      $depCode = $_POST['depCode'];

      $sql = "DELETE FROM departments WHERE depcode = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $depCode);
      $stmt->execute();
      $stmt->close();
   }
}

$result = $conn->query("SELECT * FROM departments");
?>

<head>
   <title>Department Management</title>
</head>
<body>
   <div class="container">
      <div class="top-menu">
         <button id="linkstyle" onclick="document.getElementById('addDepartmentModal').style.display='block'">Add a Department Here</button>
         | <a href="index.php">Back to Menu</a>
      </div>
      <div class="table-container">
         <table>
            <tr>
               <th>Code</th>
               <th>Name</th>
               <th>Head</th>
               <th>Tel No.</th>
               <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
               <tr>
                  <td><?php echo $row['depCode']?></td>
                  <td><?php echo $row['depFName']?></td>
                  <td><?php echo $row['depHead']?></td>
                  <td><?php echo $row['depTelNo']?></td>
                  <td class="actions">
                     <button id="linkstyle" 
                        onclick="editDepartment(
                        <?php echo $row['depCode']; ?>,
                        '<?php echo $row['depFName']; ?>',
                        '<?php echo $row['depHead']; ?>',
                        '<?php echo $row['depTelNo']; ?>'
                        )">Edit</button>
                     <form method="post">
                        <input type="hidden" name="depCode" value="<?php  echo $row['depCode']; ?>">
                        <input id="linkstyle" type="submit" name="delete_department" value="Delete" onclick="return confirm('Are you sure you want to delete this department?');">
                     </form>
                  </td>
               </tr>
            <?php endwhile; ?>
         </table>
      </div>


      <div id="addDepartmentModal" class="modal">
         <form method="post">
            <h3>Add Department</h3>
            <div class="form-input">
               <label>Department Name:</label> 
               <input type="text" name="depFName" required>
            </div>
            <div class="form-input">
               <label>Department Head:</label> 
               <input type="text" name="depHead" required>
            </div>
            <div class="form-input">
               <label>Telephone Number:</label> 
               <input type="text" name="depTelNo" required>
            </div>
            <div class="actions">
               <input type="submit" name="add_department" value="Add Department">
               <button type="button" onclick="document.getElementById('addDepartmentModal').style.display='none'">Close</button>
            </div>
         </form>
      </div>

      <div id="editDepartmentModal" class="modal">
         <form method="post">
            <h3>Edit Department</h3>
            <input type="hidden" name="depCode" id="editDepCode">
            <div class="form-input">
               <label>Department Name:</label> 
               <input type="text" name="depFName" id="editDepFName" required>
            </div>
            <div class="form-input">
               <label>Department Head:</label> 
               <input type="text" name="depHead" id="editDepHead" required>
            </div>
            <div class="form-input">
               <label>Telephone Number:</label> 
               <input type="text" name="depTelNo" id="editDepTelNo" required>
            </div>
            <div class="actions">
               <input type="submit" name="edit_department" value="Update Department">
               <button type="button" onclick="document.getElementById('editDepartmentModal').style.display='none'">Close</button>
            </div>
         </form>
      </div>
   </div>
</body>
<script>
   function editDepartment(depCode,  depFName, depHead, depTelNo) {
      document.getElementById('editDepCode').value = depCode;
      document.getElementById('editDepFName').value = depFName;
      document.getElementById('editDepHead').value = depHead;
      document.getElementById('editDepTelNo').value = depTelNo;
      document.getElementById('editDepartmentModal').style.display = 'block';
   }
</script>

