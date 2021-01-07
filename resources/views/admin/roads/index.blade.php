@extends('layouts.admin')

@section('content')
    {{ Breadcrumbs::render('road.index') }}
    <h2>Все дороги</h2>
    <hr>
    <br>
    <div class="row" style="clear: both;">
        <div class="col-12 text-right">
            <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" onclick="add()"><i class="fas fa-plus-square"></i> Добавить дорогу</a>
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table class=" table table-bordered table-striped" id="user_table" width="100%">
            <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="40%">Имя</th>
                <th width="25%">Тариф</th>
                <th width="15%"></th>
                <th width="15%"></th>
            </tr>
            </thead>
        </table>
    </div>
    <br>
    <hr>
    <div class="modal fade" id="post-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Новый пользователь</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="Form" class="form-horizontal">
                        <input type="hidden" name="road_id" id="road_id">

                        <div class="form-group">
                            <label for="inputName">Имя</label>
                            <input type="text"
                                   class="form-control"
                                   id="name"
                                   name="name">
                        </div>


                        <div class="form-group">
                            <label for="inputPhone">Тариф</label>
                            <input type="number"
                                   class="form-control"
                                   id="tariff"
                                   name="tariff">
                        </div>


                        <div class="form-group" id="form-errors">
                            <div class="alert alert-danger">
                                <ul>

                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

{{--                    <div class="col-9">--}}
{{--                        <div  class="collapse" id="collapseExample">--}}
{{--                            <button type="button" class="btn btn-danger" onclick="deleteUser()">Удалить</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <button type="button" class="btn btn-primary" onclick="save()">Сохранить</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function add() {
            $('#form-errors').html("");
            $('#user_id').val('');
            $('#name').val('');
            $('#email').val('');
            $('#role_id').val(2);
            $('#password').val('');
            $('#collapseExample').hide();
            $('#post-modal').modal('show');

        }
        function deleteUser() {
            var id = $('#road_id').val();
            let _url = `/roads/${id}`;

            let _token   = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: _url,
                type: 'DELETE',
                data: {
                    _token: _token
                },
                success: function(response) {
                    $('#user_table').DataTable().ajax.reload();
                    $('#post-modal').modal('hide');
                }
            });
        }


        function editUser (event) {
            $('#collapseExample').show();
            $('#staticBackdropLabel').text("Редактировать пользователя");
            $('#form-errors').html("");
            var id  = $(event).data("id");
            let _url = `/roads/${id}/edit`;
            $.ajax({
                url: _url,
                type: "GET",
                success: function(response) {
                    if(response) {
                        $('#road_id').val(response.id);
                        $('#name').val(response.name);
                        $('#tariff').val(response.tariff);
                        $('#post-modal').modal('show');
                    }
                }
            });
        }
        function save() {
            var id = $('#road_id').val();
            var name = $('#name').val();
            var tariff = $('#tariff').val();
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('roads.store') }}",
                type: "POST",
                data: {
                    id: id,
                    name: name,
                    tariff: tariff,
                    _token: _token
                },
                success: function(response) {
                    if(response.code == 200) {
                        $('#road_id').val('');
                        $('#name').val('');
                        $('#tariff').val('');
                        $('#user_table').DataTable().ajax.reload();
                        $('#post-modal').modal('hide');
                    }
                    else{
                        var errors = response.errors;
                        errorsHtml = '<div class="alert alert-danger"><ul>';

                        $.each( errors, function( key, value ) {
                            errorsHtml += '<li>'+ value + '</li>'; //showing only the first error.
                        });
                        errorsHtml += '</ul></div>';

                        $( '#form-errors' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form

                    }
                },
                error: function(response) {
                    $('#nameError').text(response.responseJSON.errors.name);
                }
            });
        }
        $(document).ready(function() {

            $('#user_table').DataTable({
                // aoColumnDefs: [
                //     { "sClass": "my_class", "aTargets": [ 0 ] }
                // ],
                language: {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('roads.index') }}",
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'tariff',
                        name: 'tariff'
                    },
                    {
                        data: 'edit',
                        name: 'edit',
                        orderable: false
                    },
                    {
                        data: 'more',
                        name: 'more',
                        orderable: false
                    },
                ]
            });
        });
    </script>
@endsection
