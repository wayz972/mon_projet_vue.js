<?php 


class Creneaux extends Model{

private $id_creneaux;

private $datetime_creneaux;


public function __construct()
    {
    }


public function getId_creneaux(){
    return htmlspecialchars($this->id_creneaux);

}

public function setId_creneaux($id_creneaux){
$this->id_creneaux=$id_creneaux;


}

public function getDatetime_creneaux(){
  return htmlspecialchars($this->datetime_creneaux);

}

public function setDatetime_creneaux($datetime_creneaux){
    $this->datetime_creneaux= $datetime_creneaux;
}
    

public function date_time(){

 $sql="INSERT INTO creneaux (datetime_creneaux)
         VALUES (:datetime_creneaux)";

$req = $this->connect()->prepare($sql);
$req->bindParam(':datetime_creneaux',$this->datetime_creneaux);
$req->execute();

 


//renvoyer le creneaux du user 
// $sql="SELECT DATE_FORMAT(datetime_creneaux, ' %W %e %M %Y  %T ' ) FROM client JOIN section on client.id_client=section.id_client join event on section.id_event=event.id_event join dater on event.id_event= dater.id_event join creneaux on dater.id_creneaux=creneaux.id_creneaux WHERE client.id_client=1;";


// $sql="SELECT DATE_FORMAT(datetime_creneaux, ' %W %e %M %Y  %T ' )from creneaux";


}

//methode qui permet d'afficher les créneaux horaires
public function afficherSlot(){

    // $sql="SELECT  DATE_FORMAT(datetime_creneaux , ' %W %e %M %Y  %T' )  AS creneaux
    // FROM client JOIN section on client.id_client=section.id_client 
    // join event on section.id_event=event.id_event join dater on event.id_event= dater.id_event
    //  join creneaux on dater.id_creneaux=creneaux.id_creneaux WHERE client.id_client=:id_client";
    $sql="SELECT distinct creneaux.id_creneaux ,datetime_creneaux  AS creneaux,nom_salle
    FROM section join event on section.id_event=event.id_event 
    join dater on event.id_event= dater.id_event
    join salle on event.id_salle=salle.id_salle
     join creneaux on dater.id_creneaux=creneaux.id_creneaux WHERE section.id_client=:id_client";
     $req = $this->connect()->prepare($sql);
     $req->bindParam(':id_client',$this->id_creneaux);
     $req->execute();
     $donnee=$req->fetchAll(PDO::FETCH_ASSOC);
   


    //  $slot=( strftime('%A %d %B %Y %r', strtotime($donnee['creneaux'])));
    // setlocale(LC_TIME, 'fr_FR.utf8','fra');
    //       $slot=(strftime('%A %d %B %Y %T', strtotime($donnee['creneaux'])));

        
          
          return $donnee;
    

}


public function DeleteSlot(){
    $sql='DELETE FROM `dater` WHERE `id_creneaux`=:id_creneaux ';
    $req = $this->connect()->prepare($sql);
    $req->bindParam(':id_creneaux',$this->id_creneaux);
    
    $req->execute();
    

}



}










?>