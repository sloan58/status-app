@extends('app')

@section('content')

    @section('hero')

        <div class="col-md-12 text-center">
            <h3 class="lato-headers hero">Edit the {{ ucfirst($project->name) }} Project</h3>
        </div>

    @stop

<div class="container">

    <div class="row">
        <div class="col-md-2 col-md-offset-4">
            <a href="{!! route('projects.index') !!}">
            <button class="btn btn-default center-block">
                Back to Project List
            </button>
            </a>
        </div>
        <div class="col-md-2">
        <a href="{!! route('projects.statuses.create', $project->id) !!}">
            <button class="btn btn-default center-block">
                Add a New Status
            </button>
        </a>
        </div>
    </div>

    <hr>

    <div class="row">
    @if($project->status->count())
        <div class="row table-top-margin">
            <div class="col-md-10 col-md-offset-1">
                <table id="status-table" class="display table table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Added By</th>
                            <th>Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($project->status as $status)
                        <tr>
                            <td><a href="{{ route('projects.statuses.edit', [$project->id, $status->id])  }}">{{ str_limit($status->body, $limit = 30, $end = '...')  }}</a></td>
                            <td>{{$status->user->name}}</td>
                            <td>{{$status->updated_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
    <div class="row table-top-margin">
        <div class="col-md-6 col-md-offset-3 lato-headers text-center">
            <h2>No Status Updates.....</h2>
            <h2><a href="{!! route('projects.statuses.create', $project->id) !!}">Add One!</a></h2>
        </div>
    </div>
    @endif
        <div class="col-md-2 col-md-offset-1">
            {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('projects.destroy', $project->id))) !!}
            {!! Form::submit('Delete Project', array('class' => 'btn btn-danger')) !!}
            {!! Form::close() !!}
        </div>

    </div>
</div>
@stop