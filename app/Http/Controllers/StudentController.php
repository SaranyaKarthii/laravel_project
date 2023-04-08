<?php

namespace App\Http\Controllers;

use App\Helpers\helpers;
use App\Models\Address;
use App\Models\Department;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    public function index(){
        $user = Auth::user();
        if ($user) {
            $page_title = "Student";
            $breadcrumb = array(
                array("Dashboard", "dashboard", "active"),
                array("Students", "students", "active"),
            );

            $pagedata = array(
                "page_title" => $page_title,
                "page_sub_title" => "",
                "includes" => ['form', 'validation', 'toast', 'datatable', 'confirm'],
                "user_info" => $user,
                "department"=>Department::get(),
                "navMenu" => helpers::getNavMenuByRole($user->role_id, 0),
                "breadcrumb" => $breadcrumb,
                "custom_js" => ["dist/js/student/list.js"]
            );
            return view('student.list', $pagedata);
        } else {
            return redirect(config('app.url'));
        }
    }
    public function create(){
        $user = Auth::user();
        if ($user) {
            $page_title = "Student";
            $breadcrumb = array(
                array("Dashboard", "dashboard", "active"),
                array("Students", "students", "active"),
                array("create", "#", "active")
            );

            $pagedata = array(
                "page_title" => $page_title,
                "page_sub_title" => "",
                "includes" => ['form', 'validation', 'toast'],
                "user_info" => $user,
                "department"=>Department::get(),
                "navMenu" => helpers::getNavMenuByRole($user->role_id, 0),
                "breadcrumb" => $breadcrumb,
                "custom_js" => ["dist/js/student/create.js"]
            );
            return view('student.create', $pagedata);
        } else {
            return redirect(config('app.url'));
        }
    }

    public function edit($id){
        $user = Auth::user();
        if ($user) {
            $page_title = "Edit Student";
            $breadcrumb = array(
                array("Dashboard", "dashboard", "active"),
                array("Students", "students", "active"),
                array("create", "#", "active")
            );
            $student = Student::where("id", $id)->first();
            $pagedata = array(
                "page_title" => $page_title,
                "page_sub_title" => "",
                "includes" => ['form', 'validation', 'toast'],
                "user_info" => $user,
                "student"=>$student,
                "department"=>Department::get(),
                "navMenu" => helpers::getNavMenuByRole($user->role_id, 0),
                "breadcrumb" => $breadcrumb,
                "custom_js" => ["dist/js/student/edit.js"]
            );
            return view('student.edit', $pagedata);
        } else {
            return redirect(config('app.url'));
        }
    }

    public function create_student(Request $request){
        $address = Address::create([
            'address_line1'=> $request->address_line1,
            'address_line2'=> $request->address_line2,
            "city"=> $request->city,
            "state"=> $request->state,
            "country"=> $request->country,
            "pincode"=> $request->pincode
        ]);
        $student = Student::create([
            'name'=>$request->name,
            'register_no' => $request->register_no,
            'email' => $request->email,
            'phone' => $request->phone,
            'department_id' => $request->department_id,
            "year"=> $request->year,
            "address_id" => $address->id,
        ]);
        return ["status"=>1, "message"=>"Student created", "student"=>$student];
    }

    public function update_student(Request $request){
        $student = Student::find($request->id);
        $student->name = $request->name;
        $student->register_no= $request->register_no;
        $student->email= $request->email;
        $student->phone= $request->phone;
        $student->department_id= $request->department_id;
        $student->year= $request->year;
        $student->save();

        $address = Address::find($student->address_id);
        $address->address_line1 = $request->address_line1;
        $address->address_line2 = $request->address_line2;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->country = $request->country;
        $address->pincode = $request->pincode;
        $address->save();

        return ["status"=>1, "message"=>"Student updated", "student"=>$student];
    }

    public function list(Request $request){
        $sql = "SELECT s.*, d.name as 'dept_name', a.city FROM `students` s
INNER JOIN departments d on d.id = s.department_id
INNER JOIN address a on a.id = s.address_id ";
        if($request->status==1)
            $sql.= " WHERE s.deleted_at IS NULL";
        else
            $sql.= " WHERE s.deleted_at IS NOT NULL";
        $result = DB::select($sql);
        return DataTables::of($result)->addIndexColumn()->make(true);
    }
}
