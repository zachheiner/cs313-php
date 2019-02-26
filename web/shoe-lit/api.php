<?php

require_once('helpers.php');
require_once('database.php');

// Make sure that we're logged in before we have access to any API
verifyLoggedIn();

class API {
  private $args = array();

  public function __construct($args) {
    // Load the database
    $this->db = new Database('postgres', 'Techtastic1206', 'shoelit');

    // Save the args
    $this->args = $args;

    // Check to see if there is an action
    if (!array_key_exists('action', $this->args)) {
      echo "Must pass an action to the API.";
      die();
    }

    // Check to make sure the method exists in the API
    if (!method_exists($this, $args['action'])) {
      echo "Invalid action passed to API. Action passed: {$this->args['action']}";
      die();
    }

    // Call the method because it exists
    $this->{$this->args['action']}();
  }

  // Pass any number of strings to verify that they exist in the args
  private function checkArgs() {
    $keys = func_get_args();
    foreach ($keys as $key) {
      if (!array_key_exists($key, $this->args)) {
        echo "Missing argument. The action '{$this->args['action']}' requires that you pass in a value for '$key'!";
        die();
      }
    }
  }

  public function createPost() {
    $this->checkArgs('url', 'comment', 'shoes');

    if (!is_array($this->args['shoes'])) {
      echo "createPost expected shoes to be an array.";
      die();
    }

    $shoeIDs = array();

    foreach ($this->args['shoes'] as $shoe) {
      $id = $this->db->createShoe($shoe['brand']['id'], $shoe['model']['id'], $shoe['colorway']['id']);
      array_push($shoeIDs, $id);
    }

    $this->db->createPost($this->args['url'], $this->args['comment'], $shoeIDs);
  }

  public function getModels() {
    $this->checkArgs('brandID');

    $res = $this->db->fetchAll(
      "SELECT * FROM public.shoe_model WHERE brand_id = :id;",
      array('id' => $this->args['brandID'])
    );

    echo json_encode($res);
  }

  public function getColorways() {
    $this->checkArgs('modelID');

    $res = $this->db->fetchAll(
      "SELECT * FROM public.shoe_colorway WHERE model_id = :id;",
      array('id' => $this->args['modelID'])
    );

    echo json_encode($res);
  }


}

$args = array_merge($_GET, $_POST);

# Get json input as an object - https://davidwalsh.name/php-json
$json = json_decode(file_get_contents('php://input'));
if ($json != null)
  $args = array_merge($args, $json);

// Initialize the API object and merge together all the argument sources
$API = new API($args);

?>