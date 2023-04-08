@extends('layouts.base')
@section('content')

    <form id="student-create-form">
        {{ @csrf_field() }}
    <div class="row">
        <div class="col-sm-8 col-md-6 offset-sm-2 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Basic Info</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-arrow-alt-circle-left"></i> Back
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter full name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2">Register No</label>
                        <div class="col-sm-10">
                            <input type="text" name="register_no" class="form-control" id="register_no" placeholder="Enter full register no">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2">Email</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2">Phone No</label>
                        <div class="col-sm-10">
                            <input type="number" name="phone" class="form-control" id="phone" placeholder="Enter phone no">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2">Department</label>
                        <div class="col-sm-10">
                            <select name="department_id" class="form-control" id="department_id">
                                <?php
                                    foreach ($department as $obj){
                                        echo "<option value='".$obj->id."'>".$obj->description."</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2">Year</label>
                        <div class="col-sm-10">
                            <input type="number" name="year" class="form-control" id="year" placeholder="Enter year">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">Address Line 1</label>
                        <div class="col-sm-10">
                            <input type="text" name="address_line1" class="form-control" id="address_line1" placeholder="Enter Address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2">Address Line 2</label>
                        <div class="col-sm-10">
                            <input type="text" name="address_line2" class="form-control" id="address_line2" placeholder="Enter Address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2">City</label>
                        <div class="col-sm-10">
                            <input type="text" name="city" class="form-control" id="city" placeholder="Enter city">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">State</label>
                        <div class="col-sm-10">
                            <input type="text" name="state" class="form-control" id="state" placeholder="Enter state">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2">Country</label>
                        <div class="col-sm-10">
                            <input type="text" name="country" class="form-control" id="country" placeholder="Enter country">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">Pincode</label>
                        <div class="col-sm-10">
                            <input type="text" name="pincode" class="form-control" id="pincode" placeholder="Enter pincode">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right" id="btn-submit">Create</button>
                </div>
                <!-- /.card-footer-->
            </div>
        </div>
    </div>
    </form>
@endsection
