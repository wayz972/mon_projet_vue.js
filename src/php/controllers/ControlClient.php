<?php


class ControlClient
{

  public function createUser()
  {

  
    $message = [
      ["error" => "Vous devez renseigner tous les champs"],
      ["errormail" => "Mail déja utilisé,veuillez renouveler votre demande avec d'autre informations"],
      ["success" => "compte créer"],
      ["errorImage" => "mauvais extension ou taille trop importante ou erreur "],
      ["errormail" => "Mail déja utilisé,veuillez renouveler votre demande avec d'autre informations"],
      
      

    ];

    if (isset($_POST["name"], $_POST["fname"], $_POST["email"],
     $_POST["password"], $_POST["phone"])) {
      if (
        empty(!$_POST["name"]) && empty(!$_POST["fname"]) && empty(!$_POST["email"])

        && empty(!$_POST["password"]) && empty(!$_POST["phone"])
      ) {

        //ENREGISTREMENT SANS IMAGE 
        if (empty($_FILES['image'])) {
          try {
            // je crée un usuer sans image
            $newuser = new Client();
            
            

            $newuser->setImgclient("imagedefault.png");

            $newuser->setName_client(htmlspecialchars(strip_tags($_POST["name"])));

            $newuser->setFirst_name_client(htmlspecialchars(strip_tags($_POST['fname'])));

            $newuser->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));

            $newuser->setEmail(htmlspecialchars(strip_tags($_POST["email"])));

            $newuser->setTelephone(htmlspecialchars(strip_tags($_POST["phone"])));

            $count = $newuser->verifyMail();


            $nbrUsers = $count->rowCount();
            //je verifie son existance en base de donnée
            if ($nbrUsers> 0) {

              echo json_encode($message[4]);
            } else {
   
              $newuser->creationUser();
              
              echo json_encode($message[2]);
            }
          } catch (Exception $e) {

            die('Erreur :' . $e->getMessage());
          }
        } else {

          try {

            // ENREGISTREMENT DE UTILISATEUR AVEC IMAGE
            $image = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];
            $size = $_FILES['image']['size'];
            $error = $_FILES['image']['error'];


            $tabExtension = explode('.', $name);  // permets de découper une chaîne de caractère en plusieurs morceaux// apres lepoint
            $extension = strtolower(end($tabExtension));  //Le fonction strtolower permets de mettre en minuscule tout une chaîne de caractère
            $tailleMax = 40000;

            $extensionAutorisees = ['jpg', 'jpeg', 'png']; //format accepter
            if (in_array($extension, $extensionAutorisees) && $size <= $tailleMax && $error == 0) {


              $uniqueName = uniqid('', true);  //donne un id unique part image
              $fileName = $uniqueName . '.' . $extension;  // on effectue une concatenation 




              //déplacer le fichier importé
              $fichier = move_uploaded_file($image, "../image/$fileName");

              //je crée un utilsateur avec une image
              $newuser = new Client();

              $newuser->setImgclient($fileName);

              $newuser->setName_client(htmlspecialchars($_POST["name"]));

              $newuser->setFirst_name_client(htmlspecialchars($_POST['fname']));

              $newuser->setPassword(password_hash($_POST["password"], PASSWORD_DEFAULT));

              $newuser->setEmail(htmlspecialchars($_POST["email"]));

              $newuser->setTelephone(htmlspecialchars($_POST["phone"]));


              $count = $newuser->verifyMail();

              $nbrUsers = $count->rowCount();

              //je verifie son existance en base de donnée
              if ($nbrUsers > 0) {
                echo json_encode($message[4]);
              } else {
                $newuser->creationUser();

                echo json_encode($message[2]);
              }
            } else {
              echo json_encode($message[3]);
            }
          } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
          }
        }
      } else {

        echo json_encode($message[0]);
      }
    }
  }



  public function methodeSecurity($string)
  {
     
      $string = htmlspecialchars(strip_tags($string));
      return $string;
  }

  public function updateRegisterUser()
  {

    // message valide ou non valide
    $message = [
      ["error" => "Vous devez renseigner tous les champs"],
      ["errormail" => "Mail déja utilisé,veuillez renouveler votre demande avec d'autre informations"],
      ["success" => "compte crée"],
      ["errorImage" => "mauvais extension ou taille trop importante ou erreur "],
      ["errormail" => "Mail déja utilisé,veuillez renouveler votre demande avec d'autre informations"]

    ];
    if (empty(!$_POST["name"]) && empty(!$_POST["fname"]) && empty(!$_POST["email"]) && empty(!$_POST["phone"]) && empty(!$_POST["id"])) {


      if (empty($_FILES['image'])) {

        try {
          $updateuser = new Client();

          $updateuser->setName_client( $this->methodeSecurity($_POST["name"]));
          $updateuser->setFirst_name_client($this->methodeSecurity( $_POST["fname"]));
          $updateuser->setTelephone($this->methodeSecurity($_POST["phone"]));
          $updateuser->setEmail($this->methodeSecurity($_POST["email"]));
          $updateuser->setId_client($this->methodeSecurity($_POST["id"]));
          $user = $updateuser->updateuserwithoutPicture();
          echo json_encode($user);
        } catch (Exception $e) {
          die('Erreur : ' . $e->getMessage());
        }
      } else {

        try {



          // ENREGISTREMENT DE UTILISATEUR AVEC IMAGE
          $image = $_FILES['image']['tmp_name'];
          $name = $_FILES['image']['name'];
          $size = $_FILES['image']['size'];
          $error = $_FILES['image']['error'];




          $tabExtension = explode('.', $name);  // permets de découper une chaîne de caractère en plusieurs morceaux// apres lepoint
          $extension = strtolower(end($tabExtension));  //Le fonction strtolower permets de mettre en minuscule tout une chaîne de caractère
          $tailleMax = 4000000;

          $extensionAutorisees = ['jpg', 'jpeg', 'png']; //format accepter
          if (in_array($extension, $extensionAutorisees) && $size <= $tailleMax && $error == 0) {


            $uniqueName = uniqid('', true);  //donne un id unique part image
            $fileName = $uniqueName . '.' . $extension;  // on effectue une concatenation 


            //déplacer le fichier importé
             move_uploaded_file($image, "../image/$fileName");
            $updateuser = new Client();
            $updateuser->setImgclient(htmlspecialchars($fileName));
            $updateuser->setName_client(htmlspecialchars($_POST["name"]));
            $updateuser->setFirst_name_client(htmlspecialchars($_POST["fname"]));
            $updateuser->setTelephone(htmlspecialchars($_POST["phone"]));
            $updateuser->setEmail(htmlspecialchars($_POST["email"]));
            $updateuser->setId_client(htmlspecialchars($_POST["id"]));
            $user = $updateuser->updateuser();
            echo json_encode($user);
          } 
          else {
            echo json_encode($message[3]);
          }
        } catch (Exception $e) {
          die('Erreur : ' . $e->getMessage());
        }
      }
    }
  }
}
