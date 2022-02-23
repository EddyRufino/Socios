@extends('admin.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="d-flex mt-2 align-items-center justify-content-between">
                    <h2 class="mt-4 title-left pt-3 pb-2 font-weight-bold">Filtrar Socios</h2>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <form method="GET" action="{{ route('filtro.socio.store') }}">
                            @csrf

                            <div class="col-md-12 mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Fecha de Creación</label>
                                        <div class="col-md-">
                                            <label>Desde:</label>
                                            <input class="form-control" type="date" name="dateStart" min="2018-01-01" max="2030-12-31" value="2019-01-01">
                                        </div>
                                        
                                        <div class="col-md-">
                                            <label>Hasta:</label>
                                            <input class="form-control" type="date" name="dateLast" min="2018-01-01" max="2030-12-31" value="<?php echo date("Y-m-d", strtotime("+4 year"));?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Fecha de Vigencia</label>
                                        <div class="col-md-">
                                            <label>Desde:</label>
                                            <input class="form-control" type="date" name="dateStartVigencia" min="2018-01-01" max="2030-12-31" value="2019-01-01">
                                        </div>
                                        
                                        <div class="col-md-">
                                            <label>Hasta:</label>
                                            <input class="form-control" type="date" name="dateLastVigencia" min="2018-01-01" max="2030-12-31" value="<?php echo date("Y-m-d", strtotime("+4 year"));?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="custom-control custom-checkbox d-flex">
                            
                                            <input type="checkbox" name="checkDatePrint" class="custom-control-input" id="myCheck" onclick="myFunction()">
                                            <label class="custom-control-label" for="myCheck">Fecha de Impresión</label>
                            
                                        </div>
                                        <div id="checkDatePrint" class="mt-2" style="display: none;">
                                            <div class="col-md-">
                                                <label>Desde:</label>
                                                <input class="form-control" type="date" name="dateStartPrint" min="2018-01-01" max="2030-12-31" value="2019-01-01">
                                            </div>
                                            
                                            <div class="col-md-">
                                                <label>Hasta:</label>
                                                <input class="form-control" type="date" name="dateLastPrint" min="2018-01-01" max="2030-12-31" value="<?php echo date("Y-m-d", strtotime("+4 year"));?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Vehículo</label>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" name="vehiculo_id[]" value="1" type="checkbox" checked>
                                            <label class="form-check-label">MotoTaxi</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" name="vehiculo_id[]" value="2" type="checkbox">
                                            <label class="form-check-label">Moto Furgón</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label>Tipo Socio</label>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" name="socio" value="1" type="checkbox" checked>
                                            <label class="form-check-label">Socio</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" name="natural" value="2" type="checkbox">
                                            <label class="form-check-label">Natural</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" name="juridica" value="3" type="checkbox">
                                            <label class="form-check-label">Jurídica</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Diseño</label>
                                    <div class="form-group">
                                        @foreach ($disenios as $disenio)
                                            <div class="form-check">
                                                <input class="form-check-input" name="disenio_id[]"
                                                    value="{{ $disenio->id }}"
                                                    type="checkbox"
                                                    checked
                                                >
                                                <label class="form-check-label">{{ $disenio->nombre }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Modelo</label>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" name="tarjeta" value="1" type="checkbox" checked>
                                            <label class="form-check-label">Tarjeta</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" name="fotocheck" value="2" type="checkbox">
                                            <label class="form-check-label">Fotocheck</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label>Impreso</label>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" name="print[]" value="0" type="checkbox" checked>
                                            <label class="form-check-label">No</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" name="print[]" value="1" type="checkbox" checked>
                                            <label class="form-check-label">Sí</label>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            {{-- <div class="col-md-12 mb-3">
                                <label>Ingresa Fecha de Creación</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Desde:</label>
                                        <input class="form-control" type="date" name="dateStart" min="2018-01-01" max="2030-12-31" value="2019-01-01">
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label>Hasta:</label>
                                        <input class="form-control" type="date" name="dateLast" min="2018-01-01" max="2030-12-31" value="<?php echo date("Y-m-d", strtotime("+4 year"));?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Ingresa Fecha de Vigencia</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Desde:</label>
                                        <input class="form-control" type="date" name="dateStartVigencia" min="2018-01-01" max="2030-12-31" value="2019-01-01">
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label>Hasta:</label>
                                        <input class="form-control" type="date" name="dateLastVigencia" min="2018-01-01" max="2030-12-31" value="<?php echo date("Y-m-d", strtotime("+4 year"));?>">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="form-group row mb-0 d-flex justify-content-end">
                                <div class="col-md-6 offset-md-4 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        Filtrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function myFunction() {
        let check = document.getElementById("myCheck");
        let checkDatePrint = document.getElementById("checkDatePrint");

        if (check.checked == true){
            checkDatePrint.style.display = "block";
        } else {
            checkDatePrint.style.display = "none";
        }
    }

</script>
@endpush
