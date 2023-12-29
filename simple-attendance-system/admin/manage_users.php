<?php
// session_start();
// if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
//     header("Location:login.php");
//     die();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/attendance_record.css">
    <link rel="icon" type="image/x-icon" href="../resources/images/logo-colored.png">
    <title> Employee Record</title>
    </head>
<body>

    <?php 
        include ('admin-header.php'); 
        include ('../config.php');
        if (isset($_POST['search'])){
            $emp_id = $_POST['filter_email'];
            // $sql = "SELECT * FROM employee_tbl INNER JOIN attendance ON employee_tbl.emp_id = attendance.emp_id WHERE attendance.emp_id = '".$_POST["filter_email"]."'";

            $sql = "SELECT * FROM employee_tbl  WHERE employee_tbl.emp_email = '".$_POST["filter_email"]."'";

            $result = $conn->query($sql) or die($conn->error);
        }
        else{
            $sql = " SELECT * FROM employee_tbl  ORDER BY emp_id DESC ";
            $result = $conn->query($sql);

        }
        $conn->close();

    ?>

<h2>Manage Employee Records</h2>
<a href="create_employee.php" class="addNewEmployee"> Add New Employee </a>
    <form action="" class="data-list" method="post">
        
        <div class="filter-container" id="filter-container">
            <label for="filter-input"> Enter Employee E-mail:</label>
            <input type="email" name="filter_email" id="filter-input" required>
            <button type="submit"name="search"> Search</button>
        </div>
    </form>


<div style="overflow-x:auto;">
  <table>
    <tr>
      <th>Last Name</th>
      <th>First Name</th>
      <th>Position</th>
      <th> E-mail </th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>


    <!-- PHP CODE TO FETCH DATA FROM ROWS -->
                <!-- // LOOP TILL END OF DATA -->
    <?php
        while($rows=$result->fetch_assoc()){
                
    ?>
        <tr>
    
            <td><?php echo $rows['emp_lastname'] ?></td>
            <td><?php echo $rows['emp_firstname'] ?></td>
            <td><?php echo $rows['emp_position'] ?></td>

    
            <td><?php echo $rows['emp_email'] ?></td>                 
            <td><a href="edit_user.php?id=<?php echo $rows['emp_id']; ?>"><i class="fa fa-pencil" aria-hidden="true" color="red"></i></a></td>
            <td><a href="delete_user.php?id=<?php echo $rows['emp_id']; ?>"><i class="fa fa-trash" aria-hidden="true"  color="red"></i></a></td>
        </tr>
<?php
        }//end while
    
?>
</table>
</div>
<script>
    //check select option
function getOption() {
        selectElement = document.querySelector('#filter');
        filterContainer = document.querySelector('#filter-container');
        output = selectElement.value;
        // console.log(output);
        if ((selectElement.selectedIndex) > -1){
            filterContainer.style.display ="flex";
        }
        event.preventDefault();
        // document.querySelector('.output').textContent = output;
}

</script>

</body>
</html>
