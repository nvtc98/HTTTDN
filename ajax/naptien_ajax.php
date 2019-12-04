<?php
function generateRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
	session_start();
	// $con = mysqli_connect("localhost","root","","sshop");
	$conn = mysqli_connect('localhost','id11774760_admin','admin','id11774760_sshop');
	mysqli_set_charset($con, 'UTF8');
	//Get seri and Code
	$seri=$_POST['seri'];
	$code=$_POST['code'];
	$sql = "Select * from naptien where Seri='$seri'";
	$result = mysqli_fetch_array(mysqli_query($con,$sql));
	if (!isset($result)) echo -1; // Seri does not exist
	else	if ($result['Code']!=$code) echo -2; // Wrong code
			else
			{
				if ($result['Status']=="Expired") echo -3;
				else
				{
					$Value=$result['Value'];
				//Update expired code
					$sqlExCode = "UPDATE `naptien` SET `Status`='Expired' WHERE Seri='$seri'";
					mysqli_query($con,$sqlExCode);
				//Insert new code
					$newSeri=generateRandomString(); $newCode=generateRandomString();
					$sqlCode = "INSERT INTO `naptien`(`Seri`, `Code`, `Value`) VALUES ('$newSeri','$newCode','$Value')";
					mysqli_query($con,$sqlCode);
				//Update customera money
					$Id=$_SESSION['userId'];
					//Get old money
					$sqlOldMoney = "SELECT * FROM `customera`,`usertype` WHERE Cid='$Id' AND customera.UserTypeid=usertype.UserTypeid";
					$Query = mysqli_fetch_array(mysqli_query($con,$sqlOldMoney));
					//Old value
					$OBlance = $Query['Balance']; $OUserType = $Query['UserTypeid']; $OTCharged = $Query['TCharged'];
					//New value
					$NBlance = $OBlance+$Value; $NTCharged = $OTCharged+$Value;
					$NUserType=$Query['Thershold'];
					$sql_UsType="Select * from `usertype`";
					$result_UsType=mysqli_query($con,$sql_UsType);
					while ( $UType_row=mysqli_fetch_array($result_UsType) )
					{
						if ($NTCharged >= $UType_row['Thershold']) {$NUserType=$UType_row['UserTypeid']; break;}
					}
					
					$sqlUpMoney="UPDATE `customera` SET `Balance`='$NBlance',`UserTypeid`='$NUserType',`TCharged`='$NTCharged' WHERE Cid='$Id'";
					mysqli_query($con,$sqlUpMoney);
					echo $NBlance;
				}
			}
	mysqli_close($con);
?>