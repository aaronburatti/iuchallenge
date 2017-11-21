<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <head>
                <link rel="stylesheet" type="text/css" href="../css/style.css" />   
            </head>
            <header>
                <div class="top-strip"></div>
                <div class="brand-bar">
                  <img src="../images/trident-large.png" class="logo" alt="IU Logo large" />
                </div>
                <div class="main-nav">
                  <ul>
                    <li><a href="../index.php">FORM</a></li>
                    <li><a href="../index.php?source=display_db">DISPLAY THE DB</a></li>
                    <li><a href="../index.php?source=dump_db">DUMP THE DB</a></li>
                    <li><a href="../index.php?source=read_feed">THE FEED</a></li>
                  </ul>
                </div>
              </header>
            <body>
                <xsl:for-each select="/degrees/degree">
                    <table>
                      <tr>
                        <th>batchelor</th>
                        <th>doctorate</th>
                        <th>id</th>
                        <th>letter</th>
                        <th>link</th>
                        <th>masters</th>
                        <th>name</th>
                        <th>school</th>
                      </tr>
                      <tr>    
                    <td><xsl:value-of select="@bp" /></td>
                    <td><xsl:value-of select="@dp" /></td>
                    <td><xsl:value-of select="@id" /></td>
                    <td><xsl:value-of select="@letter" /></td>
                    <td><xsl:value-of select="@link" /></td>
                    <td><xsl:value-of select="@mp" /></td>
                    <td><xsl:value-of select="@name" /></td>
                    <td><xsl:value-of select="@school" /></td>
                      </tr>
                    </table>
                </xsl:for-each>  
            </body>
            <footer>
              <div class="promise-box">
                <p>FULFILLING <span>the</span> PROMISE</p>
              </div>
              <img src="../images/trident-small.png" class="logo" alt="IU logo small" />
            </footer>
        </html> 
    </xsl:template>
    
</xsl:stylesheet>
