<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Str;

class TodosController extends Controller
{
    public function index()
    {
      return view('todos.index')->with('todos', Todo::all());
    }

    public function show($slug)
    {
        // find method is for id
        // $slug = Todo::find($slug);

        // search by slug
        $todo = Todo::where('slug', $slug)->first();
        return view('todos.show')->with('todo', $todo);
    }

    public function create()
    {
      return view('todos.create');
    }

    public function store()
    {
      $this->validate(request(), [
        'name' => 'required|min:6|max:20',
        'description' => 'required'
      ]);

      $data = request()->all();

      $todo = new Todo();
      $todo->name = $data['name'];
      $todo->slug = Str::slug($data['name'], '-');
      $todo->description = $data['description'];
      $todo->completed = false;

      $todo->save();

      session()->flash('success', 'Todo created successfully.');

      return redirect('/todos');
    }

    public function edit(Todo $todo)
    {
      return view('todos.edit')->with('todo', $todo);
    }

    public function update(Todo $todo)
    {
      $this->validate(request(), [
        'name' => 'required|min:6|max:20',
        'description' => 'required'
      ]);

      $data = request()->all();

    //   $todo->name = $request->name;
      $todo->name = $data['name'];
      $todo->slug = Str::slug($data['name'], '-');
      $todo->description = $data['description'];
      $todo->save();

      session()->flash('success', 'Todo updated successfully.');

      return redirect('/todos');
    }

    public function destroy(Todo $todo)
    {
      $todo->delete();

      session()->flash('success', 'Todo deleted successfully.');

      return redirect('/todos');
    }

    public function complete(Todo $todo)
    {
      $todo->completed = true;
      $todo->save();

      session()->flash('success', 'Todo completed successfully.');

      return redirect('/todos');
    }

     public function undo($id)
    {
      $todo = Todo::find($id);
      $todo->completed = false;
      $todo->save();

      session()->flash('success', 'Undo successfully.');

      return redirect('/todos');
    }
}
