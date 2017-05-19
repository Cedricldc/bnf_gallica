<?php
$connect = mysqli_connect("localhost", "root", "root", "spip_cdnl1617");
$menu = "SELECT * FROM marker";

//insertion
$create = mysqli_query($connect, $menu);
if (isset($_POST['creer']))
{
  echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
  $id = ['id'];
  $lat = $_POST ['lat'];
  $lng = $_POST ['lng'];
  $category= $_POST ['category'];
  $annotation= $_POST ['annotation'];
  $requete = "INSERT INTO 'marker' VALUES ('', '$lat', '$lng', '$category', '$annotation')";
  $query = mysqli_query($connect, $requete);
}
mysqli_close($connect);
?>
<!--
    //Modification
    if (isset($_GET['id']))
    {
      $id = $_GET['id'];
    }
    if (isset($_POST['update']))
    {
      $newrubrique = $_POST['newrubrique'];
      $newtexte = $_POST['newtexte'];
      $maj = "UPDATE post SET rubrique='$newrubrique', texte='$newtexte' WHERE id='$id'";
      $uptodate = mysqli_query($connect, $maj);
    }

    //Suppression
    if(!empty($_GET['id']) )
    {
      $idsupp = $_GET['id'];
    }
    if (isset($_POST['del']))
    {
      $supprimer = "DELETE FROM post WHERE id=$idsupp";
      $deleted = mysqli_query($connect, $supprimer);
    }

    //menu
    $affichage = mysqli_query($connect, $menu);
    if(empty($_GET['id']))
    {
      $id = '';
    }else{
            $id = $_GET['id'];
          }
    while($article = mysqli_fetch_array($affichage))
    {
      echo "<a href=update.php?id=", urlencode($article['id']), '><li class=\'nav\'><h3>', $article['rubrique'], "</h3></li></a>";
    }
    ?>

  </div>
</header>

<div id="split">
  <div class="mid sechalf">
    <h2>Créer une nouvelle rubrique</h2>

     <form action="update.php" method="post">
         <p>Rubrique</p>
         <input type="text" name="rubrique" size="50" placeholder="Nouvelle rubrique" required><br>
         <p>Texte</p>
         <textarea name="texte" rows="5" cols="50" placeholder="Votre texte..." required></textarea><br>
         <input name="creer" type="submit" value="Publier">
     </form>

  </div><div class="mid">
    <h2>Modifier / Supprimer une rubrique</h2>


  </div>
</div>
</body>
</html>-->
