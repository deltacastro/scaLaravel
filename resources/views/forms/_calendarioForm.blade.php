@extends('layouts.form.formGeneral')

@section('form-title')
    <h1>Formulario</h1>
@endsection

@section('form-body')
    
    <h2>Folios</h2>
    <input type="text" name="folio" placeholder="ingresa folio">
    <br>
    <input type="text" name="totalHoras" placeholder="Total Horas">
    <input type="text" name="registro_id">
    <br>
    <button data-action="{{ route("post.folio") }}" id="guardarRegistro">Guardar</button>
    <br>
    <h2>Calendario</h2>
    <select name="mes" id="">
        <option >Enero</option>
        <option >Febrero</option>
        <option >Marzo</option>
        <option >Abril</option>
        <option >Mayo</option>
        <option >Junio</option>
        <option >Julio</option>
        <option >Agosto</option>
        <option >Septiembre</option>
        <option >Octubre</option>
        <option >Noviembre</option>
        <option >Diciembre</option>
    </select>
    <select name="municipio" id="">
        <option >Cardenas</option>
        <option >Centro</option>
        <option >Centla</option>
        <option >Jonuta</option>
        <option >Paraiso</option>
        <option >Comalcalco</option>
    </select>
    <input type="file" name="evidencia[calendario]" id="">
    <h2>Formato de Entrada y Salida</h2>
    <input type="file" name="evidencia[entradaSalida][]" id="entradaSalida" multiple>
    <button data-action="{{ route("post.evidencia") }}" data-target="entradaSalida" class="guardar">Guardar</button>
    <div class="entradaSalida">

    </div>
    <h2>GPS</h2>
    <input type="file" name="evidencia[gps][]" id="gps" multiple>
    <button data-action="{{ route("post.evidencia") }}" data-target="gps" class="guardar">Guardar</button>
    <div class="gps">

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
                    }
                }
            });
        }

        $(document).ready(function () {

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
                let data = {
                    folio: folio,
                    totalHoras: totalHoras
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
        });
    </script>
@endsection