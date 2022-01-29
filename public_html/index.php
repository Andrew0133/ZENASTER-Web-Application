<?php
    session_start();
?>
<!DOCTYPE html>
<html len="en">
    <head>
        <title>Zenaster</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
 
        <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">   
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <script src="js/newsLetter.js"></script>
    </head>

    <body>
        <?php 
            require 'header.php'; 
        ?>
        <div class="content">
        
            <?php 
            // gestione errori 
            if(isset($_GET['error'])){
                    if($_GET['error'] === 'somethingWrong'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto" role="alert">
                                Ops qualcosa è andato storto :(
                            </div>';
                    }  
                }
                if(isset($_GET['error'])){
                    if($_GET['error'] === 'sendError'){
                        echo '<br><div id = "alertLogin" class="alert alert-danger text-center mx-auto" role="alert">
                                Ops qualcosa è andato storto :(
                            </div>';
                    }  
                }
                if(isset($_GET['message'])){
                    if($_GET['message'] === 'emailSuccess'){
                        echo '<br><div id = "alertLogin" class="alert alert-success text-center mx-auto" role="alert">
                                Email mandata con successo!! :)
                            </div>';
                    } 
                    if($_GET['message'] === 'subscribeSuccess'){
                        echo '<br><div id = "alertLogin" class="alert alert-success text-center mx-auto" role="alert">
                                Iscrizione avvenuta con successo!! :)
                            </div>';
                    }
                    if($_GET['message'] === 'passRestored'){
                        echo '<br><div id = "alertLogin" class="alert alert-success text-center mx-auto" role="alert">
                                Recupero password avvenuto con successo!!! :)
                            </div>';
                    } 
                    if($_GET['message'] === 'validPassUpdate'){
                        echo '<br><div id = "alertLogin" class="alert alert-success text-center mx-auto" role="alert">
                                Cambio password avvenuto con successo!!! :)
                            </div>';
                    }          
                }
            ?>
            <h1 class="display 1 text-center mx-auto customTitleText">Zenaster</h1>

            <!-- CHI SIAMO -->
            <div class="container-fluid theMargin">
                <div class="customRow">
                    <h3 class="display 3 subtitles">La nostra storia</h3>
                    <hr>
                </div>
                <div class="row">
                    <img src="photos/primo_blockbuster.jpg" alt="primo blockbuster" class="mx-auto img-fluid around">
                </div>
                <div class="row">
                    <small class="text-muted mx-auto ">-Primo negozio di blockbuster (1985)</small>
                </div>
                <br>
                <div class="row">
                    <p class=""> Il primo negozio Blockbuster viene aperto a Dallas, in Texas, nel 1985. Nei successivi dieci anni il numero dei negozi raggiunge, 
                        solo negli Stati Uniti, il numero di 4800. Nel frattempo nel 1989 l'azienda acquista una preesistente catena inglese e apre il primo negozio in Europa. 
                        Negli anni 1990, Blockbuster apre in 25 paesi, tra cui Canada, Australia, Nuova Zelanda, Giappone, Svizzera, Gran Bretagna, Portogallo, Danimarca, 
                        Israele, Messico, Argentina e Italia, dove Blockbuster sbarca nel 1994 attraverso una joint venture con Standa-Fininvest. 
                        Nel 1994 Blockbuster è acquistata dalla Viacom, una società di intrattenimento e comunicazioni statunitense.
                        Verso la fine degli anni 2000 ha inizio un periodo di forte crisi per l'azienda. Le difficoltà di Blockbuster, in nazioni come gli Stati Uniti, 
                        sono legate al successo di servizi analoghi come quello offerto dalla concorrente Netflix. In questo periodo sono diversi i paesi, tra cui Spagna e Portogallo, 
                        in cui l'azienda abbandona immediatamente il mercato; in altri, come l'Italia, ha invece luogo un pesante ridimensionamento che, in molti casi, a posteriori 
                        è solo il preludio a ulteriori liquidazioni e abbandoni. Le difficoltà economiche di Blockbuster si protraggono anche nel 2010, anno in cui 
                        si inizia a paventare l'ipotesi di avviare una procedura fallimentare. Lo stesso anno l'azienda dichiara bancarotta appellandosi al Chapter 11 della legge 
                        fallimentare statunitense, tentando una ristrutturazione aziendale incentrata prettamente sulla nascente distribuzione digitale.
                        Nel 2011 Blockbuster cerca il rilancio attraverso la cessione a Dish Network. Nel frattempo, tuttavia, viene annunciato l'abbandono del mercato canadese,
                        cui segue nel 2012 anche quello italiano. L'anno seguente Dish Network annuncia la chiusura di ulteriori 300 negozi negli Stati Uniti: 
                        la notizia, di fatto, sancisce la fine di un'epoca, quella del noleggio «fisico» di prodotti audiovisivi. Dal 2019 sopravvive un unico negozio Blockbuster 
                        al mondo, presso la cittadina di Bend, in Oregon, che per le caratteristiche del luogo (scarsamente popolato e dunque poco connesso a Internet) nonché 
                        per la particolarità rappresentata, attira simpatizzanti e nostalgici, e prosegue positivamente l'attività; nonostante usi il logo e il nome della catena, 
                        il negozio è autonomo e di proprietà dei suoi gestori.
                        Nel 2020, viene aperto un negozio Web, una variante del Blockbuster, il Zenaster che ha portato un grande successo al marchio dando speranza di ripresa.
                        Molti dicono che la loro efficienza e' legata alla struttura del loro sito web.   
                        </p>
                </div>
            </div>
            <!-- /CHI SIAMO -->

            <!-- NEWS PRODOTTI -->
            <div class="container-fluid theMargin">
                <div class="customRow">
                    <a href="products.php"><button type="button" class="btn btn-outline-warning subtitles img-fluid">SCROPRI I NOSTRI PRODOTTI</button></a>
                </div>
            </div>
            <!-- /NEWS PRODOTTI -->
            
            <!-- SERVIZI -->
            <div class="container-fluid theMargin">
                <div class="customRow">
                    <h3 class = "subtitles"> Services</h3>
                    <hr>
                </div>
                <section class="section-services">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="single-service around">
                                    <div class="part-1">
                                        <i class="fab fa-500px"></i>
                                        <h3 class="title ">Spedizione in 48h disponibile in tutta italia</h3>
                                    </div>
                                    <div class="part-2">
                                        <p class="description ">Spedizioni in tutta Italia veloci ed affidabili (Isole 72h).</p>
                                        <a href="#" class=""><i class="fas fa-arrow-circle-right"></i>Read More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 ">
                                <div class="single-service around">
                                    <div class="part-1">
                                        <i class="fab fa-angellist"></i>
                                        <h3 class="title ">Servizio di assistenza disponibile 24h su 24h</h3>
                                    </div>
                                    <div class="part-2">
                                        <p class="description ">Operatori sempre pronti a dare assistenza in qualsiasi momento.</p>
                                        <a href="#" class=""><i class="fas fa-arrow-circle-right"></i>Read More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="single-service around">
                                    <div class="part-1">
                                        <i class="fas fa-award"></i>
                                        <h3 class="title ">Miglior venditore online di film in Italia</h3>
                                    </div>
                                    <div class="part-2">
                                        <p class="description ">Vincitori per efficienza, velocità ed assistenza al cliente.</p>
                                        <a href="#" class=""><i class="fas fa-arrow-circle-right"></i>Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- /SERVIZI -->

            <!-- NEWSLETTER -->
            <div id = "newsLetter" class="newseletter theMargin">
                <?php 
                // gestione errore newsletter
                if(isset($_GET['error'])){
                        if($_GET['error'] === 'newsletter_error'){
                            echo '<div id = "alertLogin" class="alert alert-danger text-center mx-auto" role="alert">
                                    Ops qualcosa è andato storto, non siamo riusciti ad iscriverti :(
                                </div>';
                        }  
                    }
                ?>
                <div class="customRow">
                    <h3 class = "subtitles">Iscriviti alla newsletter</h3>
                    <hr>
                </div>
                <form action="subscribeNewsletter.php" method="post">
                    <div class="row justify-content-center">
                            <input type="email" class="form-control customFormInput newsletterCustomInput" id ="email" name="email" aria-describedby="emailHelp" placeholder="Indirizzo email">
                        </div>
                        <br>
                        <div class="row justify-content-center">
                            <input type="submit" class="btn btn-primary confermButton" name="btnNews" value="Iscriviti!">
                        </div>
                </form>
            </div> 
            <!-- /NEWSLETTER -->

            <!-- CONTACT US --> 
            <div class="container-fluid theMargin"></div>
                <div class="customRow">
                    <h3 class = "subtitles"></h3>
                </div>
            </div>
            <div class="container-fluid theMargin">
                <div class="customRow">
                    <h3 class = "subtitles">Contact Us</h3>
                    <hr>
                </div>
                <div class="customRow">
                    <div class="text-center">
                        <h4 class="">Ci potete trovare in cima al monte Everest : </h4><br>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14092.752682155075!2d86.91622033737868!3d27.988138820977046!2m3!1f0!2f0!3f0!3m2!1i
                        1024!2i768!4f13.1!3m3!1m2!1s0x39e854a215bd9ebd%3A0x576dcf806abbab2!2sMonte%20Everest!5e0!3m2!1sit!2sit!4v1605380711493!5m2!1sit!2sit" id = "map" width="800" 
                        height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" class = "img-fluid around chMap"></iframe>
                        <h4 class="">I nostri contatti sono : </h4><br>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#!" class=""><i class="fas fa-envelope"></i> Email: mail.inventata@ufo.nasa</a>
                            </li>
                            <li>
                                <a href="#!" class=""><i class="fas fa-phone"></i> Tel: +3935728921</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /CONTACT US -->
        </div>
        <?php 
            require 'footer.php'; 
        ?>
    
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>