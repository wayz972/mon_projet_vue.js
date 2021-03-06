<?php



header('Access-Control-Allow-Origin:http://localhost:8080');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");

include("controllers/ManagerController.php");
//controleur
$userproController = new ControlProfessionnel;
$Controlsalle = new Controlsalle;
$managerController = new ManagerController;
$userController = new ControlClient;
$url = "";

if (isset($_GET['url'])) {
  $url = $_GET['url'];
}
switch ($url) {
  case 'utilisateur':
    $userController->createUser();
    break;
  case 'utilisateurpro':
    $userproController->createUserpro();
    break;

  case 'login':
    $managerController->login();
    break;
  case 'createsalle':

    $Controlsalle->registerSalle();
    break;
  case 'updateuser':
    $userController->updateRegisterUser();
    break;

  case 'update':
    $userproController->updateRegisterUserPro();
    break;
  case 'display':
    
    $Controlsalle->afficherSalle();
    break;
  case 'displaysalleUser':
    $Controlsalle->displaysalleUser();
    break;
  case 'delete':
    $managerController->delete();
    break;
  case 'enregister':
    $userController->updateRegisterUser();
    break;
  case 'addslot':
    $managerController->addslot();
    break;
  case 'slot':
    $managerController->displaySlot();
    break;
  case 'slotDelete':
    $managerController->deleteSlot();
    break;
  case 'zip_code':
    $Controlsalle->zip_code();

    break;
}
