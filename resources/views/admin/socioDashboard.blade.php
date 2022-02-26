@extends('admin.layout')

@section('content')
    <div class="container">
        {{-- <div class="row justify-content-center"> --}}
            <div class="row justify-content-center mt-2">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info" style="height: 6rem;">
                        <div class="inner">
                            <h3>{{ $countAllSocios->implode('') }}</h3>

                            <p>Socios</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-id-card"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning" style="height: 6rem;">
                        <div class="inner">
                            <h3>{{ $allNatural->implode('') }}</h3>

                            <p>P. Natural</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary" style="height: 6rem;">
                        <div class="inner">
                            <h3>{{ $allJuridica->implode('') }}</h3>

                            <p>P. Jurídica</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-secondary" style="height: 6rem;">
                        <div class="inner">
                            <h3>{{ $allExtranjeros->implode('')}}</h3>

                            <p>Extranjeros</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.graphic.socio',
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
        {{-- </div> --}} 
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
@endpush