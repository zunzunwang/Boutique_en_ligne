<?php
 include("Link.php"); 
  $affiche_query="SELECT * FROM `ForumList` order by lastdate desc";
  $affiche_query=mysql_query($affiche_query);
  while($row=mysql_fetch_array($affiche_query)){
?>


<table border="1" width="500">
  <tr bgcolor="#eff3ff">
  <td>TITLE:<?php echo $row[title];?> USER:<?php echo $row[uid];?> TIME:<?php echo $row[lastdate];?></td>
  </tr>
  <tr bgColor="#ffffff">
  <td>content:<?php
 echo htmtocode($row[content]);
   ?></td>
  </tr>
</table>
<?php
  }
?>
