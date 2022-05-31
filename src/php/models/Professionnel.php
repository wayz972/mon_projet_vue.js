<?php

class Professionnel extends Database
{

    private $id_professionnel;
    private $nom_professionnel;
    private $telephone_professionnel;
    private $email_professionnel;
    private $prenom_professionnel;
    private $password_professionnel;
    private $img_professionnel;

    public function __construct()
    {
    }
    public function getId_professionnel()
    {
        return htmlspecialchars($this->id_professionnel);
    }

    public function setId_professionnel($id_professionnel)
    {
        $this->id_professionnel = $id_professionnel;
    }

    public function getNom_professionnel()
    {
        return htmlspecialchars($this->nom_professionnel);
    }

    public function setNom_professionnel($nom_professionnel)
    {
        $this->nom_professionnel = $nom_professionnel;
    }

    public function getTelephone_professionnel()
    {
        return htmlspecialchars($this->telephone_professionnel);
    }

    public function setTelephone_professionnel($telephone_professionnel)
    {
        $this->telephone_professionnel = $telephone_professionnel;
    }

    public function getEmail_professionnel()
    {
        return htmlspecialchars($this->email_professionnel);
    }

    public function setEmail_professionnel($email_professionnel)
    {
        $this->email_professionnel = $email_professionnel;
    }

    public function getPrenom_professionnel()
    {
        return htmlspecialchars($this->prenom_professionnel);
    }

    public function setPrenom_professionnel($prenom_professionnel)
    {
        $this->prenom_professionnel = $prenom_professionnel;
    }

    public function getPassword_professionnel()
    {
        return htmlspecialchars($this->password_professionnel);
    }

    public function setPassword_professionnel($password_professionnel)
    {
        $this->password_professionnel = $password_professionnel;
    }
    public function getImg_professionnel()
    {
        return htmlspecialchars($this->img_professionnel);
    }

    public function setImg_professionnel($img_professionnel)
    {
        $this->img_professionnel = $img_professionnel;
    }

    // CREE UN PRO DANS LA TABLE PROFESSIONNEL 
    public function creationPro()
    {
        $sql = 'INSERT INTO  
               professionnel

     (nom_professionnel,
     prenom_professionnel,
     email_professionnel,
     password_professionnel,
     telephone_professionnel,
      img_professionnel)
                VALUE
     (:nom_professionnel,:prenom_professionnel,
     :email_professionnel,:password_professionnel,
    :telephone_professionnel,:img_professionnel)';

        $req = $this->connect()->prepare($sql);
        $req->bindParam(':nom_professionnel',$this->nom_professionnel);
        $req->bindParam(':prenom_professionnel', $this->prenom_professionnel);
        $req->bindParam(':email_professionnel', $this->email_professionnel);
        $req->bindParam(':password_professionnel', $this->password_professionnel);
        $req->bindParam(':telephone_professionnel', $this->telephone_professionnel);
        $req->bindParam(':img_professionnel',  $this->img_professionnel);
        $req->execute();
    }

    //mettre a jour le professionnel
    public function updatePro()
    {
        $sql = "UPDATE  
               professionnel
                  SET 
     nom_professionnel=:nom_professionnel,
     email_professionnel=:email_professionnel,
    telephone_professionnel=:telephone_professionnel,
    prenom_professionnel=:prenom_professionnel,
    img_professionnel=:img_professionnel
                  WHERE 
       id_professionnel=:id_professionnel";

        $req = $this->connect()->prepare($sql);
        $req->bindParam(':img_professionnel',$this->img_professionnel);
        $req->bindParam(':nom_professionnel', $this->nom_professionnel);
        $req->bindParam(':email_professionnel', $this->email_professionnel);
        $req->bindParam(':telephone_professionnel', $this->telephone_professionnel);
        $req->bindParam(':prenom_professionnel', $this->prenom_professionnel);
        $req->bindParam(':id_professionnel', $this->id_professionnel);
        $req->execute();
        $sql="SELECT nom_professionnel,
                     email_professionnel,
                     telephone_professionnel,
                     prenom_professionnel,
                     img_professionnel
         FROM professionnel WHERE id_professionnel=:id_professionnel";
        $req = $this->connect()->prepare($sql);
        $req->bindParam(':id_professionnel', $this->id_professionnel);
        $req->execute();
        $stmt=$req->fetch();
        return $stmt;
        
    }

