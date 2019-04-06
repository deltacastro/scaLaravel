@extends('layouts.form.formGeneral')

@section('styles')
    <style>
        #table_id_wrapper {
            margin-top: 5%;
            text-align: center;
        }

        .container{
            left: 300px;
            right: 0px;
            position: absolute;
        }
    </style>
@endsection

@section('form-body')
    <div class="container">
        <div class="row">
            <div class="animated fadeIn delay-1s loadTable">
                <table id="table_id" class="display cell-border">
                    <thead>
                        <tr>
                            {{-- <th>Folio</th> --}}
                            <th>Mes</th>
                            {{-- <th>Total de horas</th> --}}
                            <th>Municipio</th>
                            <th>Calendario</th>
                            <th>Reporte Entrada y Salida</th>
                            <th>GPS</th>
                            @if (Auth::user()->tipoUsuario == 1)
                                <th>Opciones</th>    
                            @endif
                        </tr>
                    </thead>
                    <tbody class="bodyList">
                        @foreach ($modelList as $data)
                        <tr>
                            {{-- <td>{{ $data->folio }}</td> --}}
                            <td>{{ $data->fechaInicioMes }}</td>
                            {{-- <td>{{ $data->totalHoras }}</td> --}}
                            <td>{{ $data->municipio->nombre }}</td>
                            <td>
                                @if ($data->checkCalendario() > 0)
                                    <a target="_blank" href="{{ route('get.listImg', ['registro' => $data, 'tipo' => 1]) }}"><i class="material-icons">visibility</i></a>    
                                @endif
                            </td>
                            <td>
                                @if ($data->checkReporte() > 0)
                                    <a target="_blank" href="{{ route('get.listImg', ['registro' => $data, 'tipo' => 2]) }}"><i class="material-icons">visibility</i></a>
                                @endif
                            </td>
                            <td>
                                @if ($data->checkGps() > 0)
                                    <a target="_blank" href="{{ route('get.listImg', ['registro' => $data, 'tipo' => 3]) }}"><i class="material-icons">visibility</i></a>
                                @endif
                            </td>
                            @if (Auth::user()->tipoUsuario == 1)
                                <td>
                                    <a target="_blank" href="{{ route('get.editRegistro', ['registro' => $data]) }}"><i class="material-icons">edit</i></a>
                                    <a title="Eliminar" data-formtarget="form{{ $data->id }}"><i class="material-icons">delete</i></a>
                                    <form id="form{{ $data->id }}" action="{{ route('post.registroEliminar',['registro' => $data->id]) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    </form>
                                </td>
                            @endif
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('form-footer')
    
@endsection

@section('javascript')
    <script>

        let ajax = (method, action, data, callback, target) => {
            $.ajax({
                type: method,
                url: action,
                data: data,
                success: function (response) {
                    console.log(response);
                    if (response.type == 'view') {
                        // $( '#calendarioList' ).html( response.view );
                        $( `.${response.class}` ).html( response.view );
                    } else if (response.type == 'fk') {
                        $( `[name="${response.name}"]` ).val(response.value);
                        $("#divHide").show();
                        $('#guardarRegistro').attr('disabled', 'disabled');
                    }
                }
            });
        }

        $(document).ready(function () {
            $('#table_id').DataTable({
                "lengthChange": false,
                "info": false,
                "language": {
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "zeroRecords": "Sin resultados",
                    "search": "BUSCAR :"
                }
            });
            
            $(document).on('click', '.eliminar', function () {
                let formId = $(this).data('formtarget');
                console.log(formId);
                
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