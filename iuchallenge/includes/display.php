<h3>Display the Table</h3>
<p>These button will list everything in the database. The "HTML" button will
 display the information in HTML format. The "XML" button will display the database table
  as an XML feed. The user ID field is an autoincrementing Primary Key and can be used
  in conjunction with the <a href="index.php?source=read_feed">READ,</a> <a href="index.php?source=main">FORM,</a>
   and <a href="index.php?source=dump_db">DUMP</a>
  pages to monitor DB changes. However, the dump page uses a truncate function so the autoincrementor will be reset
 each time it is used.</p>



  <a class="submit" href="index.php?source=display_db&html">HTML</a>
  <a class="submit" href="index.php?source=display_db&xml">XML</a>

<?php html_display() ?>
<?php xml_display()  ?>
