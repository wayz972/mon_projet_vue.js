<?php
include("models/Client.php");
include("models/Section.class.php");
include("models/Dater.class.php");
include("models/Creneaux.class.php");
include("models/Attacher.php");
include("models/Professionnel.php");
include("models/Event.class.php");
include("controllers/ControlProfessionnel.php");
include("controllers/Controlsalle.php");
include("controllers/ControlClient.php");


class ManagerController
{




  public function login()
  {



    $_SESSION["message"] = [
      "error" => "Votre identifiant est inconnu ou votre mot de passe est faux. Veuillez réessayer en corrigeant votre saisie",
      "mail" => "pas une adress mail valid"
    ];

    if (empty(!$_POST["email"]) && empty(!$_POST["password"])) {
      if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

        try {
          $showuser = new Client();
          $showuser->setEmail(htmlspecialchars($_POST["email"]));
          $showuser->setPassword(htmlspecialchars($_POST["password"]));
          $user = $showuser->connectUser();
        } catch (Exception $e) {
          die('Erreur : ' . $e->getMessage());
        }

        //je verifie la variable $user 
        if (empty($user)) {

          //connecter l'utilisateur professionnel

          try {
            $showuserPro = new Professionnel();
            $showuserPro->setEmail_professionnel(htmlspecialchars($_POST["email"]));
            $showuserPro->setPassword_professionnel(htmlspecialchars($_POST["password"]));
            $userpro = $showuserPro->connectPro();
          } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
          }
          if (empty($userpro)) {
            echo json_encode($_SESSION["message"]);
          } else {
            echo json_encode($userpro);
          }
        } else {
          echo json_encode($user);
        }
      } else {
        echo json_encode($_SESSION["message"]);
      }
    } else {
      echo json_encode($_SESSION["message"]);
    }
  }





  public function delete()
  {
    if (!empty($_POST["id"]) && !empty($_POST["id_salle"])) {

      $event = new Event();
      $event->setId_professionnel(htmlspecialchars($_POST["id"]));
      $event->setId_salle(htmlspecialchars($_POST["id_salle"]));
      $findEvent=$event->deletesalleWithoutréservation();
      if($findEvent!= null){
        $user = $event->deleteSalle2();

      }else{
        $event->deleteSalle1();

      }

      
    }
  }






  //              PARTI CRENEAUX HORAIRES//



  public function addslot()
  {
    if (empty(!$_POST["id"]) && empty(!$_POST["slot"]) && empty(!$_POST["id_user"])) {
      $slot = new Creneaux();
      $slot->setDatetime_creneaux(htmlspecialchars(strip_tags($_POST["slot"])));
      $slot->date_time();
      $slot = new Event();
      $slot->setId_salle(htmlspecialchars(strip_tags($_POST["id"])));
      $donnee = $slot->findId_Event();
      $slot = new Dater();
      $slot->setId_creneaux(htmlspecialchars($donnee["id_creneaux"]));
      $slot->setId_event(htmlspecialchars($donnee["id_event"]));
      $slot->addDater();
      $slot = new Section();
      $slot->setId_event(htmlspecialchars(strip_tags($donnee["id_event"])));
      $slot->setId_client(htmlspecialchars(strip_tags($_POST["id_user"])));
      $slot->setDatetimeslot(htmlspecialchars(strip_tags($_POST["slot"])));
      $slot->addSection();
    }
  }

  //je recupere les créneaux horaires de l'utilisateur 
  public function displaySlot()
  {

    if (empty(!$_POST["id"])) {
      $slot = new Creneaux();
      $slot->setId_creneaux(htmlspecialchars(strip_tags($_POST["id"])));
      $donnee = $slot->afficherSlot();
      echo json_encode($donnee);
    }
  }

  public function deleteSlot()
  {
   

    if (empty(!$_POST["id"]) && empty(!$_POST['id_user'])&& empty(!$_POST["creneaux"])) {
      $slot = new Creneaux();
      $slot->setId_creneaux(htmlspecialchars(strip_tags($_POST["id"])));
      
       $slot->DeleteSlot();
       $slot= new Section();
       $slot->setId_client(htmlspecialchars(strip_tags($_POST['id_user'])));
       $slot->setDatetimeslot(htmlspecialchars(strip_tags($_POST['creneaux'])));
       $slot->deleteSlot_idUser();
    }
  }


}
