@extends('app')

@section('hero')

    <div class="col-md-12">
        <h3 class="lato-headers">Add New Status For the {{ ucfirst($project->name) }} Project</h3>
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

            {!! Form::model(new App\Status, ['route' => ['projects.statuses.store', $project->id], 'class'=>'']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Update:') !!}
                    {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
                    {!! Form::hidden('user_id', \Auth::user()->id) !!}
                    {!! Form::hidden('project_id', $project->id) !!}
                    {!! Form::hidden('last_updated_by', \Auth::user()->id) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Create Status',[ 'class' => "btn btn-primary" ]) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection