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
            <div class="animated fadeIn delay-1s">
                <table id="table_id" class="display cell-border">
                    <thead>
                        <tr>
                            {{-- <th>Folio</th> --}}
                            <th>Mes</th>
                            {{-- <th>Total de horas</th> --}}
                            <th>Municipio</th>
                            <th>Calendario</th>
                            <th>Reporte entrada y salida</th>
                            <th>GPS</th>
                            @if (Auth::user()->tipoUsuario == 1)
                                <th>Opciones</th>    
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modelList as $data)
                        <tr>
                            {{-- <td>{{ $data->folio }}</td> --}}
                            <td>{{ $data->fechaInicio }}</td>
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
                                    <a target="_blank" href="#"><i class="material-icons">edit</i></a>
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
        });
    </script>
@endsection