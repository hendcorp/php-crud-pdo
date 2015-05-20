<html>
<head>
<!--
Project Name : CRUD with PHP, PDO (MySQL) and Bootstrap
Author		 : Hendra Setiawan
Website		 : http://www.hendrasetiawan.net
Email	 	 : hendrabpp[at]gmail.com
-->
<?php 
include "module/header.php";
include "module/alerts.php";
require_once "config/DBConfig.php"; 

try
	{
		//Create Connection
		$conn = new PDO('mysql:host='.$DBhost.';dbname='.$DBname, $DBuser, $DBpass);
		$sql = "SELECT id, nama, email, hp FROM t_member WHERE id = :id";
		$q = $conn->prepare($sql);
		$q->execute(array(':id'=>$_GET['id']));
 		$q -> setFetchMode(PDO::FETCH_ASSOC);
 		$data = $q -> fetch();
 	}
catch (PDOException $pe)
	{
		die("Could not connect to the database $DBname :" . $pe->getMessage());
	}
?>
</head>
<body>

<div class="container">
<?php include "module/nav.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>Form Edit (Update)</h1>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
	<form id="form_input" method="POST">	

<?php  
if(isset($_POST['update']))
{
	try
		{
			//Create Connection
			$conn = new PDO('mysql:host='.$DBhost.';dbname='.$DBname, $DBuser, $DBpass);
	
			//Update (edit) data MySQL with PDO
			$sql = "UPDATE t_member SET nama = :nama, email = :email, hp = :hp WHERE id = :id";
			$q = $conn->prepare($sql);
			$q->execute(array(':nama'=>$_POST['nama'],
                  	  		  ':email'=>$_POST['email'],
                  	  		  ':hp'=>$_POST['hp'],
                  	  		  ':id'=>$_GET['id']));

			writeMsg('save.sukses');
		}
	catch (PDOException $pe)
		{
			die("Could not connect to the database $DBname :" . $pe->getMessage());
		}	


try
	{
		//Create Connection
		$conn = new PDO('mysql:host='.$DBhost.';dbname='.$DBname, $DBuser, $DBpass);

		//Re-Load Data from DB
		$sql = "SELECT id, nama, email, hp FROM t_member WHERE id = :id";
		$q = $conn->prepare($sql);
		$q->execute(array(':id'=>$_GET['id']));
 		$q -> setFetchMode(PDO::FETCH_ASSOC);
 		$data = $q -> fetch();
 	}
catch (PDOException $pe)
	{
		die("Could not connect to the database $DBname :" . $pe->getMessage());
	}
}
?>

	<div class="form-group">
  		<label class="control-label" for="nama">Nama (wajib diisi)</label>
  		<input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data['nama']; ?>" required>
	</div>

	<div class="form-group">
  		<label class="control-label" for="email">Email (wajib diisi)</label>
  		<input type="email" class="form-control" name="email" id="email" value="<?php echo $data['email']; ?>" required>
	</div>

	<div class="form-group">
  		<label class="control-label" for="hp">No HP</label>
  		<input type="text" class="form-control" name="hp" id="hp" value="<?php echo $data['hp']; ?>">
	</div>

	<div class="form-group">
	<input type="submit" value="Update" name="update" class="btn btn-primary">
	<a href="rekap.php" class="btn btn-danger">Batal</a>
	</div>

	</form>
	</div>
</div>

</div>
<?php include "module/footer.php"; ?>
</body>
</html>
