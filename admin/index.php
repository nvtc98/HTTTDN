<?php
    session_start();
    //$conn = mysqli_connect('fdb19.awardspace.net', '2610203_nckh', 'nvtc0110', '2610203_nckh',3306) or die("Không thể kết nối cơ sở dữ liệu. Hãy chơi khủng long :3");
    $conn = mysqli_connect('localhost', 'root', '', 'sshop')
	// $conn = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop')
    or die("Không thể kết nối cơ sở dữ liệu. Hãy chơi khủng long :3");
    mysqli_set_charset($conn, 'UTF8');
    if(isset($_SESSION['user']))
    {
        // echo '<script>$phuongID='.$_SESSION['phuong'].'</script>';
        $menuID = isset($_GET['menu'])?$_GET['menu']:0;
        // $menu=array("phuong.php","tongquan.php","ddlsvh.php");
		
		$menu=array("landing.php","qlsp.php","qlnd.php");
        $menu=$menu[$menuID];
        include('dashboard.php');
    }
    else
        include('login.php');
    mysqli_close($conn);
?>