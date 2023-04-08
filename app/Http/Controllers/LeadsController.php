<?php

namespace App\Http\Controllers;

use App\Helpers\helpers;
use App\Models\Icon;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Lead;
use App\Models\LeadLog;
use Illuminate\Support\Facades\Mail;

class LeadsController extends Controller
{
    public function save(Request $request){
        $lead = [
            "name"=>$request->name,
            "phone_no"=>$request->phone_no,
            "place"=>$request->place,
            "email"=>$request->email,
            "subject"=>$request->subject,
            "appointment_date"=>date_format(date_create_from_format("m/d/Y", $request->appointment_date), 'Y-m-d'),
            "message"=>$request->message
        ];
        $lead = Lead::create($lead);
        $send_data['email'] = "smeenamphil@gmail.com";
        $send_data['subject'] = "Leeds from Drmeenas.com";
        $send_data['content'] = "<p>You have got a lead from drmeenas.com. follow back!</p>";
        $send_data['bcc'] = "gvamanikandan23@gmail.com";
        $send_data['cc'] = null;
        $res = Mail::send([], [], function ($message)use ($send_data) {
            $message->to($send_data['email'])
                ->subject($send_data['subject'])
                ->setBody($send_data['content'], 'text/html');
            if ($send_data['cc'] != null) {
                $message->cc($send_data['cc']);
            }
            if ($send_data['bcc'] != null) {
                $message->bcc($send_data['bcc']);
            }
        });
        return ["status"=>1, "message"=>"Thank you for contacting us, we will revert you back - Admin."];
    }

    public function index(){
        $user = Auth::user();
        if ($user) {
            $page_title = "Leads";
            $breadcrumb = array(
                array("Dashboard", "dashboard", "active"),
                array("Leads", "#", "active")
            );
            $pagedata = array(
                "page_title" => $page_title,
                "page_sub_title" => "",
                "includes" => ['form', 'validation', 'toast', 'datatable', 'confirm'],
                "user_info" => $user,
                "navMenu" => helpers::getNavMenuByRole($user->role_id, 0),
                "breadcrumb" => $breadcrumb,
                "custom_js" => ["dist/js/leads/index.js"]
            );
            return view('leads.index', $pagedata);
        } else {
            return redirect(config('app.url'));
        }
    }

    public function leads($status){
        $user = Auth::user();
        if ($user) {
            $page_title = "Leads";
            $breadcrumb = array(
                array("Dashboard", "dashboard", "active"),
                array("Leads", "#", "active")
            );
            $pagedata = array(
                "page_title" => $page_title,
                "page_sub_title" => "",
                "includes" => ['form', 'validation', 'toast', 'datatable', 'confirm'],
                "user_info" => $user,
                "navMenu" => helpers::getNavMenuByRole($user->role_id, 0),
                "breadcrumb" => $breadcrumb,
                "custom_js" => ["dist/js/leads/leads.js"]
            );
            return view('leads.leads', $pagedata);
        } else {
            return redirect(config('app.url'));
        }
    }
    public function list(Request $request){
        $leads = Lead::orderBy("id", "DESC")->get();
        return ["data"=>$leads];
    }

    public function getById($id){
        $lead = Lead::where("id", $id)->first();
        $lead->logs = $lead->lead_logs;
        return $lead;
    }

    public function getLogsById($id){
        $lead = LeadLog::where("lead_id", $id)->orderBy("id", "DESC")->get();
        $html = "<div class='direct-chat-messages'>";
        foreach ($lead as $obj){
            $html.="<div class='direct-chat-infos clearfix'>";
            $html.='<span class="direct-chat-name float-left">'.$obj->user->name.'</span>';
            $html.='<span class="direct-chat-timestamp float-right">'.$obj->created_at.'</span>';
            $html.='</div>';
            if($obj->follow_date!='') {
                $html .= "<div class='direct-chat-infos clearfix'>";
                $html .= '<span class="direct-chat-name float-left"> Next Follow Up Date : ' . $obj->follow_date . '</span>';
                $html .= '</div>';
            }
            $html.='<img class="direct-chat-img" src="https://ui-avatars.com/api/?name='.$obj->user->name.'&background=0D8ABC&color=fff" alt="message user image">';
            $html.='<div class="direct-chat-text">'.$obj->comments.'</div><hr>';
        }
        $html.="</div>";
        return $html;
    }

    public function saveLead(Request $request){
        $lead = Lead::where("id", $request->lead_id)->first();
        if($lead){
            $lead->status = $request->status;
            $lead->save();
            LeadLog::create([
                "lead_id"=>$request->lead_id,
                "user_id"=>Auth::user()->id,
                "follow_date"=>$request->follow_date,
                "comments"=>$request->comments,
                "status"=>$request->status
            ]);
            return ['status'=>1, "message"=>"Ticket updated successfully"];
        }
        return ['status'=>0, "message"=>"Ticket not found"];
    }
}
