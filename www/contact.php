<?php
  define('LANSEN_ROOT', '../src/');
  #define('LANSEN_ROOT', '/home/lansen/src/');
  
  include LANSEN_ROOT . 'm.php';
  include LANSEN_ROOT . 'v.php';

$handle = fopen('/tmp/contact.log', 'a');

// Check if the file was successfully opened
if ($handle) {
    // Data to append
    $data = $_SERVER['REQUEST_METHOD'] . " " . join(",", $_POST);

    // Write data to the file
    fwrite($handle, $data);

    // Close the file
    fclose($handle);

}

$view = new View();
try{
  $model = new Model();
} catch (mysqli_sql_exception $e){
  $view->set_error("Connection Error. " . $e->getMessage());
  $view->set_server_problem(true);
  $view->emit();
  exit;
} catch (Exception $e) {
  $view->set_error("Model Error: " . $e);
  $view->emit();
  exit;
}

$method = $_SERVER['REQUEST_METHOD'];

try{
  $input = $view->get_input();
} catch (Exception $e) {
  $view->set_error("Input Error. " . $e);
  $view->emit();
  exit;
}



switch ($method) {
  case 'GET':
    $view->set_error("Unsupported");
    break;

  case 'POST':
    try{
      $result = $model->add_contact($input);
      $view->set_value($result);
    } catch (Exception $e) {
      $view->set_error("Error Saving. " . $e);
    }
    break;

  case 'PUT':
    $view->set_error("Unsupported");
    break;

  case 'DELETE':
    $view->set_error("Unsupported");
    break;

  default:
    $view->set_error("Unsupported");
    break;
}

$view->emit();
  
?>