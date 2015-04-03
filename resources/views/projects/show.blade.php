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
            @if (URL::previous('projects/mine'))
                <a href="{!! route('projects.mine') !!}">
                    <button class="btn btn-default center-block">
                        Back to Project List
                    </button>
                </a>
            @else
            <a href="{!! route('projects.index') !!}">
                <button class="btn btn-default center-block">
                    Back to Project List
                </button>
            </a>
            @endif
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

        <div class="col-md-2 text-center">

            @if(!$project->alreadySubscribed(\Auth::user()->id))
            <div class="form-group">
                {!! Form::open(array('class' => 'form-inline', 'route' => array('subscribe', $project->id))) !!}
                {!! Form::submit('Subscribe!', array('class' => 'btn btn-success project-delete center-block')) !!}
                {!! Form::close() !!}
            </div>
            @else
             <div class="form-group">
                {!! Form::open(array('class' => 'form-inline', 'route' => array('unsubscribe', $project->id))) !!}
                {!! Form::submit('Unsubscribe', array('class' => 'btn btn-default project-delete center-block')) !!}
                {!! Form::close() !!}
            </div>
            @endif

            @if(Auth::user()->hasRole('admin'))
            <div class="form-group">
                {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('projects.destroy', $project->id))) !!}
                {!! Form::submit('Delete Project', array('class' => 'btn btn-danger')) !!}
                {!! Form::close() !!}
            </div>
            @endif

        </div>
            <div class="col-md-9">
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
    </div>
</div>
@stop