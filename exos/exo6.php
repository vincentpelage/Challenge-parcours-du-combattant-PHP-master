<?php
require_once '../inc/functions.php';

/*
 * Exo 6 : Mamie reçoit les p’tits enfants
 *
 * Bon, tant qu'on y est, ça serait bien aussi de calculer leur âge.
 * J'ai toujours eu la bonne mémoire des dates, je connais leur
 * date de naissance par coeur.
 *
 * Seulement, pour calculer leur âge à partir de leur date de naissance,
 * saperlipopette !
 *
 * Si je te rajoute un paramètre `birth` à l'URL, tu crois que tu pourrais
 * aussi me rajouter l'âge ? Je te passe la date sous la forme DD-MM-YYYY.
 * Par exemple :
 *   `exo5.php?name=Zelda&birth=18-05-2003`
 *
 * Ensuite, il te "suffirait" qu'à récupérer, découper, puis comparer…
 *   http://php.net/manual/fr/function.explode.php
 *   http://php.net/manual/fr/function.date.php
 *
 *
 * Allez, bon courage… (mouhahaha)
 */

function hello() {
  if(isset($_GET['birth']) && isset($_GET['name'])){
      $name = $_GET['name'];
      $naissance = $_GET['birth'];
      $tableauNaissance = explode('-', $naissance);
      $jourNaissance = $tableauNaissance[0];
      $moisNaissance = $tableauNaissance[1];
      $anneeNaissance = $tableauNaissance[2];


      $jour = date ('j');
      $mois = date ('n');
      $annee = date ('Y');

      $jourFevrier = 28;
      $jourDansAnnee = 365;

      $calendrier = [
        31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31
      ];

      if(($annee % 4 == 0 && $annee % 100 == 0 && $annee % 400 == 0) || ($annee % 4 == 0 && $annee % 100 !== 0)):
        $anneeBissextile = true;
        $jourFevrier = 29;
        $jourDansAnnee = 366;
        $calendrier[1] = 29;
      endif;

      //calcul du nombre de jours nécessaire dans l'année en cours pour arriver à l'anniversaire d'Elisa.
      $jourAge = 0;
      for ($i = 0 ; $i < $moisNaissance ; $i++):
        $jourAge += $calendrier[$i];
      endfor;
      $jourAge -= $calendrier[$moisNaissance - 1] - $jourNaissance;

      //Nombre de jours passés dans l'année en cours.
      $jourEnCours = date('z') + 1; //prise en compte de la journée en cours.

      //Si le nombre de jours correspondant à l'anniversaire d'Elisa est inférieur ou égal aux jours passés dans l'année en cours, Elisa à age = année en cours - année de naissance sinon Elisa n'a pas encore fêté son anniversaire cette année. 
      if($jourAge <= $jourEnCours){
        $anneeFinal = $annee - $anneeNaissance;
        return 'Bonjour '.$name.', comment tu vas ? Tu as '.$anneeFinal.' ans maintenant !';
      } else {
        $anneeFinal = $annee - $anneeNaissance - 1;
        return 'Bonjour '.$name.', comment tu vas ? Tu as '.$anneeFinal.' ans maintenant !';
     }
  }
}



/*
 * Tests
 * Pas touche !
 */
displayExo(6, (
    hello() === 'Bonjour Elisa, comment tu vas ? Tu as 15 ans maintenant !'
));
