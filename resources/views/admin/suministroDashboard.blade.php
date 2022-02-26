@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info" style="height: 6rem;">
                    <div class="inner">
                        <h3>{{ $countAllPvc->conteo_monto_pvc }}</h3>

                        <p>PVC de {{ $countAllPvc->monto_pvc }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning" style="height: 6rem;">
                    <div class="inner">
                        <h3>{{ $countAllPvc->conteo_monto_cinta }}</h3>

                        <p>Cintas de {{ $countAllPvc->monto_cinta }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-print"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger" style="height: 6rem;">
                    <div class="inner">
                        <h3>{{ $countAllPvc->conteo_monto_holograma }}</h3>

                        <p>Hologramas de {{ $countAllPvc->monto_holograma }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-print"></i>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.graphic.suministro',
            ['labelsBar'=> $labelsBar, 'datasetsBar'=> $datasetsBar,
            'labelsPie'=> $labelsPie, 'datasetsPie'=> $datasetsPie, 'dataPieOptions'=> $dataPieOptions,
            'labelsLine'=> $labelsLine, 'datasetsLine'=> $datasetsLine]) }}"
            class="row justify-content-center mt-2"
            target="_blank"
        >
            Descargar Reporte
        </a>

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
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
@endpush