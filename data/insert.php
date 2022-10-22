<?php

$con=mysqli_connect("localhost","root","","shopping");

if($con){

$file=$_FILES['csvfile']['tmp_name'];
$handle=fopen($file,"r");
$i=0;
while(($cont=fgetcsv($handle,1000,","))!==false){
$table=rtrim($_FILES['csvfile']['name'],".csv");
    if($i==0){
     
$name=$cont[0];
$prod_name=$cont[1];
$prod_desc=$cont[2];
$category=$cont[3];
$price=$cont[4];
$sub_category=$cont[5];
$prod_img=$cont[6];

$query="CREATE TABLE $table($name VARCHAR(100),$prod_name VARCHAR(100),$prod_desc VARCHAR(100),$category VARCHAR(100),$price VARCHAR(100),$sub_category VARCHAR(100),$prod_img VARCHAR(100));";

echo $query,"<br>";
mysqli_query($con,$query);
}

else{
  
    $query="INSERT INTO $table($name,$prod_name,$prod_desc,$category,$price,$sub_category,$prod_img) VALUES (`$cont[0]`,`$cont[1]`,`$cont[2]`,`$cont[3]`,`$cont[4]`,`$cont[5]`,`$cont[6]`);";
   echo $query,"<br>";
   mysqli_query($con,$query);

}
$i++;

}

}

else echo"connection failed";

?>