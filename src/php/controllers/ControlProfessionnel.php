<?php


class ControlProfessionnel{




    public function createUserpro()
    {
  
      // message valide ou non valide
      $message = [
        ["error" => "Vous devez renseigner tous les champs"],
        ["errormail" => "Mail déja utilisé,veuillez renouveler votre demande avec d'autre informations"],
        ["success" => "compte crée"],
        ["errorImage" => "mauvais extension ou taille trop importante ou erreur "],
        ["errormail" => "Mail déja utilisé,veuillez renouveler votre demande avec d'autre informations"]
  
      ];
      if (isset($_POST["name"], $_POST["fname"], $_POST["email"], $_POST["password"], $_POST["phone"])) {
        if (empty(!$_POST["name"]) && empty(!$_POST["fname"]) && empty(!$_POST["email"]) && empty(!$_POST["password"]) && empty(!$_POST["phone"])) {
  
          if (empty($_FILES['image'])) {
  
            try {
              $newuser = new Professionnel();
              $newuser->setImg_professionnel("imagedefault.png");
              $newuser->setNom_professionnel(htmlspecialchars($_POST["name"]));
              $newuser->setPrenom_professionnel(htmlspecialchars($_POST['fname']));
              $newuser->setPassword_professionnel(password_hash($_POST["password"], PASSWORD_DEFAULT));
              $newuser->setEmail_professionnel(htmlspecialchars($_POST["email"]));
              $newuser->setTelephone_professionnel(htmlspecialchars($_POST["phone"]));
              $count = $newuser->verifyMailPro();
              $nbrUsers = $count->rowCount();
              //je verifie son existance en base de donnée
              if ($nbrUsers > 0) {
                echo json_encode($message[4]);
              } else {
                $newuser->creationPro();
  
                echo json_encode($message[2]);
              }
            } catch (Exception $e) {
              die('Erreur : ' . $e->getMessage());
            }
          } else {
            try {
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
                $newuser = new Professionnel();
                $newuser->setImg_professionnel($fileName);
                $newuser->setNom_professionnel(htmlspecialchars($_POST["name"]));
                $newuser->setPrenom_professionnel(htmlspecialchars($_POST['fname']));
                $newuser->setPassword_professionnel(password_hash($_POST["password"], PASSWORD_DEFAULT));
                $newuser->setEmail_professionnel(htmlspecialchars($_POST["email"]));
                $newuser->setTelephone_professionnel(htmlspecialchars($_POST["phone"]));
  
                $count = $newuser->verifyMailPro();
                $nbrUsers = $count->rowCount();
                //je verifie son existance en base de donnée
  
  
                if ($nbrUsers > 0) {
                  echo json_encode($message[4]);
                } else {
                  $newuser->creationPro();
  
                  echo json_encode($message[2]);
                }
              } else {
                echo json_encode($message[3]);
              }
            } catch (Exception $e) {
              die('Erreur : ' . $e->getMessage());
            }
          }
        } else {
  
          echo json_encode($message[0]);
        }
      }
    }


    

    public function updateRegisterUserPro()
    {

  // message valide ou non valide
  $message = [
    ["error" => "Vous devez renseigner tous les champs"],
    ["errormail" => "Mail déja utilisé,veuillez renouveler votre demande avec d'autre informations"],
    ["success" => "compte crée"],
    ["errorImage" => "mauvais extension ou taille trop importante ou erreur "],
    ["errormail" => "Mail déja utilisé,veuillez renouveler votre demande avec d'autre informations"]

  ];

      if (
        empty(!$_POST["name"]) && empty(!$_POST["fname"])
        && empty(!$_POST["email"]) && empty(!$_POST["phone"])
        && empty(!$_POST["id"]) && empty(!$_POST["img"])
      ) 
      {

  
  
        if (empty($_FILES['image'])) {
  
          try {
  
            $updateuserPro = new Professionnel();
  
            $updateuserPro->setNom_professionnel(htmlspecialchars($_POST["name"]));
            $updateuserPro->setPrenom_professionnel(htmlspecialchars($_POST["fname"]));
            $updateuserPro->setTelephone_professionnel(htmlspecialchars($_POST["phone"]));
            $updateuserPro->setEmail_professionnel(htmlspecialchars($_POST["email"]));
            $updateuserPro->setId_professionnel(htmlspecialchars($_POST["id"]));
            $user = $updateuserPro->updateProwithoutPicture();
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
            $tailleMax = 70000;

            $extensionAutorisees = ['jpg', 'jpeg', 'png']; //format accepter
            if (in_array($extension, $extensionAutorisees) && $size <= $tailleMax && $error == 0) {

              
              
              $uniqueName = uniqid('', true);  //donne un id unique part image
              $fileName = $uniqueName . '.' . $extension;  // on effectue une concatenation 
              
              
              
              //déplacer le fichier importé
              $fichier = move_uploaded_file($image, "../image/$fileName");
              $updateuserPro = new Professionnel();
              $updateuserPro->setImg_professionnel(htmlspecialchars($fileName));
              $updateuserPro->setNom_professionnel(htmlspecialchars($_POST["name"]));
              $updateuserPro->setPrenom_professionnel(htmlspecialchars($_POST["fname"]));
              $updateuserPro->setTelephone_professionnel(htmlspecialchars($_POST["phone"]));
              $updateuserPro->setEmail_professionnel(htmlspecialchars($_POST["email"]));
              $updateuserPro->setId_professionnel(htmlspecialchars($_POST["id"]));
               
              $user = $updateuserPro->updatePro();
              $chemin="../image/".$_POST['img'];
              unlink($chemin);  //permet d'effacer l'ancienne image
              
              echo json_encode($user);
            }else{
              echo json_encode($message[3]);
            }
          } 
          catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
          }
        }
      }
    }





}














?>