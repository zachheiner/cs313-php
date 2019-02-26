<?php

require_once('./database.php');

// $db = new Database('postgres', 'Techtastic1206', 'shoelit');
$db = new Database();

?>

<html>
  <head>
    <title>ShoeLit - New Post</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css" />
    <style>
      .shoe-list .message {
        margin: 5;
      }

      .shoe-list .message .message-header {
        border-radius: 5px;
      }
    </style>
  </head>
  <body>
    <nav class="navbar is-link" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <a class="navbar-item">
          ShoeLit
        </a>
      </div>
      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <a class="button is-danger" href="./main.php">
              <strong>Cancel Post</strong>
            </a>
            <a class="button is-light" href="./logout.php">
              Log Out 
            </a>
          </div>
        </div>
      </div>
    </nav>

    <div class="container" style="width: 500px; margin-top: 20px;">
      <h1 class="is-size-3">New Post</h1>
      <button id="submitPost" style="float: right; margin-top: -35px; " class="button is-success">Submit Post</button>
      <div class="field">
        <label class="label">Image</label>
        <div class="control">
          <input class="input" type="text" placeholder="URL" id="image-url">
        </div>
      </div>
      <div class="field">
        <label class="label">Message</label>
        <div class="control">
          <textarea class="textarea" placeholder="Sweet sweet shoes!" id="post-comment"></textarea>
        </div>
      </div>

      <label class="label" style="flex: 1 1 auto;">Shoes</label>
      <div class="field has-addons has-addons-centered">
        <p class="control">
          <span class="select">
            <select id="shoeBrand">
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
          </span>
        </p>
        <p class="control">
          <span class="select">
            <select id="shoeModel" disabled>
            </select>
          </span>
        </p>
        <p class="control">
          <span class="select">
            <select id="shoeColorway" disabled>
            </select>
          </span>
        </p>
        <p class="control">
          <a class="button is-primary" id="addShoe">
            Add Shoe
          </a>
        </p>
      </div>

      <div class="shoe-list" id="shoeList">
        <!-- Will be populated with javascript -->
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
      const brand = $('#shoeBrand');
      const model = $('#shoeModel');
      const colorway = $('#shoeColorway');
      const shoeList = $('#shoeList');

      $(document).ready(function() {
        // Trigger an initial change on the brand select so that it loads the other selects
        brand.change();
        rebuildShoeHTML();
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

      let shoes = [];

      const removeShoe = function(index) {
        shoes.splice(index, 1);
        rebuildShoeHTML();
      }

      const rebuildShoeHTML = function () {
        let html = "";

        shoes.forEach(function(shoe, index) {
          html += `
            <article class="message is-info">
              <div class="message-header">
                <p>
                  <span id="${shoe.brand.id}">${shoe.brand.name}</span> -
                  <span id="${shoe.model.id}">${shoe.model.name}</span> -
                  <span id="${shoe.colorway.id}">${shoe.colorway.name}</span>
                </p>
                <button class="delete" aria-label="delete" onclick="removeShoe(${index});"></button>
              </div>
            </article>`;
        });

        shoeList.html(html);
      }

      $('#addShoe').on('click', function() {
        shoes.push({
          brand: {
            id  : brand.val(),
            name: brand.children("option").filter(":selected").text()
          },
          model: {
            id  : model.val(),
            name: model.children("option").filter(":selected").text()
          },
          colorway: {
            id  : colorway.val(),
            name: colorway.children("option").filter(":selected").text()
          },
        });

        rebuildShoeHTML();
      });

      $('#submitPost').on('click', function() {
        $.ajax({
          method: 'post',
          url: './api.php',
          response: 'json',
          data: {
            action : 'createPost',
            url    : $('#image-url').val(),
            comment: $('#post-comment').val(),
            shoes  : shoes
          },
          success: function(response) {
            window.location.href = "./main.php";
          }
        });
      });
    </script>
  </body>
</html>
