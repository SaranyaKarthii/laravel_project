@extends('layouts.base')
@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ $page_title }}
                </h3>
                <div class="card-tools">
                    <a type="button" href="{{ env("APP_URL")."students-create" }}" class="btn btn btn-primary" id="add-user-button"><i class="fas fa-plus"></i>
                        Create
                    </a>
                </div>
            </div>
            <div class="card-body">
                <input type="hidden" id="currunt_status" value="1">
                <input type="hidden" id="_csrf_token" value="{{ csrf_token() }}">
                <div class="table-responsive">
                    <table id="students" class="table table-striped table-bordered display nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reg No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Department</th>
                            <th>Year</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
