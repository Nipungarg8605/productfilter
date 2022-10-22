<?php


require 'config.php';
require 'index.php';
if(isset($_POST['action'])){
$sql="SELECT * FROM products WHERE category!=''";

if(isset($_POST['category'])){
    $category = implode("','",$_POST['category']);
    $sql .= "AND category IN(`$category`)";

}

if(isset($_POST['sub_category'])){
    $sub_category = implode("','",$_POST['sub_category']);
    $sql .= "AND sub_category IN(`$sub_category`)";

}


$result=$conn->query($sql);
$output='';

if($result->num_rows>0){
    while($row=$result->fetch_asssoc()){
        $output .= '   <div class="col-md-3 mb-2">
        <div class="card-deck">
           <div class="card border-secondary">
            <img src="images/img1.jpg"
             class="card-img-top" >
    
           <div class="card-img-overlay">
            <h6 style="margin-top:175px;"
            class="text-light bg-info text-center rounded p-1" >
            '.$row['prod_name'].'
            <br>
            '.$row['category'].'
            '.$row['sub_category'] .'
    
            </h6>
            
            
    
           
    
           </div>
           
          
        </div>
    
        </div>
    </div>';
    }
}

else{
    $output="<h3> no product found</h3>";
    
}
echo $output;
}

?>