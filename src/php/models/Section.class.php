<?php

class Section extends Database{


    private $id_event;
    private $datetimeslot;
    private $id_client; 

    public function __construct()
    {
    }

    public function getId_event(){
        return htmlspecialchars($this->id_event);
    
    }
    
    public function setId_event($id_event){
    $this->id_event=$id_event;
    
    
    }
    public function getId_client()
  {
    return htmlspecialchars($this->id_client);
  }
  public function setId_client($newid_client)
  {
    $this->id_client = $newid_client;
  }




  public function getDatetimeslot()
  {
    return htmlspecialchars($this->datetimeslot);
  }
  public function setDatetimeslot($datetimeslot)
  {
    $this->datetimeslot = $datetimeslot;
  }




  /////   ajouter a la table section  les 2 id  et la date
  public function addSection(){

    try {
      $sql="INSERT INTO section (id_event,id_client,date_section)
      VALUES (:id_event,:id_client,:datetimeslot)";
  $req = $this->connect()->prepare($sql); 
  $req->bindParam(':id_event', $this->id_event);
  $req->bindParam(':id_client', $this->id_client);
  $req->bindParam(':datetimeslot', $this->datetimeslot);
  $req->execute();
  echo ("valide2");
    } catch (Exception $e) {
      echo $e->getMessage();
    }

 
  }


  public function deleteSlot_idUser(){

    try {
      $sql='DELETE FROM `section` WHERE `id_client`=:id_client and `date_section`=:datetimeslot';
      $req = $this->connect()->prepare($sql);
      $req->bindParam(':id_client',$this->id_client);
      $req->bindParam(':datetimeslot',$this->datetimeslot);
      $req->execute();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
   
  }






}

?>