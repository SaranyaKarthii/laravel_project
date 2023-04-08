<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;

class AdminSkillController extends Controller
{


    public function index()

    {

      $skills = Skill::all();
      return view('AdminSkill.index', compact('skills'));

    }

    public function create()
    
    {
        return view('AdminSkill.create_skill');

    }

    public function store(Request $request)
    {
      $this->validate($request, [
        
            'technology'=>'required',
            'score'=>'required',


      ]);

      $skill = new Skill;
      $skill -> technology = $request -> technology;
      $skill -> score = $request -> score; 
      $skill->save();
      return redirect()-> route('admin.skills.create')->with('success', 'Skill Created Successfully');

    }
    
    public function destroy($id)
    {
        $skill = Skill::find($id);        
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'skill deleted Successfully!');
    }



}
