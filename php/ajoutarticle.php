<?php require_once('header.php'); ?>
<body>
  <?php
    if (isset($_SESSION['alert'])){
      echo "<div class='alert alert-danger' role='alert'>$_SESSION[alert]</div>";
    }
    unset($_SESSION['alert']);
     if (isset($_SESSION["droits"]) AND  $_SESSION["droits"]==1){
  ?>
  <center>
    <br>
    <label>Ajouter un article</label> <!-- formulaire pour ajouter un article --> 
    <br><br> 
    <form action='insertion_article.php' class="table" method="POST">
      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" name="nom" id="nom"  placeholder="Entrez le nom de l'article" >
      </div>
      <div class="form-group">
        <label for="reference">Reference</label>
        <input type="text" class="form-control" name="reference" id="reference"  placeholder="Entrez la référence" >
      </div>
      <div class="form-group">
        <label for="prix">Prix</label>
        <input type="text" class="form-control" name="prix" id="prix" placeholder="Entrez le prix" >
      </div>
      <div class="form-group">
        <label for="taxe">Taxe</label>
        <input type="text" class="form-control" name="taxe" id="taxe" placeholder="Entrez la taxe (20 de base)" value=20 >
      </div>
      <div class="form-group">
        <label for="promotion">promotion</label>
        <input type="text" class="form-control" name="promotion" id="promotion" placeholder="Entrez la promotion (si il y en a une)">
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="nouv" id="nouv">
        <label class="form-check-label" for="nouv">Nouveauté ?</label>
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
  </center>
  <?php ;} else { echo "<div class='presentation'><h2> Vous n'avez pas le droit d'être sur cette page</h2></div>";}?>
</body>