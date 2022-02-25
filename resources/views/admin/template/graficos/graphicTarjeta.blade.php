<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    {{-- <a href="https://quickchart.io/chart?c={
        type:'bar',
        data:{
            labels:[2012,2013,2014,2015,2016],
            datasets:[{
                label:'Users xD',
                data:[120,60,50,180,120]
                }]
            }}&format=pdf"
        target="_blank"
    >
        Wee
    </a> --}}

    {{-- {{ dd(request()->datasetsLine[0]['values']) }} --}}
    {{-- {{ dd(request()->datasetsBar[2]['options']['backgroundColor']) }} --}}
    {{-- <p>{{dd(json_encode(request()->chart['labels'], true))}}</p> --}}

    {{-- {{ dd(request()->dataPieOptions['backgroundColor']) }} --}}

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
        },options:{title:{display:true,text:'Gráfico de Tarjetas - {{now()->format('Y')}}'}}}"
    />
    {{-- <img src="https://quickchart.io/chart?w=300&h=450&format=svg&c={type:'bar',data:{labels:[2012,2013,2014,2015,2016],datasets:[{label:'Users',data:[120,60,50,180,120]}]}}" /> --}}

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
        },options:{title:{display:true,text:'Gráfico de Tarjetas'}}}"
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
        },options:{title:{display:true,text:'Gráfico de Tarjetas Por Años'}}}"
    />
    {{-- <img src="https://quickchart.io/chart?w=350&h=350&format=svg&c={type:'line',data:{labels:['January','February', 'March','April', 'May'], datasets:[{label:'Dogs', data: [50,60,70,180,190], fill:false,borderColor:'blue'},{label:'Cats', data:[100,200,300,400,500], fill:false,borderColor:'green'}]}}"> --}}
</body>
</html>