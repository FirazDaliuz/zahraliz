<link rel="stylesheet" type="text/css" href="popup1.css">
<?php
	if (isset($_SESSION['file'])) {
    $file=$_SESSION['file'];
    if (isset($_SESSION['file2'])) {
      $file2=$_SESSION['file2'];
    }
    else{
      $file2=1;
    }
    $dir=$file.".php";
		switch ($file) {
			case 'showcase':
				$title="Produk berjaya dimasukkan dalam <i>cart</i>";
				break;
      case 'about':
        $title="Akaun anda berjaya dikemaskini";
        break;
      case 'cart':
        switch ($file2) {
          case 1:
            $title="Terima kasih, notifikasi tempahan anda akan dihantar kepada anda melalui aplikasi whatapps atau messenger";
            $dir="home.php";
            break;
          case 2:
            $title="Tempahan anda berjaya dibatalkan";
            $dir="home.php";
            break;
          case 3:
            $ID=$_SESSION['ID'];
            $popquery=mysqli_query($conn,"select OrderID, TrackingID from orders where CustomerID='$ID'");
            $title="<table>";
            while ($poparr=mysqli_fetch_array($popquery)) {
              $title=$title."<tr><td>".$poparr[0]."<td>".$poparr[1]."</tr>";
            }
            $title=$title."</table>";
            break;
          default:
            # code...
            break;
        }
        break;
			default:
				$title="Developer Mode";
				break;
		}
    unset($_SESSION['file']);
	}
  elseif (isset($_SESSION['fileerr'])) {
    $file=$_SESSION['file'];
    $fileerr=$_SESSION['fileerr'];
    $dir=$file.".php";
    switch ($fileerr) {
      case 'showcaseerr':
        $title="Produk tidak berjaya dimasukkan dalam <i>cart</i>";
        break;
      case 'abouterr':
        $title="Akaun anda tidak berjaya dikemaskini";
        break;
      case 'carterr':
        $title='Tempahan anda gagal dilaksanakan';
        break;
      case 'carterr2':
        $title="Tempahan anda tidak berjaya dibatalkan";
        break;
      default:
        $title="Developer Mode";
        break;
    }
    unset($_SESSION['file']);
    unset($_SESSION['fileerr']);
  }
	else{
		$title="Testing";
    $dir="index.php";
	}
?>
<div class="popup" id="popup">
  <div class="popup_content" id="popup_content"><span class="close"><a href="<?php echo $dir; ?>">&times;</a></span>
    <div class="popup_title" id="popup_title"><?php echo $title; ?></div>
  <p>&nbsp;</p></div>
</div>