   //un utilsateur sans image
   
    public function updateProwithoutPicture()
    {
        $sql = "UPDATE  
               professionnel
                  SET 
     nom_professionnel=:nom_professionnel,
     email_professionnel=:email_professionnel,
    telephone_professionnel=:telephone_professionnel,
    prenom_professionnel=:prenom_professionnel
   
                  WHERE 
       id_professionnel=:id_professionnel";

        $req = $this->connect()->prepare($sql);
        
        $req->bindParam(':nom_professionnel', $this->nom_professionnel);
        $req->bindParam(':email_professionnel', $this->email_professionnel);
        $req->bindParam(':telephone_professionnel', $this->telephone_professionnel);
        $req->bindParam(':prenom_professionnel', $this->prenom_professionnel);
        $req->bindParam(':id_professionnel', $this->id_professionnel);
        $req->execute();
        $sql="SELECT nom_professionnel,
                     email_professionnel,
                     telephone_professionnel,
                     prenom_professionnel,
                     img_professionnel
         FROM professionnel WHERE id_professionnel=:id_professionnel";
        $req = $this->connect()->prepare($sql);
        $req->bindParam(':id_professionnel', $this->id_professionnel);
        $req->execute();
        $stmt=$req->fetch();
        return $stmt;
        
    }

  //methode pour verifier si email existe
  public function verifyMailPro()
  {

    $sql = 'SELECT * FROM professionnel WHERE  email_professionnel = :email_professionnel';
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(':email_professionnel', $this->email_professionnel);
    $stmt->execute();
    return $stmt;
  }



    // connecter l'utilisateur professionnel 
    public function connectPro()
    {

        $sql = "SELECT *FROM
                    professionnel 
                        WHERE 
                email_professionnel = :email_professionnel";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(':email_professionnel', $this->email_professionnel);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $recup = $stmt->fetch();
            $sql2 = 'SELECT * FROM
                   salle 
                   JOIN event JOIN
                   professionnel 
                  WHERE salle.id_salle = event.id_salle
                     AND 
                 event.id_professionnel= :id_professionnel ';

            $stmt2 = $this->connect()->prepare($sql2);
            $stmt2->bindParam(':id_professionnel', $recup["id_professionnel"]);
            $stmt2->execute();
            $recup2 = $stmt2->fetch();

            if (password_verify($this->password_professionnel, $recup["password_professionnel"]) &&  $this->email_professionnel == $recup["email_professionnel"]) {
                if (empty($recup2)) {


                    $tabs = array(
                        'id_user' => $recup["id_professionnel"],
                        'email' => $recup["email_professionnel"],
                        'name_user' => $recup["nom_professionnel"],
                        'first_name_user' => $recup["prenom_professionnel"],
                        'phone_user' => $recup["telephone_professionnel"],
                        'img' => $recup["img_professionnel"],
                        'verify' => "true",
                        'nav' => 'false',

                    );
                    return $tabs;
                } else if (!empty($recup2)) {



                    $tabs = array(
                        'id_user' => $recup["id_professionnel"],
                        'email' => $recup["email_professionnel"],
                        'name_user' => $recup["nom_professionnel"],
                        'first_name_user' => $recup["prenom_professionnel"],
                        'phone_user' => $recup["telephone_professionnel"],
                        'img' => $recup["img_professionnel"],
                        'verify' => true,
                        'nav' => 'false',
                        "nom_salle" => $recup2["nom_salle"],
                        "numero_tel_salle" => $recup2["numero_tel_salle"]
                    );
                    return $tabs;
                }
            }
        }
    }
}





//  nombre devent dans section qui permet de compter le nombre de creneau horaire 
//  SELECT COUNT(`id_event`) FROM section where `id_event`=17;