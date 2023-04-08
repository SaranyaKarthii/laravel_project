<?php

namespace App\Http\Controllers;


use App\Helpers\helpers;
use App\Models\Department;
use App\Models\FileUpload;
use App\Models\ProductUpload;
use Illuminate\Support\Facades\DB;
use http\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class FileUploadController extends Controller
{
    public function index($id=0){
        $user = Auth::user();
        if ($user) {
            $page_title = "Files";
            $breadcrumb = array(
                array("Dashboard", "dashboard", "active"),
                array("Files", "#", "active")
            );
            $pagedata = array(
                "page_title" => $page_title,
                "page_sub_title" => "",
                "includes" => ['form', 'validation', 'toast', 'datatable', 'confirm'],
                "user_info" => $user,
                "navMenu" => helpers::getNavMenuByRole($user->role_id, 0),
                "breadcrumb" => $breadcrumb,
                "custom_js" => ["dist/js/fileupload/files.js"]
            );
            return view('fileupload.files', $pagedata);
        } else {
            return redirect(config('app.url'));
        }
    }

    public function upload($id=0){
        $user = Auth::user();
        if ($user) {
            $page_title = "File Upload";
            $breadcrumb = array(
                array("Dashboard", "dashboard", "active"),
                array("File Upload", "#", "active")
            );
            $pagedata = array(
                "page_title" => $page_title,
                "page_sub_title" => "",
                "includes" => ['toast', 'dropzone', 'confirm'],
                "user_info" => $user,
                "navMenu" => helpers::getNavMenuByRole($user->role_id, 0),
                "breadcrumb" => $breadcrumb,
                "custom_js" => ["dist/js/fileupload/upload.js"]
            );
            return view('fileupload.upload', $pagedata);
        } else {
            return redirect(config('app.url'));
        }
    }

    public function fileupload(Request $request){
        $auth = Auth::user();
        $data = array();

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpg,png,pdf|max:10240',
        ]);

        if ($validator->fails()) {

            $data['success'] = 0;
            $data['error'] = $validator->errors()->first('file');// Error response

        }else{
            if($request->file('file')) {

                $file = $request->file('file');
                $filename = time().'_'.$file->getClientOriginalName();

                // File upload location
                $location = 'uploads/files';
                $file_slug = helpers::RandomString(25);
                // Upload file
                $file->move($location,$filename);
                // Response
                $data['success'] = 1;
                $data['filename'] = $filename;
                $data['fileslug'] = $file_slug;
                $data['message'] = 'Uploaded Successfully!';
                $file = FileUpload::create([
                    "name"=>$file->getClientOriginalName(),
                    "file_path"=>$location."/".$filename,
                    "file_slug"=>$file_slug,
                    "file_type"=>"",
                    "tag"=>""
                ]);
            }else{
                // Response
                $data['success'] = 0;
                $data['message'] = 'File not uploaded.';
            }
        }

        return response()->json($data);
    }

    public function submit(Request $request){
        $file = FileUpload::where("file_slug", $request->file_slug)->first();
        $file->file_type = $request->file_type;
        $file->tag = $request->tag;
        $file->save();
        return ['status'=>1, "message"=>"File uploaded"];
    }

    public function submitById(Request $request){
        $file = FileUpload::where("id", $request->id)->first();
        $file->file_type = $request->file_type;
        $file->tag = $request->tag;
        $file->save();
        return ['status'=>1, "message"=>"File details updated"];
    }

    public function filesList(Request $request){
        if($request->status==1) {
            $result = FileUpload::get();
        }else{
            $result = FileUpload::withTrashed()->whereNotNull('deleted_at')->get();
        }
        return ["data"=>$result];
    }
    public function getById($id){
        $obj = FileUpload::where("id", $id)->first();
        return $obj;
    }
    public function delete($id){
        FileUpload::find($id)->delete();
        return ["status"=>1, "message"=>"Record deleted..."];
    }
    public function restore($id){
        FileUpload::withTrashed()->find($id)->restore();
        return ["status"=>1, "message"=>"Record restored..."];
    }
}
