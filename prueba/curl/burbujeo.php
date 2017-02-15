<?php 
 /*function bubbleSort($array, $n) {
    for ($i = 1; $i < $n; $i++) {
      for ($j = 0; $j < $n - $i; $j++) {
        if ($array[$j] > $array[$j + 1]) {
          $k = $array[$j + 1]; 
          $array[$j + 1] = $array[$j]; 
          $array[$j] = $k;
        }
      }
    }
     echo $i,"<br>";
     echo $j;

    return $array;
  }
 
  $array = array(7, 5, 4, 3, 2, 1, 8);
  $bubble = bubbleSort($array, count($array));
 
  echo "<p>Array desordenado: </p>";
 
  for ($i = 0; $i < count($array); $i++) {
    echo $array[$i] ." ";
  }
 
  echo "<p>Array ordenado: </p>";
 
  for ($i = 0; $i < count($bubble); $i++) {
    echo $bubble[$i] ." ";
  }*/





$ordenar=array(2,7,4,3);
function burbujeo($ordenar){

for ($i=0;$i<=count($ordenar);$i++) { 
	
     $a=$i;
	 $a=$a+1;

     $final=count($ordenar);

     while($final!=0){

        if($a < count($ordenar)){
        
        echo $ordenar[$i],"<br>",$ordenar[$i+1];

if($ordenar[$i]>$ordenar[$i+1]){

 $aux=$ordenar[$i];
 $ordenar[$i]=$ordenar[$i+1];
 $ordenar[$i+1];
}
        
           }      


        $final--;
     }


}



return $ordenar;

}



$or=burbujeo($ordenar);
echo "<prev>";
var_dump($or);
echo "</prev>";















?>