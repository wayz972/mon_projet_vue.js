

<?php


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
header("Content-type:application/json");


$year = (isset($_GET['year'])) ? $_GET['year'] : date("Y");
$week = (isset($_GET['week'])) ? $_GET['week'] : date('W');
if($week > 52) {
    $year++;
    $week = 1;
} elseif($week < 1) {
    $year--;
    $week = 52;
}
?>

        <?php


$duree=30;
$clearup=0;
$starts="08:00";
$end="11:00";
// methode pour mon planing

    
    $starts= new DateTime($starts);
    $end= new DateTime($end);
    $interval= new DateInterval("PT".$duree."M");
    $clearinterval= new DateInterval("PT".$clearup."M");
     $slot=[];
     if($week < 10) {
        $week = '0'. $week;
    }
    for($i= 1; $i <= 7; $i++) {
        $d = strtotime($year ."W". $week . $i);
        $stab[]=date('l', $d) . date('d M', $d);
        // echo"<td>". date('l', $d) ."<br>". date('d M', $d) ."</td>";
    for($k=$starts; $k<$end;$k->add($interval)->add($clearinterval)){
         $endperiod=clone $k;
         $endperiod->add($interval);
         if($endperiod>$end){
             break;
         }
         $slot[]=$k->format("H:i")."-" .$endperiod->format("H:i")  ;
         
        };
    }
$stm=[
    [
    
    $stab[0]=>$slot,
    ],
    $stab[1]=>$slot,
    $stab[2]=>$slot,
    $stab[3]=>$slot,
    $stab[4]=>$slot,
    $stab[5]=>$slot,
    $stab[6]=>$slot,
];
 


// echo json_encode($stm);

?>

<?php

try {

    $rep=$bdd->prepare("SELECT * FROM  horaires");
    $rep->execute();
    $donnee=$rep->fetchAll();
  
      echo json_encode($donnee);
    
    
} catch (Exception $e) {

    die('Erreur : '.$e->getMessage());
    
}


?>