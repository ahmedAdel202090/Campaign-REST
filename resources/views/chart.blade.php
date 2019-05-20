<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chart</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body>
    <form id="draw" method="POST">
        <div class="form-group">
            <label for="x">dimensionX:</label>
            <select class="form-control" id="x" name="x">
                <option value="name">name</option>
                <option value="country">country</option>
                <option value="budget">budget</option>
                <option value="goal">goal</option>
                <option value="category">category</option>
            </select>
        </div>
        <div class="form-group">
            <label for="y">dimensionY:</label>
            <select class="form-control" id="y" name="y">
                <option value="name">name</option>
                <option value="country">country</option>
                <option value="budget">budget</option>
                <option value="goal">goal</option>
                <option value="category">category</option>
            </select>
        </div>
        <button class="btn btn-success">Draw</button>
    </form>
    <div id="columnchart_values" style="width: 900px; height: 300px;"></div>

    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    var result=new Array(['Element', 'Density', {role: 'style'}, {role: 'annotation'}]);
    var dimensions=[];
    $("#draw").submit(function(event) {
        event.preventDefault();
        var formData = $("#draw").serialize();
        $.ajax({
            url: "http://localhost/Campaign-REST/public/campaign/get",
            type: "GET",
            dataType:"json",
            data: formData,
            success: 
            function(data) {
                dimensions=[data.dimensions[0],data.dimensions[1]];
                data.campaigns.forEach(function(campaign){
                    result.push([campaign.country,campaign.density,'#b87333',campaign.category]);
                });
                start();
            }

        });
    });
    /*var cat1='Sports';
    var cat2='Techniqals';
    var cat11v=3;
    var cat21v=5;
    var cont1='Egypt';
    var cat12v=4;
    var cat22v=3;
    var cont2='USA';


  
    
    */
    function start(){
        google.charts.load("current", {
                packages: ['corechart']
            });
        google.charts.setOnLoadCallback(drawChart);

    }
    
    function drawChart() {
        var data = google.visualization.arrayToDataTable(result);
        var view = new google.visualization.DataView(data);
        var options = {
            title: "Analysis By "+dimensions[0]+" and "+dimensions[1],
            width: 600,
            height: 400,
            bar: {
                groupWidth: "95%"
            },
            legend: {
                position: "none"
            },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(view, options);
        result=new Array(['Element', 'Density', {role: 'style'}, {role: 'annotation'}]);
        dimensions=new Array();
    }
    </script>
</body>

</html>