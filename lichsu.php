<?php 
    session_start();
    $con = mysqli_connect("localhost","root","","sshop");
    // $con = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop');
	mysqli_set_charset($con, 'UTF8');
?>
<!doctype html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 90%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<meta charset="utf-8">
<link href="CSS/basic.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="CSS/signup.css">
<link href="CSS/product.css" rel="stylesheet" type="text/css" />
<link href="CSS/contact-intro.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="IMG/favicon.png" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lịch sử mua hàng</title>

</head>
<script language="javascript" src="JS/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="JS/sang-script.js"></script>
<script type="text/javascript" src="JS/showing-paging.js"></script>
<body>
	<?php include("leftmenu.php") ?>
    <div class="push-wrap" style="background-color:#eee; height: 110%" align="center">
        <?php
            include("header.php");
        ?>
    	<div class="mutual-bigtitle" style="font-size:30px">
            Lịch sử mua hàng
        </div>
        <hr style="width: 90%">
        <div class="mutual-content" style="margin-left: 150px; margin-bottom: 20px; height: 1000px;"> 
        <!-- <div class="mutual-normaltitle">
        		&#9824; liên hệ hỗ trợ trực tuyến &#9824;
        </div> 
        <div class="mutual-content" style="margin-left: 350px; margin-right:300px; margin-bottom: 20px;">
        	<p> <span style="font-weight: bold"> HOTLINE: </span> 0169 696 6969 </p>
            <p> <span style="font-weight: bold"> MAIL: </span> sangshop69@gmail.com </p>
            <p> <span style="font-weight: bold"> FACEBOOK: </span> facebook.com/sang.shop </p>
            <p> Nếu liên hệ qua HOTLINE, bạn sẽ nhận được phản hồi ngay lập tức (nếu quản trị viên có mặt tại văn phòng làm việc). Nếu gửi qua MAIL và FACEBOOK thì các admin sẽ cố gắng trả lời hỗ trợ của bạn sớm nhất có thể (thường thì là trong vòng 1 ngày)
        </div> -->
        <?php
            $query = "SELECT * from orders where Cid=" . $_SESSION['userId'];

            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0)
            {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
                {
                    echo '<div style="float:left; margin-left: 50px; margin-right: 300px;"><p style="font-weight:bold; font-size: 20px">Hóa đơn số: '. $row['Oid'] .'</p>';
                    echo '<p style="font-size: 16px">Thời điểm mua: '. $row['Odate'] .'</p>';
                    echo '<p style="font-size: 16px">Thành tiền: '. $row['Oid'] .'</p>';
                    echo '</div>';
                }
            }
            else echo "Không có hóa đơn nào.";
        ?>
        <table>
  <tr>
    <th>Company</th>
    <th>Contact</th>
    <th>Country</th>
  </tr>
  <tr>
    <td>Alfreds Futterkiste</td>
    <td>Maria Anders</td>
    <td>Germany</td>
  </tr>
  <tr>
    <td>Centro comercial Moctezuma</td>
    <td>Francisco Chang</td>
    <td>Mexico</td>
  </tr>
  <tr>
    <td>Ernst Handel</td>
    <td>Roland Mendel</td>
    <td>Austria</td>
  </tr>
  <tr>
    <td>Island Trading</td>
    <td>Helen Bennett</td>
    <td>UK</td>
  </tr>
  <tr>
    <td>Laughing Bacchus Winecellars</td>
    <td>Yoshi Tannamuri</td>
    <td>Canada</td>
  </tr>
  <tr>
    <td>Magazzini Alimentari Riuniti</td>
    <td>Giovanni Rovelli</td>
    <td>Italy</td>
  </tr>
</table>
        </div>
        <hr style="width: 90%">
        <div class="mutual-normaltitle">
        		&#9824; liên hệ trực tiếp từng quản trị viên &#9824;
        </div> 
        <div class="mutual-content" style="margin-left: 150px; margin-bottom: 20px; height: 1000px;">  
        	<div style="margin-top: 30px">
                <div style="float:left"> <img src="IMG/contact/sniper.png"> </div>
                <div style="float:left; margin-left: 50px; margin-right: 300px;">
                    <p style="font-weight:bold; font-size: 24px"> LÊ ĐỨC HUY </p>
                    <p> <span style="font-weight: bold"> Số đt: </span> 0122 460 3639 </p>
                    <p> <span style="font-weight: bold"> Mail: </span> admiralnaruki1998@gmail.com </p>
                    <p> <span style="font-weight: bold"> Facebook: </span> fb.com/suzuki.huy </p>   
                </div> 
            </div> 
            <hr style="width: 40%">
        	<div style="margin-top: 30px">
                <div style="float:left"> <img src="IMG/contact/engineer.png"> </div>
                <div style="float:left; margin-left: 100px; margin-right: 300px;">
                    <p style="font-weight:bold; font-size: 24px"> NGUYỄN VĨNH THANH CHƯƠNG </p>
                    <p> <span style="font-weight: bold"> Số đt: </span> 0124 362 3524 </p>
                    <p> <span style="font-weight: bold"> Mail: </span> nvtc.98@gmail.com </p>
                    <p> <span style="font-weight: bold"> Facebook: </span> fb.com/chuong.thanh.98 </p>   
                </div> 
            </div>  
            <hr style="width: 40%">    
        	<div style="margin-top: 30px">
                <div style="float:left"> <img src="IMG/contact/rifle.png"> </div>
                <div style="float:left; margin-left: 100px; margin-right: 300px;">
                    <p style="font-weight:bold; font-size: 24px"> ĐÀO HOÀN VŨ </p>
                    <p> <span style="font-weight: bold"> Số đt: </span> 0123 456 7890 </p>
                    <p> <span style="font-weight: bold"> Mail: </span> yuiastin@gmail.com </p>
                    <p> <span style="font-weight: bold"> Facebook: </span> fb.com/yashiro12 </p>   
                </div> 
            </div>   
            <hr style="width: 40%">        
        	<div style="margin-top: 30px">
                <div style="float:left"> <img src="IMG/contact/medic.png"> </div>
                <div style="float:left; margin-left: 50px; margin-right: 300px;">
                    <p style="font-weight:bold; font-size: 24px"> VÕ TRỌNG TRUNG </p>
                    <p> <span style="font-weight: bold"> Số đt: </span> 0908 076 543 </p>
                    <p> <span style="font-weight: bold"> Mail: </span> votrungtrung@gmail.com </p>
                    <p> <span style="font-weight: bold"> Facebook: </span> fb.com/profile.php?id=100009365010067 </p>   
                </div> 
            </div>           
		</div>            
    </div>        
	<?php
		include("back-to-top.php");
        include("footer.php");
        mysqli_close($con);
    ?>
</body>
</html>