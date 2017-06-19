<!doctype html>
<html>

<head>
    <title>Kukurudza stats</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

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
        <canvas id="canvas"></canvas>
    </div>
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

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myLine = new Chart(ctx, config);
    };

</script>
</body>

</html>
