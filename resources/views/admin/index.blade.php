@extends('layouts.form.formGeneral')

@section('style')
    <style>
        #table_id_wrapper {
            margin-top: 5%;
            text-align: center;
        }

        .container{
            width: 90%;
        }
    </style>
@endsection

@section('form-body')
    <div class="container">
        <div class="row">
            <div class="col offset-l3 offset-xl1 xl12 l9 animated fadeIn delay-1s">
                <table id="table_id" class="display cell-border">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Fecha</th>
                            <th>Total de horas</th>
                            <th>Municipio</th>
                            <th>Calendario</th>
                            <th>Reporte e. y s.</th>
                            <th>GPS</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modelList as $data)
                        <tr>
                            <td>{{ $data->folio }}</td>
                            <td>{{ $data->fechaInicio }} - {{ $data->fechaFin }}</td>
                            <td>{{ $data->totalHoras }}</td>
                            <td>Centla</td>
                            <td>
                                @if ($data->checkCalendario() > 0)
                                    <a target="__blank" href="{{ route('get.listImg', ['registro' => $data, 'tipo' => 1]) }}"><i class="material-icons">visibility</i></a>    
                                @endif
                            </td>
                            <td>
                                @if ($data->checkReporte() > 0)
                                    <a target="__blank" href="{{ route('get.listImg', ['registro' => $data, 'tipo' => 2]) }}"><i class="material-icons">visibility</i></a>
                                @endif
                            </td>
                            <td>
                                @if ($data->checkGps() > 0)
                                    <a target="__blank" href="{{ route('get.listImg', ['registro' => $data, 'tipo' => 3]) }}"><i class="material-icons">visibility</i></a>
                                @endif
                            </td>
                            <td><a target="__blank" href="#"><i class="material-icons">edit</i></a></td>
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