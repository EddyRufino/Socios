@extends('admin.layout')

@section('content')
    <div class="container">
        {{-- <div class="row justify-content-center"> --}}
            <div class="row justify-content-center mt-2">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info" style="height: 6rem;">
                        <div class="inner">
                            <h3>{{ $countAllTarjetas->implode('') }}</h3>

                            <p>Total Tarjetas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning" style="height: 6rem;">
                        <div class="inner">
                            <h3>{{ $countPrint->implode('') }}</h3>

                            <p>Impresas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-print"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger" style="height: 6rem;">
                        <div class="inner">
                            <h3>{{ $countNotPrint->implode('') }}</h3>

                            <p>No Impresas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-print"></i>
                        </div>
                    </div>
                </div>
            </div>
            {{-- {{dd(request()->chart)}} --}}
            <a href="{{ route('admin.graphic.tarjeta',
                ['labelsBar'=> $labelsBar, 'datasetsBar'=> $datasetsBar,
                'labelsPie'=> $labelsPie, 'datasetsPie'=> $datasetsPie, 'dataPieOptions'=> $dataPieOptions,
                'labelsLine'=> $labelsLine, 'datasetsLine'=> $datasetsLine]) }}"
                class="row justify-content-center mt-2"
                target="_blank"
            >
                Descargar Reporte
            </a>
            {{-- <a href="https://quickchart.io/chart?c={{$json}}" target="_blank">Wee</a> --}}
            {{-- <a href="https://quickchart.io/chart?c={
                type:'bar',
                data:{
                    labels:[2012,2013,2014,2015,2016],
                    datasets:[{
                        label:'Users xD',data:[120,60,50,180,120]
                        }]
                    }}&format=pdf"
                target="_blank"
            >
                Wee
            </a> --}}

            <div class="row justify-content-center mt-3">
                <div class="col-md-10">
                    {!! $chart->container() !!}

                    {!! $chart->script() !!}
                </div>
            </div>

            <div class="row justify-content-center mt-4 mb-4">
                <div class="col-md-10">
                    {!! $chartPie->container() !!}

                    {!! $chartPie->script() !!}
                </div>
            </div>

            <div class="row justify-content-center mt-4 mb-4">
                <div class="col-md-10">
                    {!! $chartYear->container() !!}

                    {!! $chartYear->script() !!}
                </div>
            </div>
        {{-- </div> --}}
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
@endpush