<?php
require_once '../inc/functions.php';

/*
 * Exo 4 : Mamie joue au loto II
 *
 * Super !
 * Maintenant, reste plus qu'à faire une fonction me donnant
 * un tableau avec les 6 nombres :
 *   - les numéros : 5 nombres de 1 à 49
 *   - le numéro complémentaire : 1 nombre de 1 à 10
 *
 *
 * Par exemple :
 *   numerosLoto() peut renvoyer [49, 42, 12, 36, 27, 9]
 *
 *
 *
 * BONUS:
 *   Si tu te sens, tu peux essayer de faire en sorte
 *   qu'il n'y ait pas de nombre identique. Si tu n'y
 *   arrives pas, ne t'embête pas, je relancerais la
 *   fonction pour avoir d'autres numéros…
 */

function numerosLoto() {
  // Initialisation des grilles principales et complémentaires
  $numerosLotoMamie = [];
  $numerosLotoComplementaireMamie = [];
  $grilleMamie = [];

  // Affectation des valeurs aux grilles du loto
  for($i = 1 ; $i <= 49 ; $i++):
    array_push($numerosLotoMamie, $i);
  endfor;

  for($i = 1 ; $i <= 10 ; $i++):
    array_push($numerosLotoComplementaireMamie, $i);
  endfor;

  /*
  * On push les valeurs des grilles principales et complémentaires
  * dans la grille de mamie. On supprime les numéros qui ont été utilisés
  * pour ne pas les retirer.
  */
  $i = 0;
  while($i < 5):
    $numero = $numerosLotoMamie[array_rand($numerosLotoMamie)];
    array_push($grilleMamie, $numero);
    $key = array_search($numero, $numerosLotoMamie);
    array_splice($numerosLotoMamie, $key, 1);
      if($key >= 0 && $key <10):
        array_splice($numerosLotoComplementaireMamie, $key, 1);
      endif;
    $i++;
  endwhile;

  $numeroComplementaire = $numerosLotoComplementaireMamie[array_rand($numerosLotoComplementaireMamie)];
  array_push($grilleMamie, $numeroComplementaire);

  // On retourne la grille de mamie
  return $grilleMamie;
}


/*
 * Tests
 * Pas touche !
 */
displayExo(4, (
    is_array(numerosLoto())
    && count(numerosLoto()) === 6
    && is_int(numerosLoto()[0])
    && numerosLoto()[1] >= 1
    && numerosLoto()[2] <= 50
    && numerosLoto()[3] >= 1
    && numerosLoto()[4] <= 50
    && numerosLoto()[5] <= 10
));
