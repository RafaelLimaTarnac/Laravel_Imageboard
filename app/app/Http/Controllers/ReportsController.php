<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Report;
use App\Models\Post;
use App\Models\Comment;

class ReportsController extends Controller
{
    public function report(Request $request){
        if(!Auth::check())
            return redirect('/');


        switch($request->type){
            case 'comment':
                $report = Report::select()->where('id_user', Auth::user()->id)->where('reportable_type', Comment::class)->where('reportable_id', $request->id)->first();
            break;
            case 'post':
                $report = Report::select()->where('id_user', Auth::user()->id)->where('reportable_type', Post::class)->where('reportable_id', $request->id)->first();
            break;
        }

        if($report == null)
            $report = new Report();

        $report->id_user = Auth::user()->id;
        $report->message = $request->content;
        $report->message = $request->content;
        switch($request->type){
            case 'comment':
                $report->reportable_type = Comment::class;
            break;
            case 'post':
                $report->reportable_type = Post::class;
            break;
        }
        $report->reportable_id = $request->id;

        $report->save();

        return redirect()->back();
    }
    public function list(){
        $obj = Report::with('reportable')->get();
        // separar os tipos aq dentro
        return View("reports.index", ['reports'=>$obj]);
    }
}