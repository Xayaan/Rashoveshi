<?php

namespace App\Http\Controllers\Badha;
use App\Http\Requests\Poll\Create as Create;
use App\Http\Requests\Poll\Update as Update;
use App\Poll;
use App\Choice;

class PollsController extends AuthorizedController {

	protected $polls;

	public function __construct(Poll $polls) {
		parent::__construct();
		$this->polls = $polls;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$polls = $this->polls->paginate(10);

		return view('badha.polls.index', compact('polls'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$poll = $this->polls;

		return view('badha.polls.form', compact('poll'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Create $request) {

        $poll = Poll::create([
                    'title' => $request->title,
                    'desc'  => $request->desc,
        ]);

        foreach ($request->choices as $choice) {
            $pollChoice = Choice::create([
                    'poll_id' => $poll->id,
                    'name'    => $choice,
            ]);

            $poll->choices()->save($pollChoice);
        }

		// Redirect to the users listing
		return redirect(route('poll.index'))->withSuccess(
			trans('polls/messages.success.create')
		);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		// Get the user object
		if ($poll = $this->polls->find($id)) {

			// Show the form
			return view('badha.polls.form', compact('poll'));
			// } else {
			// return redirect(route('badha.dashboard'))->withErrors(
			// 	trans('users/messages.no_access', compact('id'))
			// );
			// // }
		}

		// Redirect to the users listing
		return redirect(route('badha.dashboard'))->withErrors(
			trans('polls/messages.not_found', compact('id'))
		);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Update $request, $id) {
		// Get the poll object
		$poll = $this->polls->find($id);

		// Get the submited request data
		$input = $request->all();
		// Update the polls
		$poll->fill($input)->save();

		$poll->choices()->delete();

        foreach ($request->choices as $choice) {
            $pollChoice = Choice::create([
                    'poll_id' => $poll->id,
                    'name'    => $choice,
            ]);

            $poll->choices()->save($pollChoice);
        }

		return redirect(route('poll.index'))->withSuccess(trans('polls/messages.success.update'));

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function delete($id) {
		if ($poll = $this->polls->findOrfail($id)->delete()) {
			return redirect(route('poll.index'))->withErrors(trans('polls/messages.success.delete'));
		}
		return redirect(route('poll.index'))->withErrors(trans('polls/messages.error.delete'));
	}
}
