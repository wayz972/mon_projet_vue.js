<?php


class Dater extends Database{


    private $id_event;

    private $id_creneaux ;
    
    
    public function __construct()
        {
        }
    
    
    public function getId_event(){
        return htmlspecialchars($this->id_event);
    
    }
    
    public function setId_event($id_event){
    $this->id_event=$id_event;
    
    
    }
    
    public function getId_creneauxt(){
      return htmlspecialchars($this->id_creneaux);
    
    }
    public function setId_creneaux($id_creneaux){
        $this->id_creneaux= $id_creneaux;
    }


    public function addDater(){

   $sql="INSERT INTO dater (id_event,id_creneaux)
          VALUES (:id_event,:id_creneaux)";
     $req = $this->connect()->prepare($sql); 
     $req->bindParam(':id_event', $this->id_event);
     $req->bindParam(':id_creneaux', $this->id_creneaux);
     $req->execute();
     echo ("valide1"); 
    }










}

?>