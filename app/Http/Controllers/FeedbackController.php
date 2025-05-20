<?php


namespace App\Http\Controllers;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackReply;



class FeedbackController extends Controller
{
    
    public function index()
    {
    $feedbacks = Feedback::latest()->get();
    return view('admin.feedback.index', compact('feedbacks'));
    }

    

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->reply = $request->reply;
        $feedback->save();

        // Send email using Mailtrap
        Mail::to($feedback->email)->send(new FeedbackReply($feedback));

        return back()->with('message', 'Reply sent to customer successfully!');
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->back()->with('message', 'Feedback deleted successfully.');
    }




    // // Store feedback from the form
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name'    => 'required|string|max:100',
    //         'email'   => 'required|email',
    //         'comment' => 'required|string',
    //         'status'  => 'required|in:bad,better,good,best',
    //     ]);

    //     Feedback::create([
    //         'name'    => $request->name,
    //         'email'   => $request->email,
    //         'comment' => $request->comment,
    //         'status'  => $request->status,
    //     ]);

    //     return back()->with('message', 'Feedback submitted successfully!');
    // }
}
