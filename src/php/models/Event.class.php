<?php



class Event extends Model
{


	private $id_event;
	private $id_salle;
	private $id_professionnel;
	private $date_event;


	public function __construct()
	{
	}

	public function getId_event()
	{
		return $this->id_event;
	}

	public function setId_event($id_event)
	{
		$this->id_event = $id_event;
	}

	public function getId_salle()
	{
		return $this->id_salle;
	}

	public function setId_salle($id_salle)
	{
		$this->id_salle = $id_salle;
	}

	public function getId_professionnel()
	{
		return $this->id_professionnel;
	}

	public function setId_professionnel($id_professionnel)
	{
		$this->id_professionnel = $id_professionnel;


	}
	public function getDate_event()
	{
		return $this->date_event;
	}

	public function setDate_event($date_event)
	{
		$this->date_event = $date_event;
	}


// ajouter dans event 

	public function addEvent()
	{

		$sql = "SELECT id_salle FROM salle ORDER BY id_salle DESC LIMIT 1";
		$req = $this->connect()->prepare($sql);
		$req->execute();
		$donnee = $req->fetchAll(PDO::FETCH_OBJ);

		foreach ($donnee as $stm) {

			$this->setId_salle($stm->id_salle);
			$sql = "INSERT INTO  event( id_salle, id_professionnel,date_event)
			VALUE (:id_salle,:id_professionnel,NOW())";
			$req = $this->connect()->prepare($sql);
			$req->bindParam(':id_salle', $this->id_salle);
			$req->bindParam(':id_professionnel', $this->id_professionnel);
			
			$req->execute();
		}
	}






	public function displayLast()
	{

		$sql = "SELECT  nom_salle,email_salle,numero_tel_salle,nom_professionnel,adresse_salle FROM event
		 INNER JOIN salle ON event.id_salle = salle.id_salle 
		 INNER JOIN professionnel ON event.id_professionnel = professionnel.id_professionnel
		  WHERE id_event=(SELECT max(id_event) FROM event)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		$donnee = $stmt->fetchAll();
		return $donnee;
	}

// montrer la salle ratacher a un professionnel
	public function showsalleUser()
	{




		
		$sql = "SELECT nom_salle,numero_tel_salle,email_salle,adresse_salle, img_salle ,salle.id_salle,zip_code,name from event
		 join salle on salle.id_salle = event.id_salle 
		 JOIN attacher on attacher.id_salle=salle.id_salle 
		 join city on attacher.id_city=city.id_city 
		 join professionnel ON event.id_professionnel=professionnel.id_professionnel 
		 where event.id_professionnel= :id_professionnel";
	
		
		$stmt = $this->connect()->prepare($sql);
		
		$stmt->bindParam(':id_professionnel', $this->id_professionnel);
		
		$stmt->execute();
		
		$donnee = $stmt->fetchAll(PDO::FETCH_ASSOC);

             return $donnee;
	}



	// 
	public function nbrSalle()
	{

// 		SELECT
//  CASE 
// WHEN 
// COUNT(id_section)  = 0 then 1

// END as nbre ,nom_salle,numero_tel_salle,email_salle,adresse_salle, img_salle ,salle.id_salle
// from section
// JOIN event
// on section.id_event=event.id_event
// join salle on salle.id_salle = event.id_salle
//  join professionnel ON event.id_professionnel=professionnel.id_professionnel
// 		  where professionnel.id_professionnel= 12

		$sql = "SELECT COUNT(id_section) as nombre FROM section 
		JOIN event on section.id_event=event.id_event where id_professionnel=:id_professionnel ";
		
		$stmt = $this->connect()->prepare($sql);
		$stmt->bindParam(':id_professionnel', $this->id_professionnel);
		$stmt->execute();
		$donnee = $stmt->fetch();
		return $donnee;
	}

	//supprimer la salle du professionnel




	public function deletesalleWithoutréservation(){
		$sql = "SELECT event.id_event FROM `section` JOIN event on event.id_event=section.id_event WHERE event.id_salle=:id_salle ";
		
		$stmt = $this->connect()->prepare($sql);
		$stmt->bindParam(':id_salle', $this->id_salle);
		$stmt->execute();
		$donnee = $stmt->fetch();
		return $donnee;

	}


	public function deleteSalle1(){
		$sql = "DELETE salle FROM event 
		JOIN salle ON event.id_salle = salle.id_salle 
		
		
		join professionnel on event.id_professionnel= professionnel.id_professionnel 
		WHERE professionnel.id_professionnel =:id_professionnel AND salle.id_salle=:id_salle";
		$stmt = $this->connect()->prepare($sql);
		$stmt->bindParam(':id_professionnel', $this->id_professionnel);
		$stmt->bindParam(':id_salle', $this->id_salle);
		$stmt->execute();

	} 

	public function deleteSalle2()
	{

		$sql = "DELETE salle FROM event 
		JOIN salle ON event.id_salle = salle.id_salle 
		join dater on dater.id_event=event.id_event 
		join section on section.id_event=event.id_event 
		join professionnel on event.id_professionnel= professionnel.id_professionnel 
		WHERE professionnel.id_professionnel =:id_professionnel AND salle.id_salle=:id_salle";
		$stmt = $this->connect()->prepare($sql);
		$stmt->bindParam(':id_professionnel', $this->id_professionnel);
		$stmt->bindParam(':id_salle', $this->id_salle);
		$stmt->execute();
	}


	public function findId_Event()
	{

		$sql = "SELECT id_event,id_creneaux from event 
		join salle join creneaux on salle.id_salle = event.id_salle 
		join professionnel ON event.id_professionnel=professionnel.id_professionnel 
		where event.id_salle= :id_salle ORDER BY id_creneaux DESC LIMIT 1";

		$stmt = $this->connect()->prepare($sql);
		$stmt->bindParam(':id_salle', $this->id_salle);
		$stmt->execute();
		$donnee = $stmt->fetch();
		return $donnee;
	}
}
