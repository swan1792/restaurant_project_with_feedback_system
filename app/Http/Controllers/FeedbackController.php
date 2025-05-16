<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    
    public function index()
    {
    $feedbacks = Feedback::latest()->get();
    return view('admin.feedback.index', compact('feedbacks'));
    }

    // Store feedback from the form
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'comment' => 'required|string',
            'status'  => 'required|in:bad,better,good,best',
        ]);

        Feedback::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'comment' => $request->comment,
            'status'  => $request->status,
        ]);

        return back()->with('message', 'Feedback submitted successfully!');
    }
}
