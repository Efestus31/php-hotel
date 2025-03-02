<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

//controlla se la richiesta del parking é valida
$parking_requested = false;

if (isset($_GET['parking']) && $_GET['parking'] == "on") {
    $parking_requested = true;
}

//controlla se la richiesta del voto é valida
$minimum_vote = 0;

if (isset($_GET['minimum_vote']) && is_numeric($_GET['minimum_vote']) && $_GET['minimum_vote'] > 0 && $_GET['minimum_vote'] <= 5) {
    $minimum_vote = (int)$_GET['minimum_vote'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2>Filtri di ricerca</h2>
        <form action="" method="GET">
            <div class="d-flex mb-2">
                <div class="form-control">
                    <label for="parking">Disponibilità parcheggio:</label>
                    <input id="parking" name="parking" type="checkbox">
                </div>
                <div class="form-control">
                    <label for="minimum_vote">Voto:</label>
                    <input name="minimum_vote" id="minimum_vote" type="number" min="1" max='5'>
                </div>
            </div>
            <button>Filtra</button>
        </form>
        <hr>
        <h2 class='mb-4'> Lista degli hotel </h2>
        <hr>
        <!-- Tabella -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Parcheggio</th>
                    <th>Voto</th>
                    <th>Ditanza dal cento (km)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($hotels as $hotel) {

                    //se l' utente ha selezionato il parcheggio 
                    //mostriamo solo gli hotel con il parcheggio
                    if ($parking_requested) {
                        //controlliamo se l'hotel in cui stiamo iterando NON ha il parcheggio
                        if (! $hotel['parking']) {
                            continue;
                        }
                    }
                    //se l'utente ha selezionato il voto minimo
                    //mostriamo solo gli hotel con il voto minimo desiderato
                    if ($minimum_vote) {
                        //controlliamo se il voto dell' hotel e minore o uguale al voto minimo
                        if ($hotel['vote'] < $minimum_vote) {
                            continue;
                        }
                    }
                ?>
                    <tr>
                        <td><?php echo $hotel["name"]; ?></td>
                        <td><?php echo $hotel["description"]; ?></td>
                        <td><?php echo $hotel["parking"] ? 'Si' : 'No'; ?></td>
                        <td><?php echo $hotel["vote"]; ?></td>
                        <td><?php echo $hotel["distance_to_center"]; ?></td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>

</body>

</html>