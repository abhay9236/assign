<?php
include 'action.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
</body>
<?php if(isset($_SESSION['response'])){ ?>
    <div class="alert alert-<?=$_SESSION['res_type'];?>alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <?=$_SESSION['response'];?>
  </div>
  <?php } unset($_SESSION['response']); ?>

    
    
  
    <div class="row">
        <div class="col-md-4">
            <h3 class="text-center text-info">Add Record</h3>
           <form action="action.php" method="post" enctype="multipart/form-data">
           <input type="hidden" name="id" value="<?= $id;?>">
           <div class="form-group">
               <input type="text" name ="name" value="<?=$name;?>" class="form-control" placeholder="Enter Name" required>
           </div>
           <div class="form-group">
               <input type="email" name ="email"  value="<?=$email; ?>" class="form-control" placeholder="Enter email" required>
           </div>
           <div class="form-group">
               <input type="tel" name ="phone" value="<?=$phone; ?>" class="form-control" placeholder="Enter phone " required>
           </div>
           <div class="form-group">
             <input type="hidden" name="oldimage" value="<?=$photo; ?>">
               <input type="file" name ="image" class="custom-file" >
               <img src="<?=$photo; ?>" width="120" class="img-thumbnail">
           </div>
           <div class="form-group">
             <?php if($update==true){ ?>
              <input type="submit" name ="update" class="btn btn-primary btn block" value=" update record" >
             <?php }  else{ ?>
               <input type="submit" name ="add" class="btn btn-primary btn block" value=" Add record" >
             <?php } ?>
           </div>
           </form>
        </div>
        <div class="col-md-8">
          <?php
           $query="SELECT * FROM crud2";
           $stmt=$conn->prepare($query);
           $stmt->execute();
           $result=$stmt->get_result();
          ?>
          <h3 class="text-center text-info">Records present in database</h3>
            <table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Image</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>action</th>
      </tr>
    </thead>
    <tbody>
     <?php while($row=$result->fetch_assoc()){?>

      <tr>
        <td><?=$row['id'];?></td>
        <td><img src="<?=$row['photo'];?>" width ="25"></td>
        <td><?=$row['name'];?> </td>
        <td><?=$row['email'];?></td>
        <td><?=$row['phone'];?></td>
        <td>
         <a href="details.php?details=<?=$row['id'];?>" class="badge badge-primary p-2">Details</a>
         <a href="action.php?delete=<?=$row['id'];?>" class="badge badge-danger p-2 "onclick="return confirm('Do you want to delete this record' );">Delete</a>
         <a href="index.php?edit=<?=$row['id'];?>" class="badge badge-success p-2">Edit</a>

        </td>
      </tr>
      <?php    }?>


    </tbody>
  </table>

        </div>
    </div>  
</body>
</html>

