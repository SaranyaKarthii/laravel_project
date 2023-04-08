<?php

namespace App\Http\Controllers;

use App\Helpers\helpers;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Publication;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index(){
        $pageData = array(
            "portfolio"=>Portfolio::select(['portfolios.*', 'portfolio_categories.name as category'])->join("portfolio_categories", 'portfolio_categories.id', 'portfolios.category_id')->orderBy("portfolios.id", "DESC")->get(),
            "publication"=>Publication::orderBy("id", "DESC")->get(),
            "category"=>PortfolioCategory::get(),
            "testimonials"=>Testimonial::orderBy("id", "DESC")->get(),
        );
        return view("page.index", $pageData);
    }

    public function download_cv(){
        $user = User::where("id", 1)->first();
        return redirect($user->resume_url);
    }
}
