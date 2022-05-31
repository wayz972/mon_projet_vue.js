<?php

class Attacher extends Database{

   private $id_salle;
   private $id_city;



   public function __construct($id_city)
   {
     
     $this->id_city=$id_city;


   }


  public function getId_salle(){
        return htmlspecialchars($this->id_salle);
    
    }
    
    public function setId_salle($id_salle){
    $this->id_salle=$id_salle;
    
    
    }

    public function getId_city(){
        return htmlspecialchars($this->id_city);
    
    }
    
    public function setId_city($id_city){
    $this->id_city=$id_city;
    
    
    }

//recuperer id salle et id city 

   public function AddAttacher()
   {
   
		$sql = "SELECT id_salle FROM salle ORDER BY id_salle DESC LIMIT 1";
		$req = $this->connect()->prepare($sql);
		$req->execute();
		$donnee = $req->fetchAll(PDO::FETCH_OBJ);

		foreach ($donnee as $stm) {

			$this->setId_salle($stm->id_salle);
			$sql = "INSERT INTO  attacher (id_salle,id_city)
			VALUE (:id_salle,:id_city)";
			$req = $this->connect()->prepare($sql);
			$req->bindParam(':id_salle', $this->id_salle);
			$req->bindParam(':id_city', $this->id_city);
			
			$req->execute();
		}
   }



}



?>