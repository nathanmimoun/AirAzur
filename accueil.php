<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Air Azur</title>
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>

    <?php

    // Création d'une variable date incluse dans l'url de la fonction curl pour récupérer en temps réel les données de l'API Atmosud selon la date actuelle en France

    date_default_timezone_set('Europe/Paris');
    $date = date('Y-m-d');


    // Deuxième requête curl

    $ch1 = curl_init();
    $url1 = "https://api.atmosud.org/prevision/commentaires/derniers";

    // configuration des options

    curl_setopt($ch1, CURLOPT_URL, $url1);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);

    // exécution de la session

    $b = curl_exec($ch1);
    $data1 = json_decode($b, true);

    // récupération de la valeur de commentaire

    if (isset($data1["$date"])) {
        $commentaire = $data1["$date"];
    } else {
    };

    // requête curl

    $ch2 = curl_init();
    $url2 = "https://api.atmosud.org/episodes/pref/actives";

    // configuration des options

    curl_setopt($ch2, CURLOPT_URL, $url2);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);

    // exécution de la session

    $c = curl_exec($ch2);
    $data2 = json_decode($c, true);

    // récupération de la valeur de la procédure préfectorale en cours

    if (isset($data2["titre"]['date-diffusion']["date"]["polluant_libelle"]["zone"]["zone_libelle"]["niveau"]["niveau_code"]["niveau_libelle"]["commentaire"])) {
        $procedure = $data2["titre"]+["titre"]['date-diffusion']["date"]["polluant_libelle"]["zone"]["zone_libelle"]["niveau"]["niveau_code"]["niveau_libelle"]["commentaire"];
    } else {
    };


    ?>
    <img src="assets/cloud.gif" alt="nuages">
    <div class="carre" id="carre">
        <br>
        <p><strong>Info du jour</strong><br>
        <?php echo $commentaire;
        ?></p>
    </div>
    <br>
    <br>
    <div class="text-center">
        <h1>CHOISIR UNE COMMUNE</h1>
        <br>
    </div>

    <nav role="navigation">
        <ul>
            <li class="recherche"><a href="#" class="texte-a" aria-haspopup="true">Choissisez votre ville ↓</a>
                <ul class="dropdown" aria-label="submenu">
                    <li class="ville"><a class="texte-a" href="donnees.php?ville=Toulon&insee=83137">Toulon</a></li>
                    <li class="ville"><a class="texte-a" href="donnees.php?ville=Frejus&insee=83061">Fréjus</a></li>
                    <li class="ville"><a class="texte-a" href="donnees.php?ville=Bandol&insee=83009">Bandol</a></li>
                    <li class="ville"><a class="texte-a" href="donnees.php?ville=Lavandou&insee=83070">Le Lavandou</a></li>
                    <li class="ville"><a class="texte-a" href="donnees.php?ville=Saint Tropez&insee=83119">Saint-Tropez</a></li>
                    <li class="ville"><a class="texte-a" href="donnees.php?ville=Saint Raphael&insee=83118">Saint-Raphaël</a></li>
                    <li class="ville"><a class="texte-a" href="donnees.php?ville=Cannes&insee=06029">Cannes</a></li>
                    <li class="ville"><a class="texte-a" href="donnees.php?ville=Antibes&insee=06004">Antibes</a></li>
                    <li class="ville"><a class="texte-a" href="donnees.php?ville=Nice&insee=06088">Nice</a></li>
                    <li class="ville"><a class="texte-a" href="donnees.php?ville=Menton&insee=06083">Menton</a></li>


                </ul>
            </li>
        </ul>
    </nav>

    <div class="carre" id="carre">
        <br>
        <p><strong>Proécure préfectorale actuelle</strong><br>
        <?php echo "Il semble qu'il n'y a aucune procédure préfectorale en vigueur en ce moment";
        ?></p>
    </div>


</body>

</html>