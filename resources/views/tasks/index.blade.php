@extends('layouts.app')

@section('content')


    <h1>タスク一覧</h1>
    
    @if (count($tasks) > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>タスク</th>
                <th>進歩状況</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{!! link_to_route('tasks.show', $task->id, ['id' => $task->id]) !!}</td>
                    <td>{{ $task->content }}</td>
                    <td>{{ $task->status }}</td>
                </tr>
            @endforeach
        </tbody>    
    </table>
   
    
    {!! link_to_route('tasks.create', '新規タスクの作成', null, ['class' => 'btn btn-primary']) !!}
    
    @else
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Let's Create New Task!</h1>
            {!! link_to_route('tasks.create', '新規タスクの作成', null, ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    @endif
    
@endsection