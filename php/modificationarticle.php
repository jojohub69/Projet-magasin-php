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
  <br><br>
    <label>Sélectionnez un article à modifier</label>
  <br>
  <form class="tablemod" method="POST">
    <select name="select" class="form-select" aria-label="Default select example">
      <option selected>Articles </option>
      <?php
       $data = $conn->query("SELECT * FROM articles")->fetchAll();
       foreach ($data as $row) 
       {
         echo "<option value=$row[id]> $row[nom] </option>";
       }
      ?>
    </select>
    <br><br><button type="submit" class="btn btn-primary">Selectionner</button>
  </form>
  <?php 

/* Récuperer données de l'article selectionné pour l'intégrer dans le formulaire */
  if (isset($_POST['select'])) 
  { 
    $idactuelle = $_POST['select'];
    $stmt = $conn->prepare("SELECT * FROM articles WHERE id=:id");
    $stmt->execute(['id' => $idactuelle]); 
    $user = $stmt->fetch();
    
    $nom = $user['nom'];
    $reference = $user['reference'];
    $prix = $user ['prix_ht'];
    $taxe = $user['taxe'];
    $promo = $user["promotion"];
    $nouv = $user['nouveaute'];
  }
  else 
  {
    $nom = "";
    $reference = "";
    $prix = "";
    $taxe = "";
    $promo = "";
    $nouv = "";
  }

  if ($nom != ""){
  ?>

    <br><br>
    <label>Modifier l'article</label>  
    <br><br>
    <form action='insermodif_article.php' class="table" method="POST">
    <div class="form-group">
        <input type="text" class="form-control" name="id" id="id"   value="<?php echo $idactuelle ?>" readonly="readonly" hidden required> 
      </div>
      <div class="form-group">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" name="nom" id="nom"  placeholder="Entrez le nom de l'article" value="<?php echo $nom ?>" required> 
      </div>
      <div class="form-group">
        <label for="reference">Reference</label>
        <input type="text" class="form-control" name="reference" id="reference"  placeholder="Entrez la référence" value="<?php echo $reference ?>" required>
      </div>
      <div class="form-group">
        <label for="prix">Prix</label>
        <input type="text" class="form-control" name="prix" id="prix" placeholder="Entrez le prix" value="<?php echo $prix ?>" required>
      </div>
      <div class="form-group">
        <label for="taxe">Taxe</label>
        <input type="text" class="form-control" name="taxe" id="taxe" placeholder="Entrez la taxe (20 de base)" value="<?php echo $taxe ?>"  required>
      </div>
      <div class="form-group">
        <label for="promotion">promotion</label>
        <input type="text" class="form-control" name="promotion" id="promotion" placeholder="Entrez la valeur de la promotion en %" value="<?php echo $promo ?>" >
      </div>
      <div class="form-check">
        <input type="checkbox" class="form-check-input" name="nouv" id="nouv" <?php echo ($nouv==1 ? 'checked' : '') ?>>
        <label class="form-check-label" for="nouv">Nouveauté ?</label>
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
    <?php } ?>
    <?php ;} else { echo "<div class='presentation'><h2> Vous n'avez pas le droit d'être sur cette page</h2></div>";}?>
  </center>
</body>