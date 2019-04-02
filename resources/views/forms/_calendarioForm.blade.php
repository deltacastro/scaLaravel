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
    <h2>Agendar</h2>
    <input type="text" name="hora" placeholder="horas para la fecha">
    <input type="date" name="fecha" id="">
    <br>
    <button data-action="{{ route("post.calendario") }}" data-actionGet="{{ route("get.calendarioList") }}" id="guardarAgenda">Guardar</button>
    <br>
    <div id="calendarioList">

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

        let ajax = (method, action, data, callback, target) => {
            $.ajax({
                type: method,
                url: action,
                data: data,
                success: function (response) {
                    console.log(response);
                    
                    if (response.type == 'view') {
                        alert('entro al view')
                        $( '#calendarioList' ).html( response.view );
                    } else if (response.type == 'fk') {
                        $( `[name="${response.name}"]` ).val(response.value);
                    }
                }
            });
        }
        $(document).ready(function () {
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