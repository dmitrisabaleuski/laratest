<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedbacks;
class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $name = "Feedback list";
	    $feedback = (new Feedbacks)->select([
	    	'id',
		    'text',
		    'status',
		    'creater',
		    'email',
		    'phone',
		    'editor',
	    ])->get();
	    return view('/feedback-list')->with([
		    'feedback'=>$feedback,
		    'name'=>$name,
	    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

	    $newFeedback = new Feedbacks;
	    $newFeedback->fill([
		    'text' => "$request->feedback",
		    'status' => "0",
		    'creater' => "$request->name",
		    'email' => "$request->email",
		    'phone' => "$request->number",
			'editor' => '',
	    ]);

	    $newFeedback->save();

	    return redirect('page_success')->with(['message' => 'Thx for your feedback',]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	    $name = "Feedback Show";
	    $feedback = (new Feedbacks)->select([
		    'id',
		    'text',
		    'status',
		    'creater',
		    'email',
		    'phone',
		    'editor',
		    'updated_at',
	    ])->where('id', $id)->first();
		$status = 'Viewed';
		if($feedback['status'] == 0){
			$status = 'Not Viewed';
		}
	    return view('single-feedback')->with([
		    'feedback' => $feedback,
		    'status' => $status,
		    'name' => $name,
	    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $name = "Feedback Edit";
	    $feedback = (new Feedbacks)->select([
		    'id',
		    'text',
		    'status',
		    'creater',
		    'email',
		    'phone',
		    'editor',
		    'updated_at',
	    ])->where('id', $id)->first();
	    $status_array = [
	    	'Not Viewed',
		    'Viewed'
	    ];
	    return view('single-feedback-edit')->with([
		    'feedback' => $feedback,
			'array' => $status_array,
		    'name' => $name,
	    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
	    $feedback = (new Feedbacks)->find($id);
	    $feedback->fill([
		    'text' => "$request->text",
		    'status' => "$request->status",
		    'creater' => "$request->author",
		    'email' => "$request->email",
		    'phone' => "$request->phone",
		    'editor' => "$request->new_editor",
		    ]);
	    $feedback->update();
	    return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    $feedback = (new Feedbacks)->where('id', $id)->first();
	    $feedback->delete();
	    return $this->index();
    }
}
