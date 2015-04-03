@extends('...app')

@section('content')

    @section('hero')


        @if(\Auth::user())
            {!! Form::open(['url' => 'projects', 'class' => 'form']) !!}

            <div class="col-md-4 col-md-offset-4 todo-list">
                <p class="input-group">
                    {!! Form::text('name', null,['required', 'class'=>'form-control', 'placeholder'=>'Add a new project here']) !!}
                    {!! Form::hidden('created_by', \Auth::user()->id) !!}
                    {!! Form::hidden('last_updated_by', \Auth::user()->id) !!}
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </span>
                </p>
            </div>

            {!! Form::close() !!}
        @endif
    @stop

<div class="container">
    <div class="row">
     @if($projects->count())
        <div class="col-md-4 col-md-offset-4 vcenter">
            <div class="text-center lato-headers">
            @if (Request::is('projects/mine'))
                My Projects Listing
            @else
                All Projects Listing
            @endif
            </div>
        </div>
    </div>

    <div class="row table-top-margin">

            <div class="col-md-10 col-md-offset-1">

                        <table id="project-table" class="display table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Project Name</th>
                                        <th>Last Updated By</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($projects as $project)
                                    <tr>
                                        <td><a href="{{ route('projects.show', $project->id)  }}">{{ $project->name }}</a></td>
                                        <td>{{$project->lastUpdatedBy->name}}</td>
                                        <td>{{Carbon::parse($project->created_at)->toFormattedDateString()}}</td>
                                        <td>{{$project->updated_at->diffForHumans()}}</td>
                                    </tr>
                                 @endforeach
                                </tbody>
                        </table>

                    </div>



        @else
        @if (Request::is('projects/mine'))
            <div class="col-md-8 col-md-offset-2">
                <h2 class="lato-headers text-center">There are no projects assigned to you.</h2>
            </div>
            <div class="col-md-8 col-md-offset-2 text-center">
                <h2><a href="{!! route('projects.index') !!}">View All Projects</a></h2>
            </div>
        @else
            <div class="col-md-4 col-md-offset-4">
                <h2 class="lato-headers text-center">No Projects..... Add One!</h2>
            </div>
        @endif
        @endif
    </div>
</div>
@stop