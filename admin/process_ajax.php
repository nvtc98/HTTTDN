<?php
	//session_start();
	$conn=mysqli_connect("localhost", "root", "", "nckh") or die ("Không thể kết nối cơ sở dữ liệu. Hãy chơi khủng long :3");
	mysqli_set_charset($conn, 'UTF8');
	$processID=$_POST['processID'];
    if($processID==1)
    {
        $tenPhuong=$_POST['tenPhuong'];
        $IDP=$_POST['IDPhuong'];
        $query = mysqli_query($conn, "update phuong set TenPhuong = '$tenPhuong' where ID = $IDP");
    };
    if($processID==2)
    {
        if (isset($_POST) && !empty($_FILES['file']))
        {
            $duoi = explode('.', $_FILES['file']['name']); // tách chuỗi khi gặp dấu .
            $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
            // Kiểm tra xem có phải file ảnh không
            if ($duoi === 'jpg' || $duoi === 'png' || $duoi === 'gif')
            {
                // tiến hành upload
                if (move_uploaded_file($_FILES['file']['tmp_name'], '../images/' . $_FILES['file']['name']))
                {
                // Nếu thành công
                    die('Upload thành công file: ' . $_FILES['file']['name']); //in ra thông báo + tên file
                }
                else die('Có lỗi!');
            }
            else { // nếu không phải file ảnh
                die('Chỉ được upload ảnh'); // in ra thông báo
            }
        }
        else {
        die('Lock'); // nếu không phải post method
        }
    };
	mysqli_close($conn);
?>