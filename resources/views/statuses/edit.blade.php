@extends('app')

@section('hero')

    <div class="col-md-12">
        <h3 class="lato-headers">Edit the Status For the {{ ucfirst($project->name) }} Project</h3>
    </div>

@stop

@section('content')

    <div class="container">

        <div class="col-md-3">
        <a href="{{ route('projects.show',$project->id) }}">
            <button class="btn btn-default">
                Back to Project
            </button>
        </a>
        </div>

        <div class="col-md-6">

            {!! Form::model($status, ['class' => 'form','method' => 'PATCH', 'route' => ['projects.statuses.update', $project->id, $status->id], 'class'=>''] ) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Update:') !!}
                    {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                    {!! Form::hidden('user_id', \Auth::user()->id) !!}
                    {!! Form::hidden('project_id', $project->id) !!}
                    {!! Form::hidden('last_updated_by', \Auth::user()->id) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Update Status',[ 'class' => "btn btn-primary" ]) !!}
                </div>

            {!! Form::close() !!}

            <div class="form-group">
                {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('projects.statuses.destroy', $project->id, $status->id))) !!}
                {!! Form::submit('Delete!', array('class' => 'btn btn-danger')) !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection