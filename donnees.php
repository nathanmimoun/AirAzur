<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Air Azur</title>
    <link href="css/styles_2.css" rel="stylesheet" />
</head>

<body>

    <?php
    $insee = $_GET["insee"];
    $ville = $_GET["ville"];

    // Création d'une variable date incluse dans l'url de la fonction curl pour récupérer en temps réel les données de l'API Atmosud selon la date actuelle en France

    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d');

    // Création de deux variables dates J+1 et J+2 pour récupérer les prévisions régionales (voir seconde requête curl)

    $date1 = date('Y-m-d', strtotime("+1 day"));
    $date2 = date('Y-m-d', strtotime("+2 day"));

    // Première requête curl

    $ch = curl_init();
    $url = "https://api.atmosud.org/iqa2021/commune/indices/journalier?format_indice=couleur,qualificatif&indice=iqa&format=json&insee=$insee&srid=2154&date_debut=$date&date_fin=$date&info_diffusion=true";

    // configuration des options

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // exécution de la session

    $a = curl_exec($ch);
    $data = json_decode($a, true);

    // récupération de la valeur de l'indice de qualité d'air IQA dans la variable $qualificatif

    if (isset($data["$insee"]["valeurs"]["$date"]["indice"]["qualificatif"])) {
        $qualificatif = $data["$insee"]["valeurs"]["$date"]["indice"]["qualificatif"];
    } else {
    };


    //echo "<br> La qualité de l'air de $ville est $qualificatif";

    ?>
    <img id="cloud" src="assets/cloud.gif" alt="nuages">

    <h1><?php echo $ville . ' ' . '(' . $insee . ')';
        ?>
    </h1>
    <br>
    <br>
    <br>
    <div id="col">
        <div class="carre-legende" id="carre-legende">
            <h5>INDISPONIBLE <br> BON <br> MOYEN <br> DEGRADE <br> MAUVAIS <br> TRES MAUVAIS <br> TRES TRES MAUVAIS <br>
                EVENEMENT</h5>
            <div class="rond1" id="rond1"></div>
            <div class="rond2" id="rond2"></div>
            <div class="rond3" id="rond3"></div>
            <div class="rond4" id="rond4"></div>
            <div class="rond5" id="rond5"></div>
            <div class="rond6" id="rond6"></div>
            <div class="rond7" id="rond7"></div>
            <div class="rond8" id="rond8"></div>
        </div>



        <div class="carre-aiguille" id="carre-aiguille">
            <h3>QUALITE <br> DE L'AIR</h3>
            <p><?php if ($qualificatif == 'Moyen') {
                    echo '<img src="assets/moyen.png">';
                } elseif ($qualificatif == 'Bon') {
                    echo '<img src="assets/bon.png">';
                } else echo '<img src="assets/degrade.png">';
                echo '<br>';
                echo $qualificatif;
                ?></p>
        </div>
    </div>
    <br>
    <br>
    <br>

    <div id="idee">
        <img id="bulb" src="assets/ampoule.gif" />
        <h2>CONSEIL DU JOUR</h2>
    </div>
    <div class="conseil1" id="conseil1">
        <br>
        <p><?php if ($qualificatif == 'Moyen') {
                echo "Fumer irrite vos muqueuses fragilisées par les pollens.";
            } elseif ($qualificatif == 'Bon') {
                echo "Personnes allergiques Le chlore irrite vos muqueuses fragilisées par les pollens.";
            } else echo "Évitez les piscines.";
            ?></p>
    </div>
    <br>
    <br>

    <div class="conseil2" id="conseil2">
        <br>
        <p><?php if ($qualificatif == 'Moyen') {
                echo "Évitez les piscines.";
            } elseif ($qualificatif == 'Bon') {
                echo "Fumer irrite vos muqueuses fragilisées par les pollens.";
            } else echo "Personnes allergiques Le chlore irrite vos muqueuses fragilisées par les pollens.";
            ?></p>
        </p>
    </div>
    <br>
    <br>

    <div class="conseil3" id="conseil3">
        <br>
        <p><?php if ($qualificatif == 'Moyen') {
                echo "Personnes allergiques Le chlore irrite vos muqueuses fragilisées par les pollens.";
            } elseif ($qualificatif == 'Bon') {
                echo "Évitez les piscines.";
            } else echo "Fumer irrite vos muqueuses fragilisées par les pollens.";
            ?></p>
        </p>
    </div>
    <br>
    <br>
    <br>

    <button onclick="location.href='accueil.php'" type="button">
        Retour à l'accueil</button>

    <br>
    <br>
    <br>
    <h2>PARTENAIRES</h2>
    <div class="partenaires" id="partenaires">
        <br>
        <img src="assets/atmosud.png" class="atmosud" /> <img src="assets/region sud.png" class="regionsud" />
        <br>
    </div>



</body>

</html>