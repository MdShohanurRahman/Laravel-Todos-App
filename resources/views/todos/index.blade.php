@extends('layouts.app')

@section('title')
Todos List
@endsection

@section('content')
  <h1 class="text-center my-5">TODOS PAGE</h1>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">
          Todos
        </div>

        <div class="card-body">
          <ul class="list-group">
            @foreach($todos as $todo)
              <li class="list-group-item">

                  @if ($todo->completed)
                    <del>{{ $todo->name }}</del>
                  @else
                     {{ $todo->name }}
                  @endif


                @if(!$todo->completed)
                  <a href="/todos/{{ $todo->id }}/complete" style="color: white;" class="btn btn-warning btn-sm float-right">Complete</a>
                @endif

              <a href="{{route('single_todo', $todo->slug) }}" class="btn btn-primary btn-sm float-right mr-2">View</a>
                @if($todo->completed)
                <a href="{{route('undo', $todo->id) }}" class="btn btn-success btn-sm float-right mr-2">Undo</a>
                @endif
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection
