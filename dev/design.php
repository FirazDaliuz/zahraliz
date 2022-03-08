<?php
 include "../script/temp.php";
 include '../script/db/dbconfig.php';
?>
<html>
<head>
	<title>Design</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="banner">
	<img src="../media/logo.png" id="bannerii">
	<img id="banneri" src="../media/NBANNER.png">
	<img src="../media/logo.png" id="bannerii">
</div>
<div id="nav">
<ul>
	<li><a href="home.php">Home</a></li>
	<li><a href="design.php">Design</a></li>
	<li><a href="order.php">Order</a></li>
	<li><a href="log.php">Log</a></li>
	<li><a href="index.php">Keluar</a></li>
</ul>
</div>
<div id="content">
	<div id="c1">
		<h1>Pengemaskinian Data Pola Pakaian Terbaru</h1>
		<form method="POST">
			<?php
				if (isset($_POST['ucari1'])) {
					$uselect=$_POST['selection'];
					switch ($uselect) {
						case 'Pola Pakaian':
							$query=mysqli_query($conn,"select PatternID, PatternName from pattern");
							break;
						case 'Tips':
							$query=mysqli_query($conn,"select TipsID,TipsName from tips");
							break;
						default:
							# code...
							break;
					}
					echo "$uselect <select name='id'>";
					while ($arr=mysqli_fetch_array($query)) {
					echo "<option value=".$arr[0].">".$arr[1]."</option>";
					}
					echo "</select>
						  <input type='radio' name='uselect' value='$uselect' checked>
					      <input type='submit' name='ucari2' value='Cari'>
					      <input type='submit' name='reset' value='reset'>";
				}
				else
				if (isset($_POST['ucari2'])) {
					$data=$_POST['id'];
					$uselect=$_POST['uselect'];
					switch ($uselect) {
						case 'Pola Pakaian':
							$query=mysqli_query($conn,"select * from pattern where PatternID='$data'");
							while ($arr=mysqli_fetch_array($query)) {
								echo "<div id='usimpan1'>
										<input type='file' id='files' name='PatternImage'><br>
										<input type='radio' name='PatternID' value='".$arr[0]."' checked>".$arr[0]."<br>
										<input type='text' name='PatternName' placeholder='Nama Pattern' value='".$arr[1]."'><br>
										<input type='text' name='PatternPrice' placeholder='Harga' value='".$arr[2]."'><br>
										<input type='text' name='PatternTag' placeholder='#pattern' value='".$arr[4]."'><br>
										<input type='submit' name='usimpan1' value='Simpan'>
										<input type='submit' name='reset' value='Reset'>
									  </div>";
							}
							break;
						case 'Tips':
							$query=mysqli_query($conn,"select * from tips where TipsID='$data'");
							while ($arr=mysqli_fetch_array($query)) {
								$t=$arr[2]." ".$arr[3]." ".$arr[4];
								echo "	<input type='text' name='tipsname' placeholder='Title' value='".$arr[1]."'></input>
										<textarea name='Tips' placeholder='Tips'>$t</textarea>
										<input type='submit' name='usimpan2' value='Simpan'>
										<input type='reset' name='reset' value='Reset' id='usimpan2reset'>";
							}
							break;
						default:
							# code...
							break;
					}
				if (isset($_POST['reset'])) {
						header("HTTP/1.1 303 See Other");
						header("Location:".$_SERVER['PHP_HOST']);
					}
				}
				else
				if (isset($_POST['usimpan1'])) {
					$PatternID=$_POST['PatternID'];
					if (isset($_FILES["PatternImage"])){
						$folder = "resource/";
						move_uploaded_file($_FILES["PatternImage"]["tmp_name"] ,"$folder".$_FILES["PatternImage"]["name"]);
						$datfiles = $folder.$_FILES["PatternImage"]["name"];
					}
					else{
						$query0 = mysqli_query($conn,"select PatternIconDir from pattern where PatternID='$PatternID'");
						while ($arr=mysqli_fetch_array($query0)) {
							$datfiles = $arr[0];
						}
					}
					$NPatternName=$_POST['PatternName'];
					$NPatternPrice=$_POST['PatternPrice'];
					$NPatternTag=$_POST['PatternTag'];
					$query=mysqli_query($conn,"update pattern set PatternName='$NPatternName',PatternPrice='$NPatternPrice',PatternIconDir='".$datfiles."',PatternTag='$NPatternTag' where PatternID='$PatternID' ");
					if ($query) {
						header("Location:design.php");
					}
					else{
						echo mysqli_error($query);
					}
				}
				else
				if(!isset($_POST['ucari1'])){
					echo "
						<div id='search1'>
							<select name='selection'>
								<option value='Pola Pakaian'>Pola Pakaian</option>
								<option value='Tips'>Tips</option>
							</select>
							<input type='submit' name='ucari1' value='Cari'>
						</div>";
					}
				else
					if (isset($_POST['reset'])) {
						header("HTTP/1.1 303 See Other");
						header("Location:".$_SERVER['PHP_HOST']);
				}
			?>
	</form>
	</div>
	<div id="c2">
		<h1>Pengisian Data Pola Pakaian Terbaru</h1>
			<?php
				if (isset($_POST['tcari1'])) {
					$tselect=$_POST['selection'];
					switch ($tselect) {
						case 'Pola Pakaian':
							echo "<form method='POST' enctype='multipart/form-data'>
									<table id='addpakai'>
										<tr id='addpakaitr'>
											<td colspan='2' id='addpakaitd'><input type='file' id='files' name='PatternImage' size='90000' value='Cari' class='inputfile'>
										</tr>
										<tr id='addpakaitr'>
											<td id='addpakaitd'>
											<td id='addpakaitd'><input type='text' name='PatternName' placeholder='Nama Pattern'>
										</tr>
										<tr id='addpakaitr'>
											<td id='addpakaitd'>
											<td id='addpakaitd'><input type='text' name='PatternPrice' placeholder='Harga'>
										</tr>
										<tr id='addpakaitr'>
											<td id='addpakaitd'>
											<td id='addpakaitd'><input type='text' name='PatternTag' placeholder='#pattern'>
										</tr>
										<tr id='addpakaitr'>											
											<td id='addpakaitd'><input type='submit' name='tsimpan1' value='Simpan'>
											<td id='addpakaitd'><input type='submit' name='reset' value='Reset'>
										</tr>
									</table>
								   </form>";
							break;
						case 'Tips':
							echo "<form method='POST'>
									<input type='text' name='tipsname' placeholder='Title'></input>
									<textarea name='Tips' placeholder='Tips' id='tsimpan2textarea'></textarea>
									<input type='submit' name='tsimpan2' value='Simpan'>
									<input type='submit' name='reset' value='Reset' id='tsimpan2reset'>
							      </form>";
							break;
						default:
							# code...
							break;
					}
				}
				else
				if (!isset($_POST['tcari1'])) {
					echo "<form method='POST'>
							<div id='search2'>
								<select name='selection'>
									<option value='Pola Pakaian'>Pola Pakaian</option>
									<option value='Tips'>Tips</option>
								</select>
								<input type='submit' name='tcari1' value='Cari'>
							</div>
						  </form>";
				}
				else
					if (isset($_POST['reset'])) {
						header("HTTP/1.1 303 See Other");
						header("Location:".$_SERVER['PHP_HOST']);
				}
				if (isset($_POST['tsimpan1'])) {
					$query=mysqli_query($conn,"select count(*) from pattern");
					$arr=mysqli_fetch_array($query);
					$row=$arr[0];
					$datrow=$row++;
						if ($row<10) {
							$pid="P00".$datrow;
						}
						else
						if ($row<100) {
							$pid="P0".$datrow;
						}
						else{
							$pid="P".$datrow;
						}
					$pname=$_POST['PatternName'];
					$pprice=$_POST['PatternPrice'];
					$ptag=$_POST['PatternTag'];
					$folder = "../resource/";
					move_uploaded_file($_FILES["PatternImage"]["tmp_name"] ,"$folder".$_FILES["PatternImage"]["name"]);
					$query1=mysqli_query($conn,"INSERT into pattern (PatternID,PatternName,PatternPrice,PatternIconDir,PatternTag)VALUES('$pid','$pname','$pprice','".$folder.$_FILES["PatternImage"]["name"]."','$ptag')");
					if ($query1) {
						echo "Data baru berjaya disimpan";
					}
					else{
						echo "Data baru tidak berjaya disimpan";
					}
				}
				else
				if (isset($_POST['tsimpan2'])) {
					$query=mysqli_query($conn,"select count(*) from tips");
					$arr=mysqli_fetch_array($query);
					$row=$arr[0];
						$datrow=$row+1;
						if ($row<10) {
							$tid="T00".$datrow;
						}
						else
						if ($row<100) {
							$tid="T0".$datrow;
						}
						else{
							$tid="T".$datrow;
						}
					$tipsname=$_POST['tipsname'];
					$tips=$_POST['Tips'];
					for ($i=0; $i < 3; $i++) { 
						switch ($i) {
							case '0':
								$P1=substr($tips, 0,255);
								break;
							case '1':
								$P2=substr($tips, 256,255);
								break;
							case '2':
								$P3=substr($tips, 511,255);
								break;
							default:
								# code...
								break;
						}
					}
					$query1=mysqli_query($conn,"INSERT into tips (TipsID,TipsName,P1,P2,P3) VALUES ('$tid','$tipsname','$P1','$P2','$P3')")or die(mysqli_error($conn));
					if ($query1) {
						echo "Data baru berjaya disimpan";
					}
					else{
						echo "Data baru tidak berjaya disimpan";
					}
				}
			?>
	</div>
</div>
<div id="footer">&copy Copyright by Firdaus bin Razali</div>
</body>
</html>