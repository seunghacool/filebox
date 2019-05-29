<?php   //filebox.php 

$token=$_COOKIE[sessToken]; 

$uploaddir="/var/www/html/upload/"; 

$up_org=$_FILES[upfile][name]; 

//echo "org: ".$up_org; 

$conn=mysqli_connect('localhost','root','1234', 'toto'); 

if(!$conn){ 

 echo "error: ".mysqli_connect_error(); 

} 

$date=date('Y-m-d h:i:s'); 

$sql="insert into filebox values(NULL,'$up_org',NULL,'$date','$token')"; 

echo "sql=".$sql; 

$result=mysqli_query($conn, $sql); 

if(!$result){ 

 echo "Upload Fail"; 

 exit; 

} 

else { 

 $sql2="select max(f_no) from filebox"; 

 $result2=mysqli_query($conn, $sql2); 

 $record2=mysqli_fetch_row($result2); 

 $max=$record2[0]; 

 $sql3="update filebox set f_tmp='file.$max' where f_no=$max"; 

 echo "sql3=".$sql3; 

 $result3=mysqli_query($conn,$sql3); 

 move_uploaded_file($_FILES[upfile][tmp_name], $uploaddir."file.".$max); 

} 

?> 


<html> 

<head><meta charset="utf-8"></head> 

<body> 

<form method=post action=filebox.php enctype=multipart/form-data> 

업로드할 파일<input type=file name=upfile> 

<input type=submit value="업로드"> 

</form> 

</body> 

</html> 
