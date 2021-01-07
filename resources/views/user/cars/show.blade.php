@extends('layouts.admin')

@section('content')
    {{ Breadcrumbs::render('car.show', $car) }}
    <h2>Purchases of Car: {{$car->name}}</h2>
    <hr>
    <br>
    <div class="row" style="clear: both;">
        <div class="col-12 text-right">
            <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" onclick="add()"><i class="fas fa-plus-square"></i> Создать оплату</a>
        </div>
    </div>
    <br>
    <div class="table-responsive">
        <table class=" table table-bordered table-striped" id="user_table" width="100%">
            <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="25%">Road</th>
                <th width="30%">Paid</th>
                <th width="25%">When</th>
                <th width="15%"></th>
{{--                <th width="15%"></th>--}}
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
                        <input type="hidden" name="purchase_id" id="purchase_id">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputPhone">Road</label>
                                    <select class="form-control" id="road_id" name="road_id">
                                        @foreach($roads as $road)
                                            <option value="{{$road->id}}">{{$road->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="inputPhone">Оплатил</label>
                            <input type="number"
                                   class="form-control"
                                   id="paid"
                                   name="paid">
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
            $('#purchase_id').val('');
            $('#role_id').val('');
            $('#paid').val(0);
            $('#collapseExample').hide();
            $('#post-modal').modal('show');

        }
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


        function editUser (event) {
            $('#collapseExample').show();
            $('#staticBackdropLabel').text("Редактировать пользователя");
            $('#form-errors').html("");
            var id  = $(event).data("id");
            let _url = `/purchases/${id}/edit`;
            $.ajax({
                url: _url,
                type: "GET",
                success: function(response) {
                    if(response) {
                        $('#purchase_id').val(response.id);
                        $('#road_id').val(response.road_id);
                        $('#paid').val(response.paid);
                        $('#post-modal').modal('show');
                    }
                }
            });
        }
        function save() {
            var id = $('#purchase_id').val();
            var car_id = '{{$car->id}}';
            var road_id = $('#road_id').val();
            var paid = $('#paid').val();
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('storePurchase') }}",
                type: "POST",
                data: {
                    id: id,
                    car_id: car_id,
                    road_id: road_id,
                    paid: paid,
                    _token: _token
                },
                success: function(response) {
                    if(response.code == 200) {
                        $('#purchase_id').val('');
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
                    url: "{{ route('cars.show', $car->id) }}",
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'road.name',
                        name: 'road.name'
                    },
                    {
                        data: 'paid',
                        name: 'paid'
                    },{
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'edit',
                        name: 'edit',
                        orderable: false
                    },
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
