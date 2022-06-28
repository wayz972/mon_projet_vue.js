<?php


class Salle  extends Database
{

    private $id_salle;
    private $nom_salle;
    private $adresse_salle;
    private $numero_tel_salle;
    private $image_salle;
    private $email;
    private $zip_code;



    public function __construct()
    {
    }


    public function getId_salle()
    {
        return htmlspecialchars($this->id_salle);
    }

    public function setId_salle($id_salle)
    {
        $this->id_salle = $id_salle;
    }

    public function getNom_salle()
    {
        return htmlspecialchars($this->nom_salle);
    }

    public function setNom_salle($nom_salle)
    {
        $this->nom_salle = $nom_salle;
    }

    public function getAdresse_salle()
    {
        return htmlspecialchars($this->adresse_salle);
    }

    public function setAdresse_salle($adresse_salle)
    {
        $this->adresse_salle = $adresse_salle;
    }

    public function getNumero_tel_salle()
    {
        return htmlspecialchars($this->numero_tel_salle);
    }

    public function setNumero_tel_salle($numero_tel_salle)
    {
        $this->numero_tel_salle = $numero_tel_salle;
    }

    public function getImage_salle()
    {
        return htmlspecialchars($this->image_salle);
    }

    public function setImage_salle($image_salle)
    {
        $this->image_salle = $image_salle;
    }


    public function getemail()
    {
        return htmlspecialchars($this->email);
    }

    public function setemail($email)
    {
        $this->email = $email;
    }

    public function getZip_code()
    {
        return htmlspecialchars($this->zip_code);
    }

    public function setZip_code($zip_code)
    {
        $this->zip_code = $zip_code;
    }



   /**
    * display salle
    *@return  array
    */

    public function afficherAll()
    {

        $sql = "SELECT nom_salle,email_salle,numero_tel_salle,img_salle,adresse_salle FROM salle ";
        $req = $this->connect()->prepare($sql);
        $req->execute();
        $stmt = $req->fetchAll();
        return $stmt;
    }


/**
 * create salle
 * @return void
 */
    public function createsalle()
    {

        try {
            $sql = 'INSERT INTO 
                     salle
             (nom_salle,numero_tel_salle,adresse_salle,email_salle,img_salle) 
                      VALUES
             (:nom_salle,:numero_tel_salle,:adresse_salle,:email_salle,:img_salle)';
            $req = $this->connect()->prepare($sql);
            $req->bindParam(':nom_salle', $this->nom_salle);
            $req->bindParam(':numero_tel_salle', $this->numero_tel_salle);
            $req->bindParam(':adresse_salle', $this->adresse_salle);
            $req->bindParam(':email_salle', $this->email);
            $req->bindParam(':img_salle', $this->image_salle);
            $req->execute();
        } catch (Exception $e) {

            die('Erreur : ' . $e->getMessage());
        };
    }


    

//    (a verifier si jutilise cette fonction ou pas : => a supprimer) afficher la salle 
    public function afficherSalle()
    {
     
        $sql = ('SELECT *
        FROM utilisateur_pro
        INNER JOIN salle
        ON utilisateur_pro.id_user_pro = salle.id_user_pro  WHERE salle.id_user_pro= ' . $_POST["iduser"] . '');
         $req = $this->connect()->prepare($sql);
         $req->bindParam(':nom_salle', $this->nom_salle);
        $req->execute();
        if ($req->rowcount() > 0) {
            while ($donnee = $req->fetch()) {
                $rep = array(
                    "id_user_pro" => $donnee["id_user_pro"],
                    "name_salle" => $donnee["name_salle"],
                    "addresse_salle" => $donnee["adresse_salle"],
                    "phone_salle" => $donnee["numero_salle"],
                    "id_salle" => $donnee["id_salle"],
                    "change" => false,
                );
                echo json_encode($rep);
            }
        }
    }


/**
 *  search by code_postal
 * @return objet
 *  */ 
   public function codePostal(){

    $sql='SELECT zip_code,name,id_city FROM `city` WHERE `zip_code` LIKE `:code` ';
    $req = $this->connect()->prepare($sql);
      $req->bindParam(":code",'%'.$this->zip_code.'%');
    $req->execute();
    $stmt = $req->fetchAll(PDO::FETCH_ASSOC);
        return $stmt;


   }



}
