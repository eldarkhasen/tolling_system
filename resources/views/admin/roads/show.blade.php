@extends('layouts.admin')

@section('content')
    {{ Breadcrumbs::render('road.show', $road) }}
    <h2>Purchases of Road: {{$road->name}}</h2>
    <hr>
    <br>
{{--    <div class="row" style="clear: both;">--}}
{{--        <div class="col-12 text-right">--}}
{{--            <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" onclick="add()"><i class="fas fa-plus-square"></i> Добавить пользователя</a>--}}
{{--        </div>--}}
{{--    </div>--}}
    <br>
    <div class="table-responsive">
        <table class=" table table-bordered table-striped" id="user_table" width="100%">
            <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="40%">Car</th>
                <th width="25%">Owner</th>
                <th width="15%">User</th>
                <th width="15%">Paid</th>
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
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputName">Имя</label>
                                    <input type="text"
                                           class="form-control"
                                           id="name"
                                           name="name">
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="inputPhone">Почта</label>
                            <input type="email"
                                   class="form-control"
                                   id="email"
                                   name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="password" name="password">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="button" onclick="showPassword()">Показать</button>
                                </div>
                            </div>
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
        {{--function add() {--}}
        {{--    $('#form-errors').html("");--}}
        {{--    $('#user_id').val('');--}}
        {{--    $('#name').val('');--}}
        {{--    $('#email').val('');--}}
        {{--    $('#role_id').val(2);--}}
        {{--    $('#password').val('');--}}
        {{--    $('#collapseExample').hide();--}}
        {{--    $('#post-modal').modal('show');--}}

        {{--}--}}
        {{--function showPassword() {--}}
        {{--    var x = document.getElementById("password");--}}
        {{--    if (x.type === "password") {--}}
        {{--        x.type = "text";--}}
        {{--    } else {--}}
        {{--        x.type = "password";--}}
        {{--    }--}}
        {{--}--}}
        {{--function deleteUser() {--}}
        {{--    var id = $('#user_id').val();--}}
        {{--    let _url = `/users/${id}`;--}}

        {{--    let _token   = $('meta[name="csrf-token"]').attr('content');--}}

        {{--    $.ajax({--}}
        {{--        url: _url,--}}
        {{--        type: 'DELETE',--}}
        {{--        data: {--}}
        {{--            _token: _token--}}
        {{--        },--}}
        {{--        success: function(response) {--}}
        {{--            $('#user_table').DataTable().ajax.reload();--}}
        {{--            $('#post-modal').modal('hide');--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}


        {{--function editUser (event) {--}}
        {{--    $('#collapseExample').show();--}}
        {{--    $('#staticBackdropLabel').text("Редактировать пользователя");--}}
        {{--    $('#form-errors').html("");--}}
        {{--    var id  = $(event).data("id");--}}
        {{--    let _url = `users/${id}/edit`;--}}
        {{--    $.ajax({--}}
        {{--        url: _url,--}}
        {{--        type: "GET",--}}
        {{--        success: function(response) {--}}
        {{--            if(response) {--}}
        {{--                $('#user_id').val(response.id);--}}
        {{--                $('#name').val(response.name);--}}
        {{--                $('#email').val(response.email);--}}
        {{--                $('#role_id').val(response.role_id);--}}
        {{--                $('#post-modal').modal('show');--}}
        {{--            }--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}
        {{--function save() {--}}
        {{--    var id = $('#user_id').val();--}}
        {{--    var name = $('#name').val();--}}
        {{--    var email = $('#email').val();--}}
        {{--    var role_id = $('#role_id').val();--}}
        {{--    var password = $('#password').val();--}}
        {{--    let _token   = $('meta[name="csrf-token"]').attr('content');--}}
        {{--    $.ajax({--}}
        {{--        url: "{{ route('users.store') }}",--}}
        {{--        type: "POST",--}}
        {{--        data: {--}}
        {{--            id: id,--}}
        {{--            name: name,--}}
        {{--            email: email,--}}
        {{--            password: password,--}}
        {{--            role_id: role_id,--}}
        {{--            _token: _token--}}
        {{--        },--}}
        {{--        success: function(response) {--}}
        {{--            if(response.code == 200) {--}}
        {{--                $('#user_id').val('');--}}
        {{--                $('#name').val('');--}}
        {{--                $('#email').val('');--}}
        {{--                $('#role_id').val(2);--}}
        {{--                $('#password').val('');--}}
        {{--                $('#user_table').DataTable().ajax.reload();--}}
        {{--                $('#post-modal').modal('hide');--}}
        {{--            }--}}
        {{--            else{--}}
        {{--                var errors = response.errors;--}}
        {{--                errorsHtml = '<div class="alert alert-danger"><ul>';--}}

        {{--                $.each( errors, function( key, value ) {--}}
        {{--                    errorsHtml += '<li>'+ value + '</li>'; //showing only the first error.--}}
        {{--                });--}}
        {{--                errorsHtml += '</ul></div>';--}}

        {{--                $( '#form-errors' ).html( errorsHtml ); //appending to a <div id="form-errors"></div> inside form--}}

        {{--            }--}}
        {{--        },--}}
        {{--        error: function(response) {--}}
        {{--            $('#nameError').text(response.responseJSON.errors.name);--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}
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
                    url: "{{ route('roads.show', $road->id) }}",
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'car.name',
                        name: 'car.name'
                    },
                    {
                        data: 'car.number',
                        name: 'car.number'
                    },
                    {
                        data: 'car.user.name',
                        name: 'car.user.name'
                    },
                    {
                        data: 'paid',
                        name: 'paid'
                    },
                    // {
                    //     data: 'edit',
                    //     name: 'edit',
                    //     orderable: false
                    // },
                    // {
                    //     data: 'more',
                    //     name: 'more',
                    //     orderable: false
                    // },
                ]
            });
        });
    </script>
@endsection
