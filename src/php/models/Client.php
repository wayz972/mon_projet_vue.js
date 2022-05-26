<?php
include("models/Database.php");

class Client extends Model
{

  private $id_client;
  private $name_client;
  private $first_name_client;
  private $password;
  private $email;
  private $telephone;
  private $image;
  private $conn;

  public function __construct()
  {
  }
  public function getId_client()
  {
    return htmlspecialchars($this->id_client);
  }
  public function setId_client($newid_client)
  {
    $this->id_client = $newid_client;
  }
  public function getName_client()
  {
    return htmlspecialchars($this->name_client);
  }
  public function setName_client($newname_client)
  {
    $this->name_client = $newname_client;
  }
  public function getFirst_name_client()
  {
    return htmlspecialchars($this->first_name_client);
  }
  public function setFirst_name_client($newfirst_name_client)
  {
    $this->first_name_client = $newfirst_name_client;
  }
  public function getPassword()
  {

    return htmlspecialchars($this->password);
  }
  public function setPassword($newpassword)
  {

    $this->password = $newpassword;
  }
  public function getEmail()
  {

    return htmlspecialchars($this->email);
  }
  public function setEmail($newemail)
  {

    $this->email = $newemail;
  }
  public function getTelephone()
  {

    return htmlspecialchars($this->telephone);
  }
  public function setTelephone($newTelephone)
  {

    $this->telephone = $newTelephone;
  }
  public function getImgclient()
  {

    return htmlspecialchars($this->image);
  }
  public function setImgclient($newImage)
  {

    $this->image = $newImage;
  }


  // connecter lutilisateur client 
  public function connectUser()
  {
    $sql = "SELECT *FROM client WHERE email_client = :email_client";
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':email_client', $this->email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      $recup = $stmt->fetch();
      if (password_verify($this->password, $recup["password_client"]) && $this->email == $recup["email_client"]) {
        $tabs = array(
          "id_user" => $recup["id_client"],
          "email" => $recup["email_client"],
          "name_user" => $recup["nom_client"],
          "first_name_user" => $recup["prenom_client"],
          "phone_user" => $recup["tel_client"],
          "img" => $recup["img_client"],
          'verify' => false,
          'nav' => false,
        );

        return $tabs;
      }
    }
  }
  //cree un utilisateur dans la table client
  public function creationUser()
  {
    $sql = "INSERT INTO
                client
         (nom_client,prenom_client,
         email_client,password_client,
         tel_client, img_client)
                 VALUE
       (:nom_client,:prenom_client,
       :email_client,:password_client,
       :tel_client,:img_client)";
    $req = $this->connect()->prepare($sql);
    $req->bindParam(':nom_client', $this->name_client);
    $req->bindParam(':prenom_client', $this->first_name_client);
    $req->bindParam(':email_client', $this->email);
    $req->bindParam(':password_client',$this->password);
    $req->bindParam(':tel_client',$this->telephone);
    $req->bindParam(':img_client',$this->image);
    $req->execute();
  }
  //mettre a jour le client 
  public function updateuser()
  {
    $sql = 'UPDATE  client
             SET 
   nom_client=:nom_client, email_client=:email_client,
  tel_client=:tel_client, prenom_client=:prenom_client,
  img_client=:img_client
            WHERE 	
   id_client=:id_client';
    $req = $this->connect()->prepare($sql);
    $req->bindParam(':img_client', $this->image);
    $req->bindParam(':nom_client', $this->name_client);
    $req->bindParam(':email_client', $this->email);
    $req->bindParam(':tel_client',  $this->telephone);
    $req->bindParam(':prenom_client', $this->first_name_client);
    $req->bindParam(':id_client',  $this->id_client);
    $req->execute();


    $sql="SELECT nom_client,
    prenom_client,adresse_client,
    tel_client,	img_client,
    email_client FROM client WHERE id_client =:id_client";
     $req = $this->connect()->prepare($sql);
     $req->bindParam(':id_client', $this->id_client);
     $req->execute();
     $stmt=$req->fetch();
     return $stmt;

  }

//sans image
  public function updateuserwithoutPicture()
  {
    $sql = 'UPDATE  client
             SET 
   nom_client=:nom_client, email_client=:email_client,
  tel_client=:tel_client, prenom_client=:prenom_client
  
            WHERE 	
   id_client=:id_client';
    $req = $this->connect()->prepare($sql);
    
    $req->bindParam(':nom_client', $this->name_client);
    $req->bindParam(':email_client', $this->email);
    $req->bindParam(':tel_client',  $this->telephone);
    $req->bindParam(':prenom_client', $this->first_name_client);
    $req->bindParam(':id_client',  $this->id_client);
    $req->execute();


    $sql="SELECT nom_client,
    prenom_client,adresse_client,
    tel_client,	img_client,
    email_client FROM client WHERE id_client =:id_client";
     $req = $this->connect()->prepare($sql);
     $req->bindParam(':id_client', $this->id_client);
     $req->execute();
     $stmt=$req->fetch();
     return $stmt;

  }






  //methode pour verifier si email existe
  public function verifyMail()
  {

    $sql = 'SELECT * FROM client WHERE  email_client = :email_client';
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':email_client', $this->email);
    $stmt->execute();
    $req=$stmt->fetch();
    return $req;
  }





}
