<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodosController extends Controller
{
    public function index()
    {
        return view('todos.index')->with('todos', Todo::all());
    }

    public function show(Todo $todo)
    {
        return view('todos.show')->with('todo', $todo);
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:6|max:12',
            'description' => 'required',
        ]);



        $data = request()->all();

        $todo = new Todo();
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->completed = false;

        $todo->save();

        session()->flash('Success', 'To do created succesfully');

        return redirect('/todos');
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit',)->with('todo', $todo);
    }

    public function update(Todo $todo)
    {

        $this->validate(request(), [
            'name' => 'required|min:6|max:12',
            'description' => 'required',
        ]);

        $data = request()->all();

        $todo->name = $data['name'];
        $todo->description = $data['description'];


        $todo->save();

        session()->flash('Success', 'To do edited succesfully');

        return redirect('/todos');


    }

    public function delete(Todo $todo)
    {

        $todo -> delete();

        session()->flash('Success', 'To do deleted succesfully');

        return redirect('/todos');
    }

    public function complete(Todo $todo)
    {
        $todo->completed = true;
        $todo->save();

        session()->flash('Success', 'To do completed succesfully');

        return redirect('/todos');
    }
}
