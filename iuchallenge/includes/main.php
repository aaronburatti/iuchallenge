<h3>Please Enter Your Degree Infromation</h3>
<p>This page is a standard submit form. It is designed for user generated input.
You will be redirected to the <a href="index.php?source=display_db">DISPLAY</a> page.
Check for your input there.</p>

  <form class="degree-form" action="includes/functions.php" method="post">

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
        <label for="link">Link</label>
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
    <input class="submit" type="submit" name="submit" value="submit">
  </form>
