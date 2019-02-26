<?php

class Database {
  public $db = null;

  public function __construct($username, $password, $database) {
    // Initialize a connecton to the database
    $this->db = new PDO("pgsql:host=localhost;dbname=$database", $username, $password);
  }

  public function query($sql, $params = array()) {
    // Prepare the sql statement
    $stmt = $this->db->prepare($sql);

    // Bind each of the params
    foreach ($params as $key => $value) {
      // echo "Binding :$key to $value<br/>";
      $stmt->bindValue(":$key", $value);
    }

    return $stmt->execute();
  }

  public function fetch($sql, $params = array()) {
    // Prepare the sql statement
    $stmt = $this->db->prepare($sql);

    // Bind each of the params
    foreach ($params as $key => $value) {
      $stmt->bindValue(":$key", $value);
    }

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function fetchAll($sql, $params = array()) {
    // Prepare the sql statement
    $stmt = $this->db->prepare($sql);

    // Bind each of the params
    foreach ($params as $key => $value) {
      $stmt->bindValue(":$key", $value);
    }

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // ==========================================================================
  // User Methods
  // ==========================================================================
  // Test a username and password for a login
  public function login($username, $password) {
    $res = $this->fetch(
      "SELECT * FROM public.users WHERE user_name=:name",
      array("name" => $username)
    );
  
    if (md5($password) == $res['password']) {
      return true;
    } else {
      return false;
    }
  }

  // Method to register a user with validation
  public function registerUser($username, $password, $password2, $avatar = null) {
    // Verify passwords are good
    if ($password != $password2) {
      echo "Passwords don't match try again.<br/>";
      return false;
    }

    // Check to see if username is taken
    $res = $this->fetch(
      "SELECT * FROM public.users WHERE user_name=:name",
      array("name" => $_POST['username'])
    );

    if ($res != false && count($res) > 0) {
      echo "That username is already taken. Please try again.<br/>";
      return false;
    }

    return $this->query(
      "INSERT INTO public.users(id, user_name, password, avatar) VALUES (DEFAULT, :username, :password, :avatar);",
      array(
        "username" => $username,
        "password" => md5($password),
        "avatar"   => $avatar
      )
    );
  }

  // ==========================================================================
  // Shoe Methods
  // ==========================================================================
  public function createBrand($brandName) {
    $res = $this->fetch(
      "SELECT * FROM public.shoe_brand WHERE name=:name",
      array("name" => $brandName)
    );

    if ($res == false) {
      $res = $this->fetch(
        "INSERT INTO public.shoe_brand(id, name) VALUES (DEFAULT, :brandName) RETURNING id;",
        array('brandName' => $brandName)
      );

      return $res['id'];
    } else {
      echo "Brand name already exists.<br/>";
      return false;
    }
  }

  public function createModel($modelName, $brandID) {
    $brand = $this->fetch(
      "SELECT * FROM public.shoe_brand WHERE id=:id",
      array("id" => $brandID)
    );

    if ($brand == false) {
      echo "Invalid brandID passed to createModel";
      return false;
    }

    $res = $this->fetch(
      "SELECT * FROM public.shoe_model WHERE name=:name",
      array("name" => $modelName)
    );

    if ($res == false) {
      $res = $this->fetch(
        "INSERT INTO public.shoe_model(id, name, brand_id) VALUES (DEFAULT, :modelName, :brandID) RETURNING id;",
        array(
          'modelName' => $modelName,
          'brandID' => $brandID
        )
      );
      
      return $res['id'];
    } else {
      echo "Model name already exists.<br/>";
      return false;
    }
  }

  public function createColorway($colorwayName, $modelID) {
    $model = $this->fetch(
      "SELECT * FROM public.shoe_model WHERE id=:id",
      array("id" => $modelID)
    );

    if ($model == false) {
      echo "Invalid modelID passed to createColorway";
      return false;
    }

    $res = $this->fetch(
      "SELECT * FROM public.shoe_colorway WHERE name=:name",
      array("name" => $colorwayName)
    );

    if ($res == false) {
      $res = $this->fetch(
        "INSERT INTO public.shoe_colorway(id, name, model_id) VALUES (DEFAULT, :colorwayName, :modelID) RETURNING id;",
        array(
          'colorwayName' => $colorwayName,
          'modelID' => $modelID
        )
      );
      
      return $res['id'];
    } else {
      echo "Colorway already exists.<br/>";
      return false;
    }
  }

  public function createShoe($brandID, $modelID, $colorwayID) {
    $res = $this->fetch(
      "SELECT * FROM public.shoe WHERE brand_id = :brandID AND model_id = :modelID AND color_way_id = :colorwayID",
      array(
        "brandID"    => $brandID,
        "modelID"    => $modelID,
        "colorwayID" => $colorwayID
      )
    );

    if ($res == false) {
      $res = $this->fetch(
        "INSERT INTO public.shoe(id, brand_id, model_id, color_way_id) VALUES (DEFAULT, :brandID, :modelID, :colorwayID) RETURNING id;",
        array(
          "brandID"    => $brandID,
          "modelID"    => $modelID,
          "colorwayID" => $colorwayID
        )
      );

      return $res['id'];
    } else {
      // echo "Shoe already exists.<br/>";
      // return false;
      return $res['id'];
    }
  }

  public function createPost($imageURL, $postText, $shoeIDs) {
    $user = $this->fetch(
      "SELECT * FROM public.users WHERE user_name = :username",
      array("username" => $_SESSION['user'])
    );

    if ($user == false) {
      echo "Invalid user logged in somewhow. Searching for user '{$_SESSION['user']}'";
      die();
    }

    $post = $this->fetch(
      "INSERT INTO public.post(id, user_id, post_text, url) VALUES (DEFAULT, :userID, :postText, :imageURL) RETURNING id;",
      array(
        "userID"   => $user['id'],
        "postText" => $postText,
        "imageURL" => $imageURL
      )
    );

    if ($post == false) {
      echo "Something whent wrong inserting the new post.";
      die();
    }

    foreach ($shoeIDs as $shoeID) {
      $res = $this->query(
        "INSERT INTO public.post_shoe_relations(id, post_id, shoe_id) VALUES (DEFAULT, :postID, :shoeID)",
        array(
          "postID" => $post['id'],
          "shoeID" => $shoeID
        )
      );

      if ($res == false) {
        echo "Something went wrong inserting the post-shoe relationship.";
        die();
      }
    }

    return true;
  }

  public function getPostsFiltered($brand = null, $model = null, $colorway = null) {
    $shoes = $this->fetchAll("SELECT * FROM public.shoes WHERE brand_id = :brandID OR model_id = :modelID OR color_way_id = :colorwayID");
    
    // Filters you can put on the $params
    if (array_key_exists('brand', $params) || array_key_exists('model', $params) || array_key_exists('colorway', $params)) {
      // Have empty string defaults
      $brand    = array_key_exists('brand',    $params) ? $params['brand']    : null;
      $model    = array_key_exists('model',    $params) ? $params['model']    : null;
      $colorway = array_key_exists('colorway', $params) ? $params['colorway'] : null;

      $query .= "\nWHERE ";
      $previousStatement = false;

      if ($brand != null) {
        $query .= "";
        $previousStatement = true;
      }

      if ($model != null) {
        $previousStatement = true;
      }

      if ($colorway != null) {
        $previousStatement = true;
      }


    }
  }

  public function getTotalPosts(){
    $res = $this->fetch("SELECT count(*) FROM public.post;");
    return $res['count'];
  }

  public function getPosts($params = array()) {
    $query = <<<SQL
      SELECT
        post.id,
        users.user_name,
        users.avatar,
        post.post_text,
        post.url
      FROM public.post
      LEFT JOIN public.users ON users.id = post.user_id
SQL;

    $query .= "\nORDER BY post.id DESC";

    // Helpers to limit the number of posts loaded
    if (array_key_exists('limit', $params)) {
      $query .= "\nlimit {$params['limit']}";
    }
    if (array_key_exists('offset', $params)) {
      $query .= " offset {$params['offset']}";
    }

    return $this->fetchAll($query);
  }

  public function getShoesFromPost($postID) {
    $query = <<<SQL
      SELECT
        s.id    as shoe_id,
        sb.name as brand,
        sm.name as model,
        sc.name as colorway
      FROM public.post_shoe_relations AS psr
        LEFT JOIN public.shoe          as s  ON s.id = psr.shoe_id
        LEFT JOIN public.shoe_brand    as sb ON sb.id = s.brand_id
        LEFT JOIN public.shoe_model    as sm ON sm.id = s.model_id
        LEFT JOIN public.shoe_colorway as sc ON sc.id = s.color_way_id
      WHERE
        post_id = :postID;
SQL;

    return $this->fetchAll(
      $query,
      array('postID' => $postID)
    );
  }

}



?> 