@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-3 col-lg-6">

            <h1>id : {{ $task->id  }} のタスク編集ページ</h1>
            
            {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'put']) !!}
            
                <div class="form-group">
                        {!! Form::label('content', 'タスク内容:') !!}
                        {!! Form::text('content', old('content'), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                        {!! Form::label('status', '進歩状況:') !!}
                        {!! Form::text('status', old('status'),['class' => 'form-control']) !!}
                </div>
                {!! Form::submit('更新', ['class' => 'btn btn-default']) !!}
        
            {!! Form::close() !!}
        </div>
    </div>
    
    
    
@endsection