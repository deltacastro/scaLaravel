@extends('layouts.form.formGeneral')

@section('form-title')
    Agendar calendario
@endsection

@section('form-body')
    
    <input data-action="{{ route("post.calendario") }}" type="date" name="fecha" id="">

@endsection


@section('form-footer')
    
@endsection

@section('javascript')
    <script>
        let ajax = (method, action, data) => {
            $.ajax({
                type: method,
                url: action,
                data: data,
                dataType: "dataType",
                success: function (response) {
                    
                }
            });
        }
        $(document).ready(function () {
            $('[name="fecha"]').on('change', function () {
                let method = 'POST';
                let action = $(this).data('action');
                let fecha = $(this).val();
                let data = {fecha: fecha};
                ajax(method, action, data);
            })
        });
    </script>
@endsection