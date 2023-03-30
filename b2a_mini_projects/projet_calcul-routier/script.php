<?php
include_once "data.php";
// Fonction calcul du temps de trajet
function howmanytime()
{
    // Récupération variable contenant le return de la fonction `distance`
    global $convert_distance;
    // Vitesse initiale
    $speed = 10;
    // Vitesse maximum converte en m/s
    $speedmax = 90 * 1000 / 3600;
    // Distance qu'on parcourera
    $distance_p = 0;
    // Calcul de temps(secondes) de trajet grâce à la distance en m
    $time = $convert_distance / $speedmax;
    // Tant qu'on est pas arrivé...
    while($distance_p < $convert_distance) {
        // Le camion avance de 10 m/s
        $distance_p += 10 * 1000;
        // Tant que la jauge vitesse ne dépasse pas
        while($speed < $speedmax) {
            // J'augmente la vitesse de 10 secondes
            $speed += 10 / 3600;
        }
    }
    return $time;
}
// Résultat en secondes
$result_time = howmanytime();
// Résultat converti en HH:mm pour affichage
$convert_time = date('H:i', howmanytime());

// Fonction calcul des pauses
function pause() {
    // Récupération variable contenant le return de la fonction `howmanytime`
    global $result_time;
    // Temps des pauses défini à 900 secondes soit 15min
    $break_time = 900;
    // Compteur de pauses
    $count_break = 0;
    // Indicateur de pauses
    $break = 0;
    // Temps effectué sur la route
    $time_completed = 0;

    // Tant que le chauffeur n'a pas effectué le temps du trajet
    while($time_completed <= $result_time) {
        // Si l'indicateur de pause arrive à 15min dans le temps en train d'être effectué
        if($break ==  7200) {
            // Dans ce cas le le compteur de pauses s'incrémente
            $count_break += 1;
            // L'indicateur reprends à 0
            $break = 0;
        }
        // En attendant l'indicateur s'incrémente
        $break++;
        // Ainsi que le temps en train d'être fait par le chauffeur... Courage...
        $time_completed++;
    }
    // On retourne notre toute première variable à laquelle on ajoute le nombre de pauses de 15min que le chauffeur a effectué
    return ($result_time + ($count_break * $break_time));

}
// Résultat en secondes
$pause = pause();

// Récupération de nombre de pauses
function getPause() {
    global $result_time;
    $break_time = 900;
    $count_break = 0;
    $break = 0;
    $time_completed = 0;
    while($time_completed <= $result_time) {
        if($break ==  7200) {
            $count_break += 1;
            $break = 0;
        }
        $break++;
        $time_completed++;
    }
    return ($count_break);
}
$getpause = getPause();

?>