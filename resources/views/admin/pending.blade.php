@extends('layouts.app')
@push('style')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/dt-1.10.20/fh-3.1.6/r-2.2.3/datatables.min.css"/>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Pending Memberships</div>
                    <div class="card-body">
                        <table id="pending-users" class="table table-hover table-striped table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th>Application Date</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email Address</th>
                                <th>Date of Birth</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tfoot class="thead-dark">
                            <tr>
                                <th>Application Date</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email Address</th>
                                <th>Date of Birth</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userInformation" tabindex="-1" role="dialog" aria-labelledby="userInformationTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userInformationTitle">User Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    How now brown cow
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="declineMembership">Decline</button>
                    <button type="button" class="btn btn-primary" id="approveMembership">Approve</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userResults" tabindex="-1" role="dialog" aria-labelledby="userResultsTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    How now brown cow
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/dt-1.10.20/fh-3.1.6/r-2.2.3/datatables.min.js"></script>

    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();

            $('#pending-users').DataTable({
                "language": {
                    "emptyTable": "There are no pending memberships"
                },
                serverSide: true,
                processing: true,
                responsive: true,
                ajax: "{{ route('pending.users') }}",
                columns: [
                    {name: 'application_date'},
                    {name: 'first_name'},
                    {name: 'last_name'},
                    {name: 'email'},
                    {name: 'dob'},
                    {name: 'action', orderable: false, searchable: false}
                ]
            });

            $('#approveMembership').on('click', function() {
                let userID = $(this).data('id');
                $('#userInformation').modal('hide');
                $.get("/admin/api/v1/user/approve/" + userID)
                .done(function (data) {
                    if (data.status === 'ok') {
                        $('#userResults .modal-body').html('<p>The membership application has been approved.</p>')
                    } else {
                        $('#userResults .modal-body').html('<p>The member was not found.</p>')
                    }
                    $('#userResults').modal('show');
                });
            });

            $('#declineMembership').on('click', function() {
                let userID = $(this).data('id');
                $('#userInformation').modal('hide');
                $.get("/admin/api/v1/user/deny/" + userID)
                    .done(function (data) {
                        if (data.status === 'ok') {
                            $('#userResults .modal-body').html('<p>The membership application has been denied.</p>')
                        } else {
                            $('#userResults .modal-body').html('<p>The member was not found.</p>')
                        }
                        $('#userResults').modal('show');
                    });
            });

            $('#userResults').on('hidden.bs.modal', function () {
               location.reload(true);
            });

            $('#pending-users').on('click', '.view-user', function () {
                let userID = $(this).data('id');
                $.get("/admin/api/v1/user/find/" + userID)
                    .done(function (data) {
                        if (data.status === 'ok') {
                            let userInfo = data.user;

                            $('#userInformation button').attr('data-id', userID);
                            $('#userInformation .modal-body').html(
                                '<div class="row"><div class="col-sm-4 text-right">Name: </div><div class="col-sm-8">' +
                                userInfo.first_name + ' ' + userInfo.middle_name + ' ' + userInfo.last_name + ' ' +
                                userInfo.suffix + '</div></div><div class="row"><div class="col-sm-4 text-right">' +
                                'Address:</div><div class="col-sm-8">' + userInfo.address_1 +
                                '</div></div><div class="row"><div class="col-sm-4 text-right"></div><div class="col-sm-8">' +
                                userInfo.address_2 +
                                '</div></div><div class="row"><div class="col-sm-4 text-right">City:</div><div class="col-sm-8">' +
                                userInfo.city +
                                '</div></div><div class="row"><div class="col-sm-4 text-right">State/Province:</div><div class="col-sm-8">' +
                                userInfo.state_province +
                                '</div></div><div class="row"><div class="col-sm-4 text-right">Postal/Zip Code:</div><div class="col-sm-8">' +
                                userInfo.postal_code +
                                '</div></div><div class="row"><div class="col-sm-4 text-right">Country:</div><div class="col-sm-8">'
                                + userInfo.country +
                                '</div></div><div class="row"><div class="col-sm-4 text-right">Telephone:</div><div class="col-sm-8">' +
                                userInfo.telephone +
                                '</div></div><div class="row"><div class="col-sm-4 text-right">Date of Birth:</div><div class="col-sm-8">' +
                                userInfo.dob +
                                '</div></div><div class="row"><div class="col-sm-4 text-right">Application Date:</div><div class="col-sm-8">' +
                                userInfo.application_date + '</div></div>');
                        } else {
                            $('#userInformation .modal-body').html('<div class="row"><div class="col-sm-8">' +
                                data.status + "</div></div>");
                        }

                        $('#userInformation').modal('show');
                    });
            });
        });
    </script>
@endpush
