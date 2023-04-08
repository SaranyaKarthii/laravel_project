<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\helpers;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use App\Models\Skill;

class HomepageController extends Controller
{
    
    public function index()
    {
        //Dynamic data to homepage
        $skills = Skill::all();
        $projects = Project::paginate(2);
        
        return view("UsersPanel.HomePage", compact('projects', 'skills'));
        
    }

    // show skill chart
    public function showSkillChart()
    {
        $skills = Skill::all();
        return view('UsersPanel.skill.show_skill_chart', compact('skills'));
    }

    
    public function detail($id)
    {
        $project = Project::find($id);
        return view("UsersPanel.ShowPage", compact('project'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $searched_items = Project::where('title', 'like', "%$query%" )->orWhere('description', 'like', "%$query%")->get();
        //->orWhere('category', 'like', "%$query%")
        

        return view("UsersPanel.searchPanel", compact('searched_items'));
    }  

}
