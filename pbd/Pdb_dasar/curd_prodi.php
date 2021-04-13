<?php
require("../sistem/koneksi.php");

$hub = open_connection();
$a = @$_GET["a"];
$id = @$_GET["id"];
$sql = @$_POST["sql"];
switch ($sql) {
	case "create":
		create_prodi();
		break;
	case "update":
		update_prodi();
		break;
	case "delete":
		delete_prodi();
		break;
}
switch ($a) {
	case "list":
		read_data();
		break;
	case "input":
		input_data();
		break;
	case "edit":
		edit_data($id);
		break;
	case "hapus":
		hapus_data($id);
		break;
	default:
		read_data();
		break;
}
mysqli_close($hub);
?>

<?php
function read_data() {
	global $hub;
	$query = "select * from dt_prodi";
	$result = mysqli_query($hub, $query); ?>

	<style>
		header {
 		 background-color: #ADD8E6;
 		 padding: 5px;
 		 text-align: center;
 		 font-size: 24px;
		 color: white;
			}
	.table1 {
   		font-family: sans-serif;
   		color: #444;
     	border-collapse: collapse;
      	width: 100%;
     	border: 1px solid #f2f5f7;
		}
 
	.table1 tr th{
    	background: #35A9DB;
    	color: #fff;
    	font-weight: normal;
	}
 
	.table1, th, td {
   	 	padding: 20px 40px;
    	text-align: center;
	}
 
	.table1 tr:hover {
    	background-color: #ADD8E6;
	}
 
	.table1 tr:nth-child(even) {
   		background-color: #ADD8E6;
	}
	.tomboledit{
  		background:#4B0082;
  		color:white;
  		border-top:0;
 		border-left:0;
  		border-right:0;
  		padding:5px 20px;
  		text-decoration:none;
  		font-family:sans-serif;
  		font-size:11pt;
	}
	.tombolhapus{
  		background:#DC143C;
  		color:white;
  		border-top:0;
  		border-left:0;
  		border-right:0;
  		padding:5px 20px;
  		text-decoration:none;
  		font-family:sans-serif;
  		font-size:11pt;
	}
	.td2{
		padding: 20px 20px;
    	text-align: center;
	}
	</style>
	<header>
		<h2>Read Data Program Studi</h2>
	</header>
	<table class="table1">
		<tr>
			<td class ="td2" colspan="1"><a class ="tomboledit" href="curd_prodi.php?a=input>">INPUT</a></td>
		</tr>
		<tr>
			<td>ID</td>
			<td>KODE</td>
			<td>NAMA PRODI</td>
			<td>AKREDITAS</td>
			<td colspan="2">AKSI</td>
		</tr>
		<?php while($row = mysqli_fetch_array($result)) { ?>
		<tr>
			<td><?php echo $row['idprodi']; ?></td>
			<td><?php echo $row['kdprodi']; ?></td>
			<td><?php echo $row['nmprodi']; ?></td>
			<td><?php echo $row['akreditasi']; ?></td>
			<td>
				<a class ="tomboledit" href="curd_prodi.php?a=edit&id=<?php echo $row ['idprodi']; ?>">EDIT</a>
			</td>
			<td><a class ="tombolhapus" href="curd_prodi.php?a=hapus&id=<?php echo $row ['idprodi']; ?>">HAPUS</a></td>
		</tr>
		<?php } ?>
	</table>
<?php } ?>

