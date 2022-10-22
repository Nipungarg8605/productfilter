<?php require 'config.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product filter</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h3 class="text-center text-light bg-info p-2">
    Product filter 
</h3>
<div class="container-fluid">

<div class="row">
<div class="col-lg-3">

<h5>Your Filter</h5>
<hr>

<div class="list-group">
    <h5 style="Color: rgba(41, 130, 255, 1);" >Price</h5>
    <input type="hidden" id="hidden_minimum_price" value="0"/>
 <input type="hidden" id="hidden_maximum_price" value="65000"/>

<p id="price_show">1000-65000</p>
<div id="price_range"></div>
</div>

<br>
<h6 class="text-info">Select Catogery</h6>
<ul class="list-group">

<?php
$sql="SELECT DISTINCT category FROM products ";
$result=$conn->query($sql);
while($row=$result->fetch_assoc()){




?>




<li class="list-group-item">
    

<div class="form-check">
        <label  class="form-check-label">
            <input type="checkbox" class="form-check-input product_check" value=" <?=
            
            $row['category'];?>"  id="category"><?=$row['category'];?>
        </label>
</div>
</li>
<?php } ?>
</ul>
<br>
<br>
<h6 class="text-info">Select subCatogery</h6>
<ul class="list-group">

<?php
$sql="SELECT DISTINCT sub_category FROM products ";
$result=$conn->query($sql);
while($row=$result->fetch_assoc()){




?>

<li class="list-group-item">
<div class="form-check">
        <label  class="form-check-label">
            <input type="checkbox" class="form-check-input product_check"  value="<?=
            
            $row['sub_category'];?>" id="sub_category">   <?=$row['sub_category'];?>
        </label>
</div>
</li>
<?php } ?>
</ul>


</div>

<div class="col-lg-9">

<h5 class="text-center" id="textChange">
    ALL PRODUCTS
</h5>
<hr>

<div class="text-center">
    <img src="images/loader.gif" id="loader"
    width="200" style="display:none;">
</div>
<div class="row" id="result">
<?php
$sql="SELECT * FROM products";
$result=$conn->query($sql);
while($row=$result->fetch_assoc()){


?>

<div class="col-md-3 mb-2">
    <div class="card-deck">
       <div class="card border-secondary">
        <img src="images/img1.jpg"
         class="card-img-top" >

       <div class="card-img-overlay">
        <h6 style="margin-top:175px;"
        class="text-light bg-info text-center rounded p-1" >
        <?=$row['prod_name'] ;?>
        <br>
        <?=$row['category'] ;?>
        <?=$row['sub_category'] ;?>

        </h6>
        
        

       

       </div>
       
      
    </div>

    </div>
</div>

<?php } ?>

</div>
</div>

</div>
</div>






<script type="text/javascript">

  
$(document).ready(function(){
    $(".product_check").click(function(){
     $("#loader").show();
     

     var action='data';
     var category =get_filter_text('category');
     var sub_category =get_filter_text('sub_category');
     
    
     $.ajax({

       
     method:'POST',
     url:'action.php',
     data:{action:action,category:category,sub_category:sub_category},
     success:function(response){
          $('#result').html(response);
          $('#loader').hide();
          $('#textChange').text("Filtered Products");
     }
    });
    
    
    });

 function get_filter_text(text_id){
    var filterData=[];
    $('#'+text_id+':checked').each(function(){
          filterData.push($(this).val());
    });
return filterData;
}
});



</script>


</body>
</html>