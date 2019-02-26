<?php

require_once('./database.php');

$db = new Database('postgres', 'Techtastic1206', 'shoelit');

if (array_key_exists('newBrand', $_POST)) {
  if ($db->createBrand($_POST['brandName']))
    echo "Created Brand {$_POST['brandName']}";
}

if (array_key_exists('newModel', $_POST)) {
  if ($db->createModel($_POST['modelName'], $_POST['brandID']))
    echo "Created Model {$_POST['modelName']}";
}

if (array_key_exists('newColorway', $_POST)) {
  if ($db->createColorway($_POST['colorwayName'], $_POST['modelID']))
    echo "Created Colorway {$_POST['colorwayName']}";
}

if (array_key_exists('newShoe', $_POST)) {
  if ($db->createShoe($_POST['brandID'], $_POST['modelID'], $_POST['colorwayID']))
    echo "Created Shoe.";
}

?>

<html>
  <head>
    <title>Shoe Maker</title>
  </head>
  <body>
    <h1>Shoe Making</h1>
    <form action="shoe-maker.php" method="post">
      <div>
        <h3>New Brand</h3>
        <label for="">Brand Name:</label>
        <input type="text" name="brandName">
        <input type="submit" name="newBrand">
      </div>
    </form>

    <form action="shoe-maker.php" method="post">
      <div>
        <h3>New Model</h3>
        <label for="">Model Name:</label>
        <input type="text" name="modelName">
        <select name="brandID">
          <?php
            $brands = $db->fetchAll("SELECT * FROM public.shoe_brand;");
            foreach ($brands as $brand) {
              echo "<option value=\"{$brand['id']}\"";

              if (array_key_exists('brandID', $_POST) && $brand['id'] == $_POST['brandID']) {
                echo " selected=\"selected\"";
              }
              
              echo ">{$brand['name']}</option>";
            }
          ?>
        </select>
        <input type="submit" name="newModel">
      </div>
    </form>

    <form action="shoe-maker.php" method="post">
      <div>
        <h3>New Colorway</h3>
        <label for="">Colorway Name:</label>
        <input type="text" name="colorwayName">
        <select name="modelID">
          <?php
            $models = $db->fetchAll("SELECT * FROM public.shoe_model;");
            foreach ($models as $model) {
              echo "<option value=\"{$model['id']}\"";

              if (array_key_exists('modelID', $_POST) && $model['id'] == $_POST['modelID']) {
                echo " selected=\"selected\"";
              }

              echo ">{$model['name']}</option>";
            }
          ?>
        </select>
        <input type="submit" name="newColorway">
      </div>
    </form>

    <form action="shoe-maker.php" method="post">
      <div>
        <h3>New Shoe</h3>
        <label for="">Shoe Brand:</label>
        <select name="brandID" id="shoeBrand">
          <?php
            $brands = $db->fetchAll("SELECT * FROM public.shoe_brand;");
            foreach ($brands as $brand) {
              echo "<option value=\"{$brand['id']}\"";

              if (array_key_exists('brandID', $_POST) && $brand['id'] == $_POST['brandID']) {
                echo " selected=\"selected\"";
              }
              
              echo ">{$brand['name']}</option>";
            }
          ?>
        </select>
        <label for="">Shoe Model:</label>
        <select name="modelID" disabled id="shoeModel"></select>
        <label for="">Shoe Colorway:</label>
        <select name="colorwayID" disabled id="shoeColorway"></select>
        <input type="submit" name="newShoe">
      </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
      const brand = $('#shoeBrand');
      const model = $('#shoeModel');
      const colorway = $('#shoeColorway');

      $(document).ready(function() {
        // Trigger an initial change on the brand select so that it loads the other selects
        brand.change();
      });
      
      brand.on('change', function(event) {
        $.ajax({
          url: './api.php',
          method: 'post',
          response: 'json',
          data: {
            action: 'getModels',
            brandID: brand.val()
          },
          success: function(response) {
            const models = JSON.parse(response);

            if (Array.isArray(models) && models.length > 0) {
              console.log(models);

              let html = '';
              for (let i=0; i < models.length; i++){
                html += `<option value="${models[i].id}">${models[i].name}</option>`;
              }
              model.html(html);

              model.prop('disabled', false);

              // Trigger a change on the model so that it loads the colorways
              model.change();
            }
          }
        })
      });

      model.on('change', function(event) {
        $.ajax({
          url: './api.php',
          method: 'post',
          response: 'json',
          data: {
            action: 'getColorways',
            modelID: model.val()
          },
          success: function(response) {
            const colorways = JSON.parse(response);
            
            if (Array.isArray(colorways) && colorways.length > 0) {
              console.log(colorways);

              let html = '';
              for (let i=0; i < colorways.length; i++){
                html += `<option value="${colorways[i].id}">${colorways[i].name}</option>`;
              }
              colorway.html(html);

              colorway.prop('disabled', false);
            }
          }
        })
      });
    </script>
  </body>
</html>