<?php
function input_data() {
	$row = array(
			"kdprodi" => "",
			"nmprodi" => "",
			"akreditasi" => "-"
		); ?>

	<h2>Input Data Program Studi</h2>
	<form action="curd_4.php?a=list" method="post">
		<input type="hidden" name="sql" value="create">
		Kode Prodi
		<input type="text" name="kdprodi" maxlength="6" size="6" value="<?php echo trim($row["kdprodi"]) ?>" />
		<br>
		Nama Prodi
		<input type="text" name="nmprodi" maxlength="70" size="70" value="<?php echo trim($row["nmprodi"]) ?>" />
		<br>
		Akreditasi Prodi
		<input type="radio" name="akreditasi" value="-" <?php if ($row["akreditasi"]=='-' || $row["akreditasi"]=='') { echo "checked=\"checked\""; } else {echo "";} ?>> -
		<input type="radio" name="akreditasi" value="A" <?php if ($row["akreditasi"]=='A') {echo "checked=\"checked\""; } else {echo "";} ?> > A
		<input type="radio" name="akreditasi" value="B" <?php if ($row["akreditasi"]=='B') {echo "checked=\"checked\""; } else {echo "";} ?> > B
		<input type="radio" name="akreditasi" value="C" <?php if ($row["akreditasi"]=='C') {echo "checked=\"checked\""; } else {echo "";} ?> > C
			<br>
			<input type="submit" name="action" value="Simpan">
			<br>
			<a href="curd_prodi.php?a=list">Batal</a>
	</form>
<?php } ?>

<?php
function edit_data($id) {
	global $hub;
	$query = "select * from dt_prodi where idprodi = $id";
	$result = mysqli_query($hub, $query);
	$row = mysqli_fetch_array($result); ?>

	<style>
	header {
 		 background-color: #666;
 		 padding: 5px;
 		 text-align: center;
 		 font-size: 20px;
		 color: white;
		}

	table {
   		font-family: sans-serif;
   		color: #444;
     	border-collapse: collapse;
      	width: 100%;
     	border: 1px solid #f2f5f7;
		}
 
	table tr th{
    	background: #35A9DB;
    	color: #fff;
    	font-weight: normal;
	}
 
	table, th, td {
   	 	padding: 20px 40px;
    	text-align: center;
	}
 
	table tr:hover {
    	background-color: #f5f5f5;
	}
 
	table tr:nth-child(even) {
   		background-color: #f2f2f2;
	}
	.buttonbatal{
  		background:#2C97DF;
  		color:white;
  		border-top:0;
 		border-left:0;
  		border-right:0;
  		padding:5px 20px;
  		text-decoration:none;
  		font-family:sans-serif;
  		font-size:11pt;
	}
	.buttonsimpan{
  		background:#2C97DF;
  		color:white;
  		border-top:0;
 		border-left:0;
  		border-right:0;
  		padding:5px 20px;
  		text-decoration:none;
  		font-family:sans-serif;
  		font-size:11pt;
	}
	</style>
	<header>
	<h2>Edit Data Program Studi</h2>
	</header>
	<form action="curd_prodi.php?a=list" method="post">
		<table>
		<input type="hidden" name="sql" value="update">
		<tr>
			<td>
				<input type="hidden" name="idprodi" value="<?php echo trim($id) ?>"> Kode Prodi
			</td>
			<td>
				<input type="text" name="kdprodi" maxlength ="6" size="6" value="<?php echo trim($row["kdprodi"]) ?>" />
			</td>
		</tr>
		<tr>
			<td>
				Nama Prodi
			</td>
			<td>
				<input type="text" name="nmprodi" maxlength ="70" size="70" value="<?php echo trim($row["nmprodi"]) ?>" />
			</td>
		</tr>
		<tr>
			<td>
				Akreditasi Prodi
			</td>
		<td>
		<input type="radio" name="akreditasi" value="-" <?php if ($row["akreditasi"]=="-" || $row["akreditasi"]=='') { echo "checked=\"checked\""; } else {echo ""; } ?>> -
		<input type="radio" name="akreditasi" value="A" <?php if ($row["akreditasi"]=='A') {echo "checked=\"checked\""; } else {echo "";} ?> > A
		<input type="radio" name="akreditasi" value="B" <?php if ($row["akreditasi"]=='B') {echo "checked=\"checked\""; } else {echo "";} ?> > B
		<input type="radio" name="akreditasi" value="C" <?php if ($row["akreditasi"]=='C') {echo "checked=\"checked\""; } else {echo "";} ?> > C
		</td>
		</tr>
		<tr >
			<td>
				<input class="buttonsimpan" type="submit" name="action" value="Simpan">
				<a class="buttonbatal" href="curd_prodi.php?a=list">Batal</a>
				
			</td>
		</tr>
		
	</table>
	</form>
<?php } ?>

