var moris;
var pourcent_ca;
var pourcent_cai;
var lab = [];
var prix_ca = [];
var prix_cai = [];
var int1 = new Intl.NumberFormat();
// fetch('/api/chart/')
// .then(res=>res.json())
// .then(data=>console.log(data))
$.ajax({
    url: "/api/chart",
    method: "GET",
    dataType: "json",
    success: function (data) {
        moris = data[0].chiffre;
        $("#paye").html(int1.format(moris.data.CA) + " <sup>F CFA</sup>");
        $("#impaye").html(int1.format(moris.data.CAI) + " <sup>F CFA</sup>");

        pourcent_ca = (moris.data.CA * 100) / (moris.data.CAI + moris.data.CA);
        pourcent_ca = Math.round(pourcent_ca);
        pourcent_cai =
            (moris.data.CAI * 100) / (moris.data.CAI + moris.data.CA);
        pourcent_cai = Math.round(pourcent_cai);
        data.forEach((c) => {
            lab.push(c.chiffre.mois);
            prix_ca.push(c.chiffre.data.CA);
            prix_cai.push(c.chiffre.data.CAI);
        });

        Morris.Donut({
            element: "morris_gross",

            data: [
                {
                    value: pourcent_ca,
                    label: "Payé",
                },
                {
                    value: pourcent_cai,
                    label: "Impayé",
                },
            ],

            labelColor: "#5969ff",

            colors: ["#5969ff", "rgba(255, 64, 123,.8)"],

            formatter: function (x) {
                return x + "%";
            },
            resize: true,
        });

        //Histogramme
        var ctx = document.getElementById("chartjs_balance_bar");
        var myChart = new Chart(ctx, {
            type: "bar",

            data: {
                labels: lab,
                datasets: [
                    {
                        label: "Chiffre d'afaire",
                        data: prix_ca,
                        backgroundColor: "rgba(89, 105, 255,.8)",
                        borderColor: "rgba(89, 105, 255,1)",
                        borderWidth: 2,
                    },
                    {
                        label: "Detes ",
                        data: prix_cai,
                        backgroundColor: "rgba(255, 64, 123,.8)",
                        borderColor: "rgba(255, 64, 123,1)",
                        borderWidth: 2,
                    },
                ],
            },
            options: {
                legend: {
                    display: true,

                    position: "bottom",

                    labels: {
                        fontColor: "#71748d",
                        fontFamily: "Circular Std Book",
                        fontSize: 14,
                    },
                },

                scales: {
                    xAxes: [
                        {
                            ticks: {
                                fontSize: 14,
                                fontFamily: "Circular Std Book",
                                fontColor: "#71748d",
                            },
                        },
                    ],
                    yAxes: [
                        {
                            ticks: {
                                fontSize: 14,
                                fontFamily: "Circular Std Book",
                                fontColor: "#71748d",
                            },
                        },
                    ],
                },
            },
        });
    },

    // pour les mois
});
