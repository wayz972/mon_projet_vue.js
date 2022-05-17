<?php


include("models/salle.php");

class Controlsalle
{

  public function registerSalle()
  {
    $messageError = array(
      "error" => "Vous devez renseigner tous les champs",
    );
    if (
      !empty($_POST["namesalle"]) && !empty($_POST["adressesalle"])
      && !empty($_POST["phonesalle"]) && !empty($_POST["emailsalle"])
      && !empty($_POST["id"] && !empty($_POST["id_postal"]))) {
       
        

      if (empty($_FILES["imagesalle"])) {
        try {
          $newsalle = new Salle();
          $newsalle->setImage_salle(htmlspecialchars(strip_tags("salledefault.jpeg")));
          $newsalle->setNom_salle(htmlspecialchars(strip_tags($_POST["namesalle"])));
          $newsalle->setNumero_tel_salle(htmlspecialchars(strip_tags($_POST["phonesalle"])));
          $newsalle->setAdresse_salle(htmlspecialchars(strip_tags($_POST["adressesalle"])));
          $newsalle->setemail(htmlspecialchars(strip_tags($_POST["emailsalle"])));
          $newsalle->createsalle();
          $Attacher=new Attacher($_POST["id_postal"]);
          $Attacher->AddAttacher();
          $newevent = new  Event();
          $newevent->setId_professionnel(strip_tags(htmlspecialchars($_POST["id"])));
          $newevent->addEvent();
          $user = $newevent->displayLast();
          echo json_encode($user);
        } catch (Exception $e) {
          die('Erreur : ' . $e->getMessage());
        }
      } else {

        // ENREGISTREMENT UNE SALLE AVEC IMAGE
        $image = $_FILES['imagesalle']['tmp_name'];
        $salle = $_FILES['imagesalle']['name'];
        $size = $_FILES['imagesalle']['size'];
        $error = $_FILES['imagesalle']['error'];
     
    


        
        $fichier = move_uploaded_file($image, "../image/$salle");


        try {
          $newsalle = new Salle();
          $newsalle->setImage_salle(htmlspecialchars($salle));
          $newsalle->setNom_salle(htmlspecialchars($_POST["namesalle"]));
          $newsalle->setNumero_tel_salle(htmlspecialchars($_POST["phonesalle"]));
          $newsalle->setAdresse_salle(htmlspecialchars($_POST["adressesalle"]));
          $newsalle->setemail(htmlspecialchars($_POST["emailsalle"]));
          $newsalle->createsalle();
          $Attacher=new Attacher($_POST["id_postal"]);
          $Attacher->AddAttacher();
          $newevent = new  Event();
          $newevent->setId_professionnel(htmlspecialchars($_POST["id"]));
          $newevent->addEvent();
          $user = $newevent->displayLast();
          echo json_encode($user);
        } catch (Exception $e) {
          die('Erreur : ' . $e->getMessage());
        }
      }
    } else {
      echo json_encode($messageError);
    }
  }


  public function afficherSalle()
  {
    try {
      $display = new salle();
      $user = $display->afficherAll();
      echo json_encode($user);
    } catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }
  }





  public function displaysalleUser()
  {

    try {
      if (!empty($_POST["id"])) {
        $event = new Event();
        $event->setId_professionnel($_POST["id"]);
        $user = $event->showsalleUser();
        $nbre= $event->nbrSalle();
      echo json_encode ($user);
      }
    } catch (Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }
  }


//afficher code postal
  public function zip_code(){
    if(empty(!$_POST["zip_code"])){

      $event = new Salle;
      $event->setZip_code(htmlspecialchars(strip_tags($_POST["zip_code"])));
      $zip= $event->codePostal();
      echo json_encode($zip);
    }


  }
}
