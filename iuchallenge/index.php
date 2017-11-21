<?php include "includes/header.php" ?>
  <body>
    <div class="main-wrap">
      <?php
    
    /* check for the source attribute in the URL*/
          if(isset($_GET['source'])) {

            $source = $_GET['source'];
          } else {
            $source = '';
          }
    /*creates the basis for the SPA experience. Below are the different pages, each with its own function*/
          switch ($source) {
            case 'display_db';
              include 'includes/display.php';
            break;

            case 'dump_db';
              include 'includes/dump.php';
              break;

            case 'read_feed';
              include 'includes/read.php';
              break;

            default: 'main';
              include "includes/main.php";
              break;

          }
           ?>
    </div>
  </body>
<?php include "includes/footer.php" ?>
