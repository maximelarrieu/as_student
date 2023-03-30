<?php
// Fonction `distance` qui contient le tableau des données
function distance($villeA, $villeB) {
    // Tableaux de données
    $array = [
        "Paris" => [
            "Toulouse" => 677,
            "Perpignan" => 846,
            "Lyon" => 463,
            "Bordeaux" => 582,
            "Rennes" => 347,
            "Nantes" => 380,
            "Grenoble" => 574,
            "Nancy" => 349,
            "Rouen" => 134,
            "Montpellier" => 746,
        ],
        "Toulouse" => [
            "Paris" => 677,
            "Perpignan" => 207,
            "Lyon" => 537,
            "Bordeaux" => 245,
            "Rennes" => 698,
            "Nantes" => 585,
            "Grenoble" => 531,
            "Nancy" => 860,
            "Rouen" => 765,
            "Montpellier" => 240,
        ],
        "Perpignan" => [
            "Paris" => 846,
            "Toulouse" => 207,
            "Lyon" => 450,
            "Bordeaux" => 447,
            "Rennes" => 902,
            "Nantes" => 787,
            "Grenoble" => 444,
            "Nancy" => 855,
            "Rouen" => 934,
            "Montpellier" => 153,
        ],
        "Lyon" => [
            "Paris" => 463,
            "Toulouse" => 537,
            "Perpignan" => 450,
            "Bordeaux" => 553,
            "Rennes" => 719,
            "Nantes" => 685,
            "Grenoble" => 106,
            "Nancy" => 408,
            "Rouen" => 593,
            "Montpellier" => 302,
        ],
        "Bordeaux" => [
            "Paris" => 582,
            "Toulouse" => 245,
            "Perpignan" => 447,
            "Lyon" => 553,
            "Rennes" => 460,
            "Nantes" => 347,
            "Grenoble" => 663,
            "Nancy" => 902,
            "Rouen" => 654,
            "Montpellier" => 480,
        ],
        "Rennes" => [
            "Paris" => 347,
            "Toulouse" => 698,
            "Perpignan" => 902,
            "Lyon" => 719,
            "Bordeaux" => 460,
            "Nantes" => 107,
            "Grenoble" => 829,
            "Nancy" => 721,
            "Rouen" => 311,
            "Montpellier" => 894,
        ],
        "Nantes" => [
            "Paris" => 380,
            "Toulouse" => 585,
            "Perpignan" => 787,
            "Lyon" => 685,
            "Bordeaux" => 347,
            "Rennes" => 107,
            "Grenoble" => 792,
            "Nancy" => 754,
            "Rouen" => 383,
            "Montpellier" => 823
        ],
        "Grenoble" => [
            "Paris" => 574,
            "Toulouse" => 531,
            "Perpignan" => 444,
            "Lyon" => 106,
            "Bordeaux" => 663,
            "Rennes" => 829,
            "Nantes" => 792,
            "Nancy" => 521,
            "Rouen" => 705,
            "Montpellier" => 297
        ],
        "Nancy" => [
            "Paris" => 349,
            "Toulouse" => 860,
            "Perpignan" => 855,
            "Lyon" => 408,
            "Bordeaux" => 902,
            "Rennes" => 721,
            "Nantes" => 754,
            "Grenoble" => 521,
            "Rouen" => 495,
            "Montpellier" => 705,
        ],
        "Rouen" => [
            "Paris" => 134,
            "Toulouse" => 765,
            "Perpignan" => 934,
            "Lyon" => 593,
            "Bordeaux" => 654,
            "Rennes" => 311,
            "Nantes" => 383,
            "Grenoble" => 705,
            "Nancy" => 495,
            "Montpellier" => 856
        ],
        "Montpellier" => [
            "Paris" => 746,
            "Toulouse" => 240,
            "Perpignan" => 153,
            "Lyon" => 302,
            "Bordeaux" => 480,
            "Rennes" => 894,
            "Nantes" => 823,
            "Grenoble" => 297,
            "Nancy" => 705,
            "Rouen" => 856
        ]
    ];
    // Récupération correspondance des index de tableaux
    $dist = $array[$villeA][$villeB];
    return $dist;
}
// Résultat en km pour l'affichage
$result_distance = distance($_POST['start_city'], $_POST['arrive_city']);
// Résultat converti en m pour calcul
$convert_distance = distance($_POST['start_city'], $_POST['arrive_city']) * 1000;
?>