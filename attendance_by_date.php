<?php
include 'db.php';
include 'header.php';

$dateFrom = null;
$dateTo = null;
$result = [];
$totalHours = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $dateFrom = $_POST['dateFrom'];
   $dateTo = $_POST['dateTo'];

   $result = $conn->query("SELECT * FROM attendance WHERE attDate  BETWEEN '$dateFrom' AND '$dateTo'");
}
?>

<body>
   <div class="container">
      <div class="top-menu" style="justify-content: space-between;">
         <form method="post">
            <label>Date From:</label><input type="date" name="dateFrom" requried>
            <label>Date To:</label><input type="date" name="dateTo" requried>
            <input type="submit" value="Search">       
         </form>
         <a href="index.php">Back to menu</a>   
      </div>
      <div class="table-container">
         <table>
            <tr>
               <th>Record #</th>
               <th>Emp ID</th>
               <th>DateTime In</th>
               <th>DateTime Out</th>
               <th>Total (hours)</th>
            </tr>
            <?php 
               if ($result && $result->num_rows >0):

               while ($row = $result->fetch_assoc()):
               $timeIn = new DateTime($row['attTimeIn']);
               $timeOut = new DateTime($row['attTimeOut']);
               $interval = $timeOut->diff($timeIn);
               $hours = $interval->h + ($interval->i / 60);
               $totalHours += $hours;
            ?>
               <tr>
                  <td> <?php echo $row['attRN']; ?> </td>
                  <td> <?php echo $row['empID']; ?> </td>
                  <td> <?php echo $row['attTimeIn']; ?> </td>
                  <td> <?php echo $row['attTimeOut']; ?> </td>
                  <td> <?php echo number_format($hours, 2); ?></td>
               </tr>
            <?php endwhile; else: ?>
               <span>No records found for the selected date range.</span>
            <?php endif; ?>
            
         </table>
      </div>
               
      <div class="emp-details">
            <label>Date Generate: <?php echo date('Y-m-d');?></label>
            <label>Total Hours: <?php echo number_format($totalHours, 2); ?></label>
      </div>


   </div>
</body>