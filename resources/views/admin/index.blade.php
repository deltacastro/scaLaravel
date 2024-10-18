@extends('layouts.form.formGeneral')

@section('styles')
    <style>
        #table_id_wrapper {
            margin-top: 5%;
            text-align: center;
        }

        .container{
            /* left: 300px; */
            /* right: 0px; */
            /* position: absolute; */
        }
        .overflow-x {
            overflow-x: scroll;
        }
    </style>
@endsection

@section('form-body')
    <div class="container">
        <div class="row">
            <div class="animated fadeIn delay-1s loadTable overflow-x">
                @include('admin._loadTable')
            </div>
        </div>
    </div>
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h5>¡Peligro!</h5>
            <p>¿Realmente desea eliminarlo?</p>
        </div>
        <div class="modal-footer">
            <a class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
            <a id="eliminarSubmit" data-form="generalForm" class="modal-close waves-effect waves-green btn-flat">Eliminar</a>
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
                        dataTableInit();
                    } else if (response.type == 'fk') {
                        $( `[name="${response.name}"]` ).val(response.value);
                        $("#divHide").show();
                        $('#guardarRegistro').attr('disabled', 'disabled');
                    }
                }
            });
        }

        let dataTableInit = () => {
            $('#table_id').DataTable({
                "lengthChange": false,
                "responsive": true,
                "info": false,
                "order": [[0, 'desc']]
                "language": {
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "zeroRecords": "Sin resultados",
                    "search": "BUSCAR :"
                }
            });
        }
        $(document).ready(function () {
            dataTableInit();
            
            // $(document).on('click', '.eliminar', function () {
            //     let elem = document.querySelector('#modal1');
            //     let instance = M.Modal.init(elem, '');
            //     instance.open();
                
            //     let formId = $(this).data('formtarget');
            //     console.log(formId);
                
            //     let form = document.getElementById(formId);
            //     console.log(form);
            //     let method = 'POST';
            //     let action = form.action;
            //     let _token = $('[name="_token"]').val();
            //     let _method = $('[name="_method"]').val();
            //     console.log(_token);
            //     let data = {
            //         _token: _token,
            //         _method: _method
            //     };
            //     ajax(method, action, data);
                
            // });
            $('.loadTable').on('click', '.eliminar', function () {
                let eliminarSubmit = document.getElementById('eliminarSubmit');
                let formId = this.dataset.formtarget;
                console.log('primer click', formId);
                
                eliminarSubmit.dataset.formtarget = formId;

                let elem = document.querySelector('#modal1');
                let instance = M.Modal.init(elem, '');
                instance.open();
            });
            
            $(document).on('click', '#eliminarSubmit', function () {
                let formId = this.dataset.formtarget;
                let form = document.getElementById(formId);
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