<?php
function hapus_data($id) {
	global $hub;
	$query = "select * from dt_prodi where idprodi = $id";
	$result = mysqli_query($hub, $query);
	$row = mysqli_fetch_array($result); ?>

	<style>
		header {
 		 background-color: #666;
 		 padding: 5px;
 		 text-align: center;
 		 font-size: 20px;
		 color: white;
			}
	table {
   		font-family: sans-serif;
   		color: #444;
     	border-collapse: collapse;
      	width: 100%;
     	border: 1px solid #f2f5f7;
		}
 
	table tr th{
    	background: #35A9DB;
    	color: #fff;
    	font-weight: normal;
	}
 
	table, th, td {
   	 	padding: 20px 40px;
    	text-align: center;
	}
 
	table tr:hover {
    	background-color: #f5f5f5;
	}
 
	table tr:nth-child(even) {
   		background-color: #f2f2f2;
	}
	.tombolbatal{
  		background:#2C97DF;
  		color:white;
  		border-top:0;
 		border-left:0;
  		border-right:0;
  		padding:5px 20px;
  		text-decoration:none;
  		font-family:sans-serif;
  		font-size:11pt;
	}
	.tombolhapus{
  		background:#2C97DF;
  		color:white;
  		border-top:0;
  		border-left:0;
  		border-right:0;
  		padding:5px 20px;
  		text-decoration:none;
  		font-family:sans-serif;
  		font-size:11pt;
	}
	.td2{
		padding: 20px 20px;
    	text-align: center;
	}
	</style>

	<header>
	<h2> Hapus Data Program Studi </h2>
	</header>
	<form action="curd_prodi.php?a=list" method="post">
		<input type="hidden" name="sql" value="delete">
		<input type="hidden" name="idprodi" value="<?php echo trim($id) ?>">
		<table>
			<tr>
				<td>Kode</td>
				<td><?php echo trim($row["kdprodi"]) ?></td>
			</tr>
			<tr>
				<td>Nama Prodi</td>
				<td><?php echo trim($row["nmprodi"]) ?></td>
			</tr>
			<tr>
				<td>Akreditasi</td>
				<td><?php echo trim($row["akreditasi"]) ?></td>
			</tr>
		</table>
		<br>
		<input class ="tombolhapus" type="submit" name="action" value="Hapus">
		<tr>
			<td>
				<a class="tombolbatal" href="curd_prodi.php?a=list">Batal</a>
			</td>
		</tr>
		
	</form>
<?php } ?>

<?php
function create_prodi() {
	global $hub;
	global $_POST;
	$query = "INSERT INTO dt_prodi (kdprodi, nmprodi, akreditasi) VALUES ";
	$query = " (' " .$_POST["kdprodi"]."', '".$_POST["nmprodi"]."','".$_POST["akreditasi"]."')";
	mysqli_query ($hub, $query) or die (mysql_error());
}

function update_prodi() {
	global $hub;
	global $_POST;
	$query = "UPDATE dt_prodi";
	$query .= " SET kdprodi='".$_POST["kdprodi"]."', nmprodi='". $_POST["nmprodi"]."', akreditasi='".$_POST["akreditasi"]."'";
	$query .= " WHERE idprodi = ".$_POST["idprodi"];
	mysqli_query($hub, $query) or die(mysql_error());
}

function delete_prodi() {
	global $hub;
	global $_POST;
	$query = "DELETE FROM dt_prodi";
	$query .= " WHERE idprodi = ".$_POST["idprodi"];
	mysqli_query($hub, $query) or die(mysql_error());
}
?>