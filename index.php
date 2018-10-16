<?php

use App\model\DB;


require_once 'vendor/autoload.php';
$DB = new DB;
$Brands = $DB->getBrands();

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Website</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

 
  </head>

  <body>

    <header>
     
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center">
           
            <strong>Website</strong>
          </a>
       
        </div>
      </div>
    </header>

    <main role="main">
    <section class="jumbotron text-center">
        <div class="container">
          <!-- <h3 class="jumbotron-heading">Select Brand</h3> -->
          <div class="col-md-4 offset-md-4">
          <form id="form">

          <div class="form-group">
            <label for="exampleFormControlSelect1">Brand</label>
            <?php 
              if(!empty($Brands)){
            ?>
            <select class="form-control" id="brand">
            <option value="">Select Brand</option>
            <?php 
              foreach($Brands as $Brand){
            ?>
                <option value="<?php echo $Brand['ID'];?>"><?php echo $Brand['brandName'];?></option>
            <?php    
              }
            ?>
            </select>
            <?php }?>
          </div>
          <div class="form-group" id="brand_section">
            <label for="exampleFormControlSelect1">Brand</label>
            <select class="form-control" id="model">
              
            </select>
           </div>  

          </form>
          </div>
            

        </div>

        <div class="form-group">
              <textarea rows="3" cols="25" id="selected_model"></textarea>
        </div>
        <div id="res_image">
        
        </div>
      </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="app/js/script.js" type="text/javascript"></script>
    </body>
    </html>