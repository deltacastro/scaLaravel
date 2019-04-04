@extends('layouts.form.formGeneral') 
@section('styles')
<style>
    #cont {
        margin-top: 10%;
    }

    .container {
        left: 300px;
        right: 0px;
        position: absolute;
        width: 40%;
    }

    .responsive-img {
        width: 100% !important;
        margin-bottom: 20px;
    }
</style>
@endsection
 
@section('form-body')
<div class="container">
    <div class="row">
        <div class="animated fadeIn delay-1s" id="cont">
            <div class="row">
                <h5>Editar</h5>
                <br>
                <div class="divider"></div>
                <input type="text" name="registro_id" value="{{ $registro->id }}">
                <br> {{--
                <div class="row">
                    <div class="input-field col l6">
                        <input type="text" id="folio" name="folio" value="{{ $registro->folio }}">
                        <label for="folio">Folio</label>
                    </div>
                    <div class="input-field col l6">
                        <input type="number" id="thoras" name="totalHoras" value="{{ $registro->totalHoras }}">
                        <label for="totalHoras">Total de horas</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col l6">
                        <input type="text" id="fechaInicio" name="fechaInicio" class="datepicker" value="{{ $registro->fechaInicio }}">
                        <label for="fechaInicio">Fecha inicio</label>
                    </div>
                    <div class="input-field col l6">
                        <input type="text" id="fechaFin" name="fechaFin" class="datepicker" value="{{ $registro->fechaFin }}">
                        <label for="fechaInicio">Fecha fin</label>
                    </div>
                </div>
                <div class="input-field col s12">
                    <select id="municipio_id" name="municipio_id">
                        <option value="" disabled selected>Elige una opción</option>
                        @foreach ($municipios as $municipio)
                            <option {{ $municipio->id == $registro->municipio_id ? 'selected' : '' }} value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                        @endforeach
                    </select>
                    <label>Municipio</label>
                </div>
                <input type="text" name="registro_id" value="{{ $registro->id }}">
                <a data-action="{{ route(" post.folio ") }}" id="guardarRegistro" class="btn-small green white-text right">
                    <i class="large material-icons">check</i>
                </a> --}}

                <br>

                <ul class="collapsible">
                    <li>
                        <div class="collapsible-header"><i class="material-icons">event_note</i>Calendario</div>
                        <div class="collapsible-body">
                            <div class="file-field input-field">
                                <div class="btn-small">
                                    <span>Agregar archivos</span>
                                    <input type="file" name="evidencia[calendario][]" id="calendario" accept="image/png, image/jpeg, application/pdf" multiple>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                            <table data-img="calendario">
                                <thead>
                                    <tr>
                                        <th>Archivos seleccionados</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <br>
                            <a data-action="" data-target="calendario" class="btn-small green white-text right guardar">
                                    <i class="large material-icons">check</i>
                                </a>
                            <br>
                            <br>
                            <div class="loadListcalendario">
                                @forelse ($evidenciasCal as $eviCal)
                                    <div class="card">
                                        <div class="card-image">
                                            @if ($eviCal->extension == 'pdf')
                                                <embed height="400px" src="{{ asset('storage/' . $eviCal->path) }}" type="" width="100%">
                                            @else
                                                <img src="{{ asset('storage/' . $eviCal->path) }}" alt="">
                                            @endif
                                            <span class="card-title">{{ $eviCal->nombre }}</span>
                                        </div>
                                        <div class="card-content">
                                            <p>{{ $eviCal->nombre }}</p>
                                            <p>{{ $eviCal->fecha }}</p>
                                        </div>
                                        <div class="card-action right-align">
                                            <a href="#" class="btn red white-text guardar" data-action="" data-target="calendario">
                                                <i class="large material-icons">delete_forever</i>
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    Sin registros
                                    
                                @endforelse
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">vertical_align_center</i>Registro de entrada y salida</div>
                        <div class="collapsible-body">
                            <div class="file-field input-field">
                                <div class="btn-small">
                                    <span>Agregar archivos</span>
                                    <input type="file" name="evidencia[calendario][]" id="entradaSalida" accept="image/png, image/jpeg, application/pdf" multiple>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                            <table data-img="entradaSalida">
                                <thead>
                                    <tr>
                                        <th>Archivos seleccionados</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <br>
                            <a data-action="http://chedraui.tobecorporativo.mx/perifoneo/public/admin/evidencias" data-target="entradaSalida" class="btn-small green white-text right guardar">
                                    <i class="large material-icons">check</i>
                                </a>
                            <br>
                            <br>
                            <div class="loadListentradaSalida">
                                @forelse ($entradasSalidas as $entsal)
                                    <div class="card">
                                        <div class="card-image">
                                            @if ($entsal->extension == 'pdf')
                                                <embed height="400px" src="{{ asset('storage/' . $entsal->path) }}" type="" width="100%">
                                            @else
                                                <img src="{{ asset('storage/' . $entsal->path) }}" alt="">
                                            @endif
                                            <span class="card-title">{{ $entsal->nombre }}</span>
                                        </div>
                                        <div class="card-content">
                                            <p>{{ $entsal->nombre }}</p>
                                            <p>{{ $entsal->fecha }}</p>
                                        </div>
                                        <div class="card-action right-align">
                                            <a href="#" class="btn red white-text guardar" data-action="" data-target="entradaSalida">
                                                <i class="large material-icons">delete_forever</i>
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    Sin registros
                                @endforelse
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">gps_fixed</i>GPS</div>
                        <div class="collapsible-body">
                            <div class="file-field input-field">
                                <div class="btn-small">
                                    <span>Agregar archivos</span>
                                    <input type="file" name="evidencia[gps][]" id="gps" accept="image/png, image/jpeg, application/pdf" multiple>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                            <table data-img="gps">
                                <thead>
                                    <tr>
                                        <th>Archivos seleccionados</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <br>
                            <a data-action="" data-target="gps" class="btn-small green white-text right guardar">
                                    <i class="large material-icons">check</i>
                                </a>
                            <br>
                            <br>
                            <div class="loadListgps">
                                @forelse ($gpss as $gps)
                                    <div class="card">
                                        <div class="card-image">
                                            @if ($gps->extension == 'pdf')
                                                <embed height="400px" src="{{ asset('storage/' . $gps->path) }}" type="" width="100%">
                                            @else
                                                <img src="{{ asset('storage/' . $gps->path) }}" alt="">
                                            @endif
                                            <span class="card-title">{{ $gps->nombre }}</span>
                                        </div>
                                        <div class="card-content">
                                            <p>{{ $gps->nombre }}</p>
                                            <p>{{ $gps->fecha }}</p>
                                        </div>
                                        <div class="card-action right-align">
                                            <a href="#" class="btn red white-text guardar" data-action="" data-target="gps">
                                                <i class="large material-icons">delete_forever</i>
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    Sin registros
                                @endforelse
                            </div>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>
