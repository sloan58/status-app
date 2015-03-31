<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Status;
use App\Project;
use App\User;
use Carbon;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Http\Requests\StatusFormRequest;

class StatusesController extends Controller {


    /**
     * Require authentication for all methods
     */
    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Project $project)
    {
        return view('statuses.index', compact('project'));
    }

    /**
     * Display a listing of all Statuses.
     *
     * @return Response
     */
    public function all()
    {
        $statuses = Todo::all();
        return view('statuses.all', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Project $project)
    {
        return view('statuses.create', compact('project'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Project $project, StatusFormRequest $request)
    {
        Status::create(\Input::all());

        Project::find($project->id)->touch();
        Project::find($project->id)->update(['last_updated_by' => \Input::get('last_updated_by')]);

        Flash::success('Your status has been created!');
        return redirect()->route('projects.show', [ $project->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @internal param Status $status
     * @internal param int $id
     * @return Response
     */
    public function show(Project $project, Status $status)
    {
        return view('statuses.edit', compact('project', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Status $status
     * @internal param int $id
     * @return Response
     */
    public function edit(Project $project, Status $status)
    {
        return view('statuses.edit', compact('project', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Status $status
     * @internal param int $id
     * @return Response
     */
    public function update(Project $project, User $user, Status $status)
    {

        $status->update(\Input::all());

        Project::find($project->id)->touch();
        Project::find($project->id)->update(['last_updated_by' => \Input::get('last_updated_by')]);

        Flash::success('Your status has been updated!');
        return redirect()->route('projects.show', [ $project->id ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Status $status
     * @internal param int $id
     * @return Response
     */
    public function destroy(Project $project, Status $status)
    {
        $status->delete();

        Project::find($project->id)->touch();

        Flash::success('Your status has been deleted!');
        return redirect()->route('projects.show', [ $project->id ]);

    }

}
