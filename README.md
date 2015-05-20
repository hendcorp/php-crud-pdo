#Simple PHP CRUD with PDO (PHP Data Object)

Repo ini adalah pengembangan dari PHP CRUD Basic yang bisa diakses di alamat : 
https://github.com/hendcorp/php-crud

Bedanya adalah kali ini kita menggunakan PDO (PHP Data Object) untuk mengolah datanya.

Contoh, di versi sebelumnya untuk menyimpan data ke Database MySQL kita menggunakan :
<pre>
<code>
mysql_query("INSERT INTO t_member (nama, email, hp) VALUES ('".$_POST['nama']."','".$_POST['email']."','".$_POST['hp']."')");

writeMsg('save.sukses');
</code>
</pre>

Di versi PDO :
<pre>
<code>
if(isset($_POST['simpan']))
{
	try
		{
			//Create Connection
			$conn = new PDO('mysql:host='.$DBhost.';dbname='.$DBname, $DBuser, $DBpass);
	
			//Insert (save) into table with PDO
			$sql = "INSERT INTO t_member (nama, email, hp) VALUES (:nama, :email, :hp)";
			$q = $conn->prepare($sql);
			$q->execute(array(':nama'=>$_POST['nama'],
                  	  		  ':email'=>$_POST['email'],
                  	  		  ':hp'=>$_POST['hp']));

			writeMsg('save.sukses');
		}
	catch (PDOException $pe)
		{
			die("Could not connect to the database $DBname :" . $pe->getMessage());
		}
}
</code>
</pre>

Di repo kali ini juga diberikan contoh untuk Edit, Delete dan Select data menggunakan PDO.
