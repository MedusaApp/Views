@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Membership Pending') }}</div>

                    <div class="card-body">
                        {{ __('Your membership is still pending.  You will not be able to login until your membership is approved.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userInformation" tabindex="-1" role="dialog" aria-labelledby="userInformationTitle" aria-hidden="true">
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
                    <button type="button" class="btn btn-primary" id="declineMembership">Decline</button>
                    <button type="button" class="btn btn-primary" id="approveMembership">Approve</button>
                </div>
            </div>
        </div>
    </div>
@endsection