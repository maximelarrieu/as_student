<?php

    include_once 'script.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="script.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body style="margin: 40px">
    <h1 style="text-align: center"><i class="fa fa-road" style="margin-right: 20px"></i>CALCUL ROUTIER<i class="fa fa-road" style="margin-left: 20px"></i></h1>
    <form method="post" >
        <div class="form-group">
            <label for="last_name">Ville de départ</label>
            <input type="text" class="form-control" name="start_city" id="start_city" placeholder="Definissez une ville de départ">
        </div>
        <div class="form-group">
            <label for="last_name">Ville d'arrivée</label>
            <input type="text" class="form-control" name="arrive_city" id="arrive_city" placeholder="Definissez une ville d'arrivée">
        </div>
        <div class="form-group">
            <button type="submit" name="valid" class="btn btn-success">C'est parti !<i class="fa fa-truck" style="margin-left: 10px"></i></button>
            <?php
            if (isset($_POST['start_city']) && !empty($_POST['start_city']) && isset($_POST['arrive_city']) && !empty($_POST['arrive_city']) && isset($_POST['valid'])) {
                echo
                "
                <div class='alert alert-success' style='margin-top: 15px'>
                    Trajet calculé pour <b>". $_POST['start_city'] . " - " . $_POST['arrive_city']." </b>
                    <br/>
                    Le camion de marchandise ne dépasse pas les <b>90 km/h</b>
                    <br/>
                    Pour des raisons de sécurité, le chauffeur devra effectué <b>". $getpause ."</b> pause(s) de <b>15 minutes</b> au cours de son trajet.
                </div>
                ";
            } else {
                echo
                    "
                <div class='alert alert-danger' style='margin-top: 15px'>
                    Veuillez renseigner les deux champs.
                </div>
                ";
            }

            ?>
        </div>
    </form>

    <h3 style="text-align: center; margin-top: 70px; margin-bottom: 40px;"><i class="fa fa-map-marker" style="margin-right: 20px"></i>Calcul de votre itinéraire<i class="fa fa-map-marker" style="margin-left: 20px"></i></h3>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Ville de départ</th>
            <th scope="col">Ville d'arrivée</th>
            <th scope="col">Distance parcourue</th>
            <th scope="col">Durée du trajet</th>
            <th scope="col">Nombre de pauses</th>
            <th scope="col">Durée totale</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $_POST['start_city'] ?></td>
                <td><?php echo $_POST['arrive_city'] ?></td>
                <td><?php echo $result_distance ?>km</td>
                <td><?php echo $convert_time ?></td>
                <td><?php echo $getpause ?></td>
                <td><?php echo date('H:i', $pause) ?></td>
            </tr>
        </tbody>
    </table>

</body>
</html>