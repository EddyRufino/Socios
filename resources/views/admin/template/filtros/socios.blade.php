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
                                    {{-- <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Año Inicio</label>
                                            <select class="form-control" name="anio_start">
                                                <option>-</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Mes Inicio</label>
                                            <select class="form-control" name="mes_start">
                                                <option>-</option>
                                                <option value="01">01</option>
                                                <option value="02">02</option>
                                                <option value="03">03</option>
                                                <option value="04">04</option>
                                                <option value="05">05</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="09">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-1"></div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Año Fin</label>
                                            <select class="form-control" name="anio_last">
                                                <option>-</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Mes Fin</label>
                                            <select class="form-control" name="mes_last">
                                                <option>-</option>
                                                <option value="01">01</option>
                                                <option value="02">02</option>
                                                <option value="03">03</option>
                                                <option value="04">04</option>
                                                <option value="05">05</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="09">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </div>
                                    </div> --}}
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
                                    {{-- <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" name="impreso" type="radio" name="radio1">
                                            <label class="form-check-label">Impreso</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" name="noImpreso" type="radio" name="radio1" checked="">
                                            <label class="form-check-label">No Impreso</label>
                                        </div>
                                    </div> --}}
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
                                {{-- <div class="col-sm-3">
                                    <label>Asociación</label>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" name="vehiculo_id[]" value="1" type="checkbox" checked>
                                            <label class="form-check-label">Sí</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" name="vehiculo_id[]" value="2" type="checkbox">
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-sm-3">
                                    <label>Elija</label>
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
                                            <input class="form-check-input" name="print[]" value="1" type="checkbox">
                                            <label class="form-check-label">Sí</label>
                                        </div>
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
                            </div>
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