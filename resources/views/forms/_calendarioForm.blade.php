@extends('layouts.form.formGeneral')

@section('styles')
    <style>
        #cont {
            margin-top: 5%;
        }

        .container {
            width: 60%;
        }

        .responsive-img{
            width: 50% !important;
        }
    </style>
@endsection

@section('form-body')
<div class="container">
        <div class="row">
            <div class="col offset-l4 l8 animated fadeIn delay-1s" id="cont">
                <div class="row">
                    <h5>Folio y total de horas</h5>
                    <br>
                    <div class="divider"></div>
                    <br>
                    <div class="row">
                        <div class="input-field col l6">
                            <input type="text" id="folio" name="folio">
                            <label for="folio">Folio</label>
                        </div>
                        <div class="input-field col l6">
                            <input type="number" id="thoras" name="totalHoras">
                            <label for="totalHoras">Total de horas</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l6">
                            <input type="text" id="fechaInicio" name="fechaInicio" class="datepicker">
                            <label for="fechaInicio">Fecha inicio</label>
                        </div>
                        <div class="input-field col l6">
                            <input type="text" id="fechaFin" name="fechaFin" class="datepicker">
                            <label for="fechaInicio">Fecha fin</label>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <select id="municipio_id" name="municipio_id">
                            <option value="" disabled selected>Elige una opción</option>
                            @foreach ($municipios as $municipio)
                                <option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
                            @endforeach
                        </select>
                        <label>Municipio</label>
                    </div>
                    <input type="text" name="registro_id" hidden>
                    <a data-action="{{ route("post.folio") }}" id="guardarRegistro" class="btn-small green white-text right">
                        <i class="large material-icons">check</i>
                    </a>
                </div>                
                <div id="divHide" style="display:none;">
                    <div class="row">
                        <h5>Calendario</h5>
                        <div class="divider"></div>
                        <br>
                        <div class="file-field input-field">
                            <div class="btn-small">
                                <span>Seleccione archivos</span>
                                <input type="file" name="evidencia[calendario][]" id="calendario" accept="image/png, image/jpeg, application/pdf" multiple>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                        <ul class="collection" data-img="calendario"></ul>
                        <a data-action="{{ route("post.evidencia") }}" data-target="calendario" class="btn-small green white-text right guardar">
                            <i class="large material-icons">check</i>
                        </a>
                    </div>
                    <br>
                    <div class="row">
                        <h5>Reporte de entrada y salida</h5>
                        <div class="divider"></div>
                        <br>
                        <div class="file-field input-field">
                            <div class="btn-small">
                                <span>Seleccione archivos</span>
                                <input type="file" name="evidencia[entradaSalida][]" id="entradaSalida" accept="image/png, image/jpeg, application/pdf" multiple>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                        <ul class="collection" data-img="entradaSalida"></ul>
                        <a data-action="{{ route("post.evidencia") }}" data-target="entradaSalida" class="btn-small green white-text right guardar">
                            <i class="large material-icons">check</i>
                        </a>
                    </div>
                    <br>
                    <div class="row">
                        <h5>GPS</h5>
                        <div class="divider"></div>
                        <br>
                        <div class="file-field input-field">
                            <div class="btn-small">
                                <span>Seleccione archivos</span>
                                <input name="evidencia[gps][]" type="file" id="gps" accept="image/png, image/jpeg, application/pdf" multiple>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                        <ul class="collection" data-img="gps"></ul>
                        <a data-action="{{ route("post.evidencia") }}" data-target="gps" class="btn-small green white-text right guardar">
                            <i class="large material-icons">check</i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection


@section('form-footer')
    
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
                url: '{{ route("post.evidencia") }}',
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
            $('ul[data-img]').hide();
            $('select').formSelect();
            $('.guardar').on('click', function() {
                let targetId = $(this).data('target');
                console.log(targetId);
                let formData = new FormData();
                let fileElem = document.getElementById(targetId);
                let registro_id = $('[name="registro_id"]').val();
                formData.append('registro_id', registro_id);
                $.each(fileElem.files, function (indexInArray, valueOfElement) {      
                    console.log(indexInArray);
                    console.log(valueOfElement);
                    formData.append(`${targetId}[${indexInArray}]`, valueOfElement);
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
                    $('ul[data-img='+id+']').hide();
                }   
                else{
                    $('ul[data-img='+id+']').show().empty();
                    for (var i = 0; i < e.target.files.length; i++) {
                        $('ul[data-img='+id+']').append('<li class="collection-item">'+e.target.files[i].name+'</li>');
                    }
                }
            });
        });
    </script>
@endsection