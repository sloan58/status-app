<?php namespace App\Http\Controllers;


use App\Project;
use App\Http\Requests;
use App\User;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectFormRequest;

class ProjectsController extends Controller {


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
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    /**
     * Display a listing of the resource belonging to the logged in user.
     *
     * @return Response
     */
    public function mine()
    {
        $projects = \Auth::user()->project()->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ProjectFormRequest $request)
    {

        Project::create(\Request::all());

        Flash::success('Your project has been created.  Now add a Status!');
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @internal param int $id
     * @return Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @internal param int $id
     * @return Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectFormRequest $request
     * @internal param Project $project
     * @internal param int $id
     * @return Response
     */
    public function update(ProjectFormRequest $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @internal param int $id
     * @return Response
     */
    public function destroy(Project $project)
    {

        $project->delete();

        Flash::success('The project has been deleted!');
        return redirect()->route('projects.index');

    }

    /**
     * Subscribe user to project
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe($id)
    {

        User::find(\Auth::user()->id)->subscriptions()->attach($id);

        Flash::success('You are now subscribed to this project!');
        return redirect()->route('projects.show', [ $id ]);

    }

    /**
     * Unsubscribe user from project
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unsubscribe($id)
    {

        User::find(\Auth::user()->id)->subscriptions()->detach($id);

        Flash::success('You are now unsubscribed to this project.');
        return redirect()->route('projects.show', [ $id ]);

    }
}
