<!doctype html>
<html>

<head>
    <title>Kukurudza stats</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-5SSLJHC');</script>
    <!-- End Google Tag Manager -->

</head>

<body>

<div class="container">

    <div class="page-header">
        <h1><a href="https://telegram.me/kukurudzabot">@kukurudzabot</a> stats</h1>
        <p class="lead">Main metrics for a week</p>
    </div>

    <div class="row">
        <div class="col-xs-4">
            <h2>{{events.total}}</h2>
            <p>Playbill requests</p>

        </div>
        <div class="col-xs-4">
            <h2>{{events.found_avg}}</h2>
            <p>Playbills in answer</p>
        </div>
        <div class="col-xs-4">
            <h2>{{events.not_found}}</h2>
            <p>Empty answers</p>
        </div>
    </div>

    <div class="row">
        <canvas id="users_chart"></canvas>
    </div>

    <div class="row">
        <h2>Playbill requests by hour</h2>
        <canvas id="hours_chart"></canvas>
    </div>

    <footer>
        <p>by the way, follow this project on <a href="https://github.com/dontgiveafish/kukurudza-stats">github</a></p>
    </footer>

</div>

<script>

    var charts = {{{charts}}};

    var config = {
        type: 'line',
        data: {
            labels: Object.keys(charts.requests_per_day),
            datasets: [{
                label: "Playbill requests",
                backgroundColor: "rgb(255, 99, 132)",
                borderColor: "rgb(255, 99, 132)",
                data: Object.values(charts.requests_per_day),
                fill: false
            }, {
                label: "Users",
                backgroundColor: "rgb(54, 162, 235)",
                borderColor: "rgb(54, 162, 235)",
                data: Object.values(charts.users_per_day),
                fill: false,
            }]
        }
    };

    var config2 = {
        type: 'bar',
        data: {
            labels: Object.keys(charts.users_per_hour),
            datasets: [{
                label: "Playbill requests",
                backgroundColor: "rgb(255, 99, 132)",
                borderColor: "rgb(255, 99, 132)",
                data: Object.values(charts.users_per_hour),
            }]
        }
    };

    window.onload = function() {
        var users_chart = document.getElementById("users_chart").getContext("2d");
        window.myLine = new Chart(users_chart, config);

        var hours_chart = document.getElementById("hours_chart").getContext("2d");
        window.myLine = new Chart(hours_chart, config2);


    };

</script>
</body>

</html>