@endsection
 
@section('javascript')
<script>
    let getView = (url, target) => {
            
            $.get( url, function( data ) {
                $( target ).html( data );
                alert( "Load was performed." );
            });
        }

        let fileAjax = (formData) => {
            $.ajax({
                url: '{{ route("post.editEvidencia", ["registro" => $registro->id]) }}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST', // For jQuery < 1.9
                success: function(data){
                    $( `.${data.class}` ).html( data.view );
                }
            });
        }

        let ajax = (method, action, data, callback, target) => {
            $.ajax({
                type: method,
                url: action,
                data: data,
                success: function (response) {
                    console.log(response);
                    if (response.type == 'view') {
                        $( '#calendarioList' ).html( response.view );
                    } else if (response.type == 'fk') {
                        $( `[name="${response.name}"]` ).val(response.value);
                        $("#divHide").show();
                        $('#guardarRegistro').attr('disabled', 'disabled');
                    }
                }
            });
        }

        $(document).ready(function () {
            $('.collapsible').collapsible();
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                container: 'body',
                i18n: {
                    months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthsShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    weekdaysAbbrev: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                    weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    weekdaysShort: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    cancel: 'Cancelar',
                    done: 'Elegir'
                }
            });
            $('table[data-img]').hide();
            $('select').formSelect();

            $('.guardar').on('click', function() {
                let targetId = $(this).data('target');
                console.log(targetId);
                let formData = new FormData();
                let fileElem = document.getElementById(targetId);
                console.log(`fecha[${targetId}][]`);
                let registro_id = $('[name="registro_id"]').val();
                formData.append('registro_id', registro_id);
                $.each(fileElem.files, function (indexInArray, valueOfElement) {      
                    console.log(indexInArray);
                    console.log(valueOfElement);
                    let fecha = document.getElementsByName("fecha[" + targetId + "][" + indexInArray + "]");
                    console.log("fecha[" + targetId + "][" + indexInArray + "]");
                    console.log('fecha:', fecha);
                    formData.append(`${targetId}[${indexInArray}]`, valueOfElement);
                    formData.append(`fecha[${targetId}][${indexInArray}]`, fecha[0].value);
                });
                fileAjax(formData); 
            })  

            $('#guardarAgenda').on('click', function () {
                let method = 'POST';
                let action = $(this).data('action');
                // let actionGet = $(this).data('actionGet');
                let target = '#calendarioList';
                let fecha = $('[name="fecha"]').val();
                let hora = $('[name="hora"]').val();
                let registro_id = $('[name="registro_id"]').val();
                let data = {fecha: fecha, hora: hora, registro_id: registro_id};
                ajax(method, action, data, target);
            });

            $('#guardarRegistro').on('click', function () {
                let method = 'POST';
                let action = $(this).data('action');
                let folio = $('[name="folio"]').val();
                let totalHoras = $('[name="totalHoras"]').val();
                let fechaInicio = $('[name="fechaInicio"]').val();
                let fechaFin = $('[name="fechaFin"]').val();
                let municipio_id = $('[name="municipio_id"]').val();
                let data = {
                    folio: folio,
                    totalHoras: totalHoras,
                    fechaInicio: fechaInicio,
                    fechaFin: fechaFin,
                    municipio_id: municipio_id
                };
                ajax(method, action, data);
            });

            $('#calendarioList').on('click', '.eliminar', function () {
                let formId = $(this).data('formtarget');
                let form = document.getElementById(formId);
                console.log(form);
                let method = 'POST';
                let action = form.action;
                let _token = $('[name="_token"]').val();
                let _method = $('[name="_method"]').val();
                console.log(_token);
                let data = {
                    _token: _token,
                    _method: _method
                };
                ajax(method, action, data);
            });
            $('input[type="file"]').on('change', function(e){
                var id = $(this).attr('id');
                if(e.target.files.length === 0){
                    $('table[data-img='+id+']').hide();
                }   
                else{
                    $('table[data-img='+id+']').show()
                    $('table[data-img='+id+'] > tbody').empty();
                    for (var i = 0; i < e.target.files.length; i++) {
                        $('table[data-img='+id+'] > tbody').append('<tr><td>'+e.target.files[i].name+'</td><td><input type="date" name="fecha['+id+']['+i+']" id=""></td></tr>');
                    }
                }
            });
        });
</script>
@endsection