<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gráficos Fotochecks</title>
</head>

<style>
    .circle {
        display: block;
        width: 200px;
        height: 70px;
        padding-bottom: .7rem;
    }
    .text-center {
        display: inline-block;
        text-align: center;
        font-size: 1.1em;
    }
    .header-title {
        display: inline-block;
        margin-left: 7rem;
        margin-top: -20;
    }
    .font-color {
        color: #1F2937;
    }
    .center {
        text-align: center;
    }
    .font-color-white {
        color: white;
    }
</style>

<body>
    <div class="header">
        <img src="{{ asset('img/logo.png') }}" alt="Minucipalidad De Castilla" class="circle">
        <span class="text-center header-title font-color">
            <strong >MUNICIPALIDAD DISTRITAL DE CASTILLA
                <br> {{ $area->title }}
                <br> {{ $area->sub_title }}
            </strong>
        </span>
    </div>

    <img src="https://quickchart.io/chart?w=350&h=350&format=svg&c={
        type:'bar',
        data:{
            labels:{{json_encode(request()->labelsBar)}},
            datasets:[{
                label:{{json_encode(request()->datasetsBar[0]['name'])}},
                data:{{json_encode(request()->datasetsBar[0]['values'])}},
                backgroundColor:'rgba(23, 162, 184, 1)',
            },{
                label:{{json_encode(request()->datasetsBar[1]['name'])}},
                data:{{json_encode(request()->datasetsBar[1]['values'])}},
                backgroundColor:'rgba(255, 193, 7, 1)',
            },{
                label:{{json_encode(request()->datasetsBar[2]['name'])}},
                data:{{json_encode(request()->datasetsBar[2]['values'])}},
                backgroundColor:'rgba(255, 99, 132, 0.8)',
            }]
        },options:{title:{display:true,text:'Gráfico de Fotochecks - {{now()->format('Y')}}'}}}"
    />
    
    <img src="https://quickchart.io/chart?w=350&h=350&format=svg&c={
        type:'doughnut',
        data:{
            labels:{{json_encode(request()->labelsPie)}},
            datasets:[{
                data:{{json_encode(request()->datasetsPie)}},
                backgroundColor:{{json_encode(request()->dataPieOptions['backgroundColor'])}},
                borderColor:{{json_encode(request()->dataPieOptions['borderColor'])}},
                borderWidth: 1
            }]
        },options:{title:{display:true,text:'Gráfico de Fotochecks'}}}"
    />

    <img src="https://quickchart.io/chart?w=350&h=350&format=svg&c={
        type:'line',
        data:{
            labels:{{json_encode(request()->labelsLine)}},
            datasets:[{
                label:{{json_encode(request()->datasetsLine[0]['name'])}},
                data:{{json_encode(request()->datasetsLine[0]['values'])}},
                borderColor:'rgba(23, 162, 184, 1)',
                fill:false
            },{
                label:{{json_encode(request()->datasetsLine[1]['name'])}},
                data:{{json_encode(request()->datasetsLine[1]['values'])}},
                borderColor:'rgba(255, 193, 7, 1)',
                fill:false
            },{
                label:{{json_encode(request()->datasetsLine[2]['name'])}},
                data:{{json_encode(request()->datasetsLine[2]['values'])}},
                borderColor:'rgba(255, 99, 132, 0.8)',
                fill:false
            }]
        },options:{title:{display:true,text:'Gráfico de Fotochecks Por Años'}}}"
    />
</body>
</html>