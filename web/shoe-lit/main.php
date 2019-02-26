<?php

$POSTS_PER_PAGE = 5;

require_once('./helpers.php');
require_once('./database.php');

verifyLoggedIn();

$db = new Database('postgres', 'Techtastic1206', 'shoelit');

$currentPage = array_key_exists('page', $_GET) ? $_GET['page'] : 1;

?>

<html>
  <head>
    <title>ShoeLit - New Post</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css" />
    <style type="text/css">
      body .container {
        margin-top: 25px;
        width: 500px;
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
            <a class="button is-success" href="./new-post.php">
              <strong>New Post</strong>
            </a>
            <a class="button is-light" href="./logout.php">
              Log Out 
            </a>
          </div>
        </div>
      </div>
    </nav>

    <div class="container" style="margin-bottom: 30px;">
      <?php
        $posts = $db->getPosts(array(
          "limit" => $POSTS_PER_PAGE,
          "offset" => ($currentPage * 5) - 5
        ));
        foreach ($posts as $post) {
          $html = <<<HTML
            <div class="container">
              <div class="card">
                <div class="card-image">
                  <figure class="image">
                    <img src="{$post['url']}" alt="Placeholder image">
                  </figure>
                </div>
                <div class="card-content">
                  <div class="media">
                    <div class="media-left">
                      <figure class="image is-48x48">
                        <img src="{$post['avatar']}" alt="Placeholder image">
                      </figure>
                    </div>
                    <div class="media-content">
                      <p class="title is-4" style="padding-top: 10px;">{$post['user_name']}</p>
                    </div>
                  </div>

                  <div class="content">
                    {$post['post_text']}
                    <br>
                    <ul>
HTML;

          $shoes = $db->getShoesFromPost($post['id']);
          foreach ($shoes as $shoe) {
            $html .= "<li id=\"{$shoe['shoe_id']}\">{$shoe['brand']} - {$shoe['model']} - {$shoe['colorway']}</li>";
          }

          $html .= <<<HTML
                  </div>
                </div>
              </div>
            </div>
HTML;
          echo $html;
        }
      ?>
    </div>

    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
      <ul class="pagination-list">
        <?php
          $totalPosts = $db->getTotalPosts();

          if ($totalPosts > $POSTS_PER_PAGE) {
            $pages = ceil($totalPosts / $POSTS_PER_PAGE);

            for ($i=1; $i <= $pages; $i++) { 
              $html  = "<li>";
              $html .= "<a href=\"main.php?page=$i\" class=\"pagination-link";
              
              if ($i == $currentPage) {
                $html .= " is-current";
              }
              
              $html .= "\">$i</a>";
              $html .= "</li>";

              echo $html;
            }
          }
        ?>
      </ul>
    </nav>
  </body>
</html>