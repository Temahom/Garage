<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="faccture.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            *,
            *:before,
            *:after {
                box-sizing: border-box;
                outline: none;
                border: none;
                margin: 0;
                padding: 0;
                list-style: none;
                cursor: default;
                }

            html,
            body {
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                background: white;
                }
            #bill {
                border: 1px solid;
                width: 60%;
                height: 100%;
                margin: 3em 0;
                }
            #header {
                width: 100%;
                height: 50%;
                padding: 3% 5%;
                border: 1px solid;
                }
            #header .row {
                display: inline-block;
                width: 100%;
                }
            #header .info {
                display: flex;
                margin-top: 15px;
                }
            .legal {
                margin-top: 15px;
                }
            h1 {
                font-weight: lighter;
                letter-spacing: 0.03em;
                position: relative;
                display: inline-block;
                margin-bottom: 5%;
                
                }
            h1::after {
                content: " ";
                width: 100%;
                height: 1px;
                background: white;
                position: absolute;
                bottom: -5px;
                left: 0;
                }
            img {
                float: right;
                position: relative;
                width: 10%;
                height: 1%;
                margin-right: 7%;
                }
            img::after {
                content: " ";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(10, 5, 37, 1);
                }
            .section {
                float: left;
                margin: 1px;
                }
            .section label {
                    display: block;
                }
            .section li {
                    height: 25px;
                }
            .section span {
                    display: inline-block;
                    margin-top: 0.5em;
                    letter-spacing: 0.02em;
                }
            #content {
                background: white;
                width: 100%;
                display: flex;
                flex-direction: column;
                padding: 4em 3em;
                }
            #content .table {
                width: 100%;
                }
            #content .header {
                width: 100%;
                border-bottom: 1px solid lightgray;
                font-size: 15px;
                padding-bottom: 10px;
                }
            #content .header .heading {
                display: inline-block;
                font-weight: bold;
                }
            #content .three-fifth {
                width: 64%;
                }
            #content .items {
                width: 100%;
                margin-top: 1.5em;
                }
            #content .items .item {
                display: inline-block;
                width: 100%;
                }
            #content .items .item span {
                    display: inline-block;
                    float: left;
                    margin: 0.2% 0;
                }
            #content .items .item span .three-fifth {
                    width: 65%;
                    }
            .total {
                border-top: 1px solid lightgray;
                font-weight: 500;
                margin-top: 1em;
                padding-top: 1em;
                letter-spacing: 0.02em;
                }
            .total span {
                display: inline-block;
                font-weight: bold;
                }
            hr {
                height: 1px;
                margin-top: 5em;
                background: lightgray;
                }
            .information {
            width: 100%;
            margin-top: 2em;
                }
            .notes {
                width: 100%;
                padding-left: 1em;
                }
            .notes  h3 {
                text-decoration: underline;
                font-weight: bold;
                letter-spacing: 0.03em;
                font-size: 1.1em;
                }
            .notes p {
                margin: 30px 20px;
                letter-spacing: 2px;
                font-weight: 400;
                font-size: 0.9em;
                }
        </style>
    </head>
    <body>
        <div id="bill">
            <div id="header">
                <div class="row heading">
                    <h1>FACTURE</h1>
                    <img src="http://garage-saka.herokuapp.com/assets/images/logo.png" alt="image" width="217px" height="184px" viewBox="0 0 217 184" version="1.1">
                </div>
                <div class="row info">
                    <div class="section">
                        <label style="line-height: 25px;"><strong style="text-decoration: underline; letter-spacing: 2px;">DATE:</strong> <br>   17-01-2020</label> 
                    </div>
                    <br>
                    <div class="section">
                        <label style="margin-left: 30%; line-height: 25px;"><strong style="text-decoration: underline; letter-spacing: 2px;">FACTURE N°:</strong>   1801-01</label>
                    </div>
                </div>
                <hr style="width: 50%; margin-top: -0.09%;">
                <div class="row legal">
                    <div class="section">
                        <label style="text-decoration: underline; letter-spacing: 2px;"><strong>EMIS PAR :</strong></label>
                        <ul>
                            <li>
                                <span>SAKA</span>
                            </li>
                            <li>
                                <span>Sector 32, Street 49, Choueifat - Lebanon   </span>
                            </li>
                            <li>
                                <span><a class="phone" href="tel:77 719 93 89">77 719 93 89</a>
                                <span class="line"></span>
                            </li>
                            <li>
                                <span><a class="email" href="mailto:allouch.nabil@sakatrading.com">allouch.nabil@sakatrading.com</a></span>
                            </li>
                        </ul>
                    </div>
                    <div class="section" style="margin-left: 20%;">
                        <label><strong style="text-decoration: underline; letter-spacing: 2px;">A L'ATTENTION DE :</strong></label>
                        <ul>
                            <li>
                                <span>Hewlett Packard</span>
                            </li>
                            <li>
                                <span>SIRET 824 020 267 00012</span>
                            </li>
                            <li>
                                <span>153 Avenue Maurice Donat, Bâtiment B</span>
                            </li>
                            <li>
                                <span>06300 Mougins</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="content">
                <div class="table">
                    <div class="header">
                        <span class="heading three-fifth">DESCRIPTION</span>
                        <span class="heading">QUANTITE</span>
                        <span class="heading" style="margin-left: 12.5%;">TOTAL HT</span>
                    </div>
                    <div class="items">
                        <div class="item">
                            <span class="three-fifth">Conception d'un menu</span>
                            <span style="width: 10%; text-align: center;">5 jours</span>
                            <span style="width: 10%; text-align: center; margin-left: 13%; width: 12%;">1 800 €</span>
                        </div>
                        <div class="item">
                            <span class="three-fifth">Maquettage d'un menu</span>
                            <span style="width: 10%; text-align: center;">12 jours</span>
                            <span style="width: 10%; text-align: center; margin-left: 13%; width: 12%;">4 500 €</span>
                        </div>
                        <div class="item">
                            <span class="three-fifth">Conception d'une base de données</span>
                            <span style="width: 10%; text-align: center;">55 jours</span>
                            <span style="width: 10%; text-align: center;margin-left: 13%; width: 12%;">38 760 €</span>
                        </div>
                    </div>
                    <div class="total">
                        <span class="three-fifth heading">TOTAL</span>
                        <span style="width: 10%; text-align: center;">72 jours</span>
                        <span style="margin-left: 13%; width: 11%; text-align: center;">45 060 €</span>
                    </div>
                </div>
                <hr />
                <div class="information">
                    <div class="notes">
                        <h3>NOTES:</h3>
                        <p>Règlement avant le            . 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>