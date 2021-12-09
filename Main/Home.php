<!-- Table  -->
<?php  //checking if session is set from login page
session_start();
if (isset($_SESSION['status'])) {
    if ($_SESSION['status']=="loggedIn"){
    }
    else{
      header("Location: index.php");// sends you back to login page 
    }
}
else{
  header("Location: index.php");// sends you back to login page 
}


?>
<style>
  #id_bg{
    background-image: url("images/background.jpg");
    background-repeat: no-repeat, repeat;
    background-color: #cccccc;
    background-size: 80px 80px;
    background-position:center top;
  }
  #table_main{
    background-color: rgb(43, 200, 224);
  }
  
  #table_secondary{
    background-color: rgb(40, 180, 201);
  }
  #table_3{
    background-color: #d42828;
  }
  #table_4{
    background-color: #1bc21b;
  }
</style>

<html>
<head>
  <title>Employee Records</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  
  <!-- JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

  <!-- mdb -->
  <link rel="stylesheet" href="mdb.min.css" />
  
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="Main.css" />

</head>

<body>


<!-- NAV BAR-->
<nav class="navbar navbar-light bg-light">
    <nav aria-label="Page navigation example">
    </nav>
    <div class="col">
    </div>

    <div class="col-8">
      <h3 class="text-center">Sales Management</h3>
    </div>

    <div class="col">
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle btn-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Options
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="log.txt">Go to Log</a>
          <a class="dropdown-item" href="logout.php">Log Out</a>
        </div>
      </div>
    </div>
</nav>

<?php include "database.php"; ?>  
  
<div class="alert alert-dark text-center" role="alert">
  <p>Area: <?php echo $_SESSION['selectedRegion'];  ?></p>
</div>


<div class="container">
  <div class="row">

    <div class="col">
    </div>

    <div class="col-11 text-center"><!-- Table  -->
      <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="th-sm">ID

            </th>
            <th class="th-sm">Name

            </th>
            <th class="th-sm">Email

            </th>
            <th class="th-sm">Region
            </th>
            <th class="th-sm">Phone Number
            </th>
            <th class="th-sm">Target
            </th>
            <th class="th-sm">6Quarters
            </th>
            <th class="th-sm">Bonus
            </th>
            <th class="th-sm">Image
            </th>
            <th class="th-sm">Reward?
            </th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
          <tr>
            <td id="id_bg"><?php echo htmlspecialchars($row['Id']); ?></td>

            <td id="table_main"><?php echo htmlspecialchars($row['Name']); ?></td>
            <td id="table_main"><?php echo htmlspecialchars($row['Email']); ?></td>
            <td id="table_main"><?php echo htmlspecialchars($row['Region']); ?></td>
            <td id="table_main"><?php echo htmlspecialchars($row['Phone']); ?></td>
            <td id="table_main"><?php echo htmlspecialchars($row['Target']); ?></td>
            <td id="table_secondary"><?php echo htmlspecialchars($row['6Quarters']); ?></td>
            <td id="table_secondary"><?php echo htmlspecialchars($row['Bonus']); ?></td>
            <td><img width="50px" height="50px" src="images/<?php echo $row['image'];?>" alt="Employee Image"></td>
            <?php  
            if ($row['6Quarters'] >= $row['Target']){
              echo "<td id='table_4' class='text-center'> Yes </td>";
            }
            else{
              echo "<td id='table_3' class='text-center'> No </td>";
            }
            ?>
            
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>

 
      
    </div>

    <div class="col">
    </div>

  </div>
</div>
<div id="Graphs">
  <h3 class="text-center"> Graph Data</h3>
   <div class="row">
      <div class="col text-center">
      </div>

      <div class="col text-center">
        <div>
         <?php include "graph1.php"; ?> 
        </div>
      </div>

      <div class="col text-center">
      </div>

    </div>
  </div>
</div>

<div class="alert alert-dark" role="alert">
  <h5 class="text-center"> &copy; Haris Sharp & Dominikos Vlachantonis 2021 </h5>
</div>
  


<script>
  //
$(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>





  
</body>
</html>