@extends('layouts.app-vue')
@section('title', 'Home')
@prepend('page-css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<style>
    .clickable, .clickable-edit {
        cursor:pointer;
        transition : 200ms color ease-in-out;
    }

    .clickable:hover {
        color :#007bff;
    }
</style>
@endprepend
@section('content')
<div class="row">
<div class="col-lg-12">
        <div class="card rounded-0 shadow-sm border-0">
            <div class="card-body text-center">
                @if(@$isComplete)
                    <img src="{{ asset('/assets/img/undraw_Completed_re_cisp.png') }}" width="50%" alt="">
                    <h3 class='mt-2'>
                       You have sucessfully completed your <strong>PERSONAL DATA SHEET</strong>
                    </h3>
                @else
                    <img src="{{ asset('/assets/img/undraw_accept_tasks_po1c.png') }}" width="50%" alt="">
                    <h3>
                        Scroll down to fill up your <strong>PERSONAL DATA SHEET</strong>
                    </h3>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        {{-- <a href="{{ route('personal-data-sheet.create') }}" class='btn btn-primary btn-block rounded-0'>YOUR PERSONAL DATA SHEET</a> --}}
        <div class="card rounded-0 shadow-sm border-0">
            <div class="card-header rounded-0 font-weight-bold">
                PERSONAL DATA SHEET C1
            </div>
            <div class="card-body">
                    @if(@$hasPersonalInformation['complete'] == 'true')
                        <strong class='clickable-edit'  data-target="0">
                            <i class='font-weight-bold fa-2x fa fa-check text-success mr-3'></i>
                            PERSONAL INFORMATION
                        </strong>
                    @else
                        <p class='clickable'  data-target="0">
                            <i class='font-weight-bold fa-2x fa fa-question-circle text-warning mr-3'></i>
                            PERSONAL INFORMATION
                        </p>
                    @endif
                <hr>

                    @if(!is_null($user->family_background))
                        <strong class='clickable-edit'  data-target="0">
                            <i class='font-weight-bold fa-2x fa fa-check text-success mr-3'></i>
                            FAMILY BACKGROUND
                        </strong>
                    @else
                        <p class='clickable'  data-target="0">
                            <i class='font-weight-bold fa-2x fa fa-question-circle text-warning mr-3'></i>
                            FAMILY BACKGROUND
                        </p>
                    @endif
                <hr>

                    @if(!is_null($user->educational_background))
                        <strong class='clickable-edit'  data-target="0">
                            <i class='font-weight-bold fa-2x fa fa-check text-success mr-3'></i>
                            EDUCATIONAL BACKGROUND
                        </strong>
                    @else
                        <p class='clickable'  data-target="0">
                            <i class='font-weight-bold fa-2x fa fa-question-circle text-warning mr-3'></i>
                            EDUCATIONAL BACKGROUND
                        </p>
                    @endif
                <hr>

                <p>
                    @if($user->employee && (!is_null($user->employee->dbp_account_no) || !is_null($user->employee->lbp_account_no)))
                        <strong class='clickable-edit'  data-target="0">
                            <i class='font-weight-bold fa-2x fa fa-check text-success mr-3'></i>
                            ADDITIONAL INFORMATION
                        </strong>
                    @else
                        <p class='clickable'  data-target="0">
                            <i class='font-weight-bold fa-2x fa fa-question-circle text-warning mr-3'></i>
                            ADDITIONAL INFORMATION
                        </p>
                    @endif
                </p>
                <hr>

            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card rounded-0 border-0 shadow-sm">
            <div class="card-header font-weight-bold">
                PERSONAL DATA SHEET C2
            </div>
            <div class="card-body">
                <p>
                    @if($hasCivilService['complete'] == 'true')
                        <strong class='clickable-edit'  data-target="1">
                            <i class='font-weight-bold fa-2x fa fa-check text-success mr-3'></i>
                            CIVIL SERVICE EGIBILITY
                        </strong>
                    @else
                        <p class='clickable'  data-target="1">
                            <i class='font-weight-bold fa-2x fa fa-question-circle text-warning mr-3'></i>
                            CIVIL SERVICE EGIBILITY
                        </p>
                    @endif
                </p>
                <hr>

                <p>
                    @if(@$hasWorkExperience['complete'] == 'true')
                        <strong class='clickable-edit' data-target="1">
                            <i class='font-weight-bold fa-2x fa fa-check text-success mr-3'></i>
                            WORK EXPERIENCE
                        </strong>
                    @else
                        <p class='clickable'  data-target="1">
                            <i class='font-weight-bold fa-2x fa fa-question-circle text-warning mr-3'></i>
                            WORK EXPERIENCE
                        </p>
                    @endif
                    </p>
                <hr>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card rounded-0 border-0 shadow-sm">
            <div class="card-header font-weight-bold">
                PERSONAL DATA SHEET C3
            </div>
            <div class="card-body">
                <p>
                    @if(@$hasVoluntary['complete'] == 'true')
                        <strong class='clickable-edit' data-target="2">
                            <i class='font-weight-bold fa-2x fa fa-check text-success mr-3'></i>
                            VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S
                        </strong>
                    @else
                        <p class='clickable'  data-target="2">
                            <i class='font-weight-bold fa-2x fa fa-question-circle text-warning mr-3'></i>
                            VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S
                        </p>
                    @endif
                </p>
                <hr>

                <p>
                    @if(@$hasLearningSave['complete'] == 'true')
                        <strong class='clickable-edit' data-target="2">
                        <i class='font-weight-bold fa-2x fa fa-check text-success mr-3'></i>
                        VII. LEARNING AND DEVELOPMENT (L&D) INTERVENTIONS/TRAINING PROGRAMS ATTENDED

                        </strong>
                    @else
                        <p class='clickable'  data-target="2">
                            <i class='font-weight-bold fa-2x fa fa-question-circle text-warning mr-3'></i>
                            VII. LEARNING AND DEVELOPMENT (L&D) INTERVENTIONS/TRAINING PROGRAMS ATTENDED
                        </p>
                    @endif
                </p>
                <hr>

                <p>
                    @if(@$hasOtherInformationSave['complete'] == 'true')
                        <strong class='clickable-edit' data-target="2">
                            <i class='font-weight-bold fa-2x fa fa-check text-success mr-3'></i>
                            OTHER INFORMATION
                        </strong>
                    @else
                        <p class='clickable'  data-target="2">
                            <i class='font-weight-bold fa-2x fa fa-question-circle text-warning mr-3'></i>
                            OTHER INFORMATION
                        </p>
                    @endif
                </p>
                <hr>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card border-0 shadow-sm rounded-0">
            <div class="card-header font-weight-bold">
                PERSONAL DATA SHEET C4
            </div>
            <div class="card-body">
                <p>
                    @if($user->relevant_queries)
                        <strong class='clickable-edit' data-target="3">
                            <i class='font-weight-bold fa-2x fa fa-check text-success mr-3'></i>
                            RELEVANT QUERIES
                        </strong>
                    @else
                        <p class='clickable'  data-target="3">
                            <i class='font-weight-bold fa-2x fa fa-question-circle text-warning mr-3'></i>
                            RELEVANT QUERIES
                        </p>
                    @endif
                </p>
                <hr>

                <p>
                    @if(@$hasReferencesSave['complete'] == 'true')
                        <strong class='clickable-edit' data-target="3">
                            <i class='font-weight-bold fa-2x fa fa-check text-success mr-3'></i>
                            REFERENCES
                        </strong>
                    @else
                        <p class='clickable'  data-target="3">
                            <i class='font-weight-bold fa-2x fa fa-question-circle text-warning mr-3'></i>
                            REFERENCES
                        </p>
                    @endif
                    </p>
                <hr>

                <p>
                    @if($user->issued_id)
                        <strong class='clickable-edit' data-target="3">
                                <i class='font-weight-bold fa-2x fa fa-check text-success mr-3'></i>
                                GOVERNMENT ISSUED ID
                        </strong>
                    @else
                        <p class='clickable'  data-target="3">
                            <i class='font-weight-bold fa-2x fa fa-question-circle text-warning mr-3'></i>
                            GOVERNMENT ISSUED ID
                        </p>
                    @endif
                    </p>
                <hr>

            </div>
        </div>
    </div>
</div>


@if(isset($changeLogs))
<!-- Modal -->
<div class="modal fade" id="changeLogsModal" tabindex="-1" role="dialog" aria-labelledby="changeLogsModalTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">Important Message</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id" value="{{ $changeLogs->id }}" />
        <input type="hidden" id="user" value="{{ $user->id }}" />
        {!! $changeLogs->description !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif

@push('page-scripts')
<script>
    $(document).ready(function () {
        $(document).on('click', '.clickable', function (e) {
            let target = $(this).attr('data-target');
            localStorage.setItem('create__current__tab', target);
            window.location.href = `${BASE_URL}employee/personal-data-sheet/create`;
        });

        $(document).on('click', '.clickable-edit', function (e) {
            let target = $(this).attr('data-target');
            let id = "{{ Auth::user()->id }} ";
            localStorage.setItem('existing__current__tab', target);
            window.location.href = `${BASE_URL}employee/personal-data-sheet/edit/${id}`;
        });

        let logs = "{{ $changeLogs }}";

        if(logs) {
            let readID = $('#id').val();
            let user = $('#user').val();
            if(!localStorage.getItem(`is__read__${readID}__${user}`)) {
                $('#changeLogsModal').modal('toggle');
                localStorage.setItem(`is__read__${readID}__${user}`, true);
            }
        }
    });
</script>
@endpush
@endsection
