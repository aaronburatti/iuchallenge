<?php include "degrees.php" ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Lato|Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Degree List</title>
  </head>
  <header>
    <div class="top-strip"></div><!--for the small band of color to support logo colors-->
    <div class="nav">
      <img src="images/trident-large.png" class="logo" alt="IU Logo large">
    </div>
  </header>
  <body>
    <div class="main-wrap">
      <h1>Please Enter Your Degree Infromation</h1>
      <form class="degree-form" action="degrees.php" method="post">

        <div class="form-field">
          <label for="bp">Batchelor's Program</label>
            <input type="text" name="bp" id="bp" value="">
        </div>

        <div class="form-field">
          <label for="dp">Doctorate Program</label>
            <input type="text" name="dp" id="dp" value="">
        </div>

        <!-- Hidden, hashed form element for identification purposes-->
            <input type="hidden" name="id" id="token" value="<?php echo token_generator() ?>">

        <!--Hidden. First letter of program name-->
            <input type="hidden" name="letter" id="letter" value="">

        <div class="form-field">
          <label for="link">Link*</label>
            <input type="text" name="link" id="link" value="">
        </div>

        <div class="form-field">
          <label for="mp">Master's Program</label>
            <input type="text" name="mp" id="mp" value="">
        </div>

        <div class="form-field">
          <label for="name">Name of Degree</label>
            <input type="text" name="name" id="name" value="">
        </div>

        <div class="form-field">
          <label for="school">School</label>
            <input type="text" name="school" id="school" value="">
        </div>
        <input id="submit" type="submit" name="submit" value="submit">
      </form>
    </div>
  </body>
  <footer>
    <div class="promise-box">
      <p>FULFILLING <span>the</span> PROMISE</p>
    </div>
    <img src="images/trident-small.png" class="logo" alt="IU logo small">
  </footer>


</html>
