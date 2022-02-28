@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info" style="height: 6rem;">
                    <div class="inner">
                        <h3>{{ $countAllFotochecks->implode('') }}</h3>

                        <p>Total Fotochecks</p>
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

        <div class="row justify-content-center mt-3">
            <div class="col-md-10">
                {!! $chart->container() !!}

                {!! $chart->script() !!}
            </div>
        </div>

        <div class="row justify-content-center mt-4 mb-4">
            <div class="col-md-6">
                {!! $chartYear->container() !!}

                {!! $chartYear->script() !!}
            </div>

            <div class="col-md-6">
                {!! $chartPie->container() !!}

                {!! $chartPie->script() !!}
            </div>
        </div>

        <div class="container d-flex justify-content-center align-items-center">
            <p>Descarga los gráficos
                <a class="block" href="{{ route('admin.graphic.fotocheck',
                    ['labelsBar'=> $labelsBar, 'datasetsBar'=> $datasetsBar,
                    'labelsPie'=> $labelsPie, 'datasetsPie'=> $datasetsPie, 'dataPieOptions'=> $dataPieOptions,
                    'labelsLine'=> $labelsLine, 'datasetsLine'=> $datasetsLine]) }}"
                    class="row justify-content-center mt-2"
                    target="_blank"
                >
                    aquí
                </a>
            </p>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.2/dist/Chart.js"></script> --}}
@endpush