@extends('layouts.app')
@section('css')
<style>
    body {
        font-family: Arial, sans-serif;
    }
    .todo-container {
        max-width: 400px;
        margin: 0 auto;
    }
    .todo-header {
        text-align: center;
        background-color: #333;
        color: #fff;
        padding: 10px 0;
    }
    .todo-header h1 {
        margin: 0;
    }
    .todo-list {
        list-style: none;
        padding: 0;
    }
    .todo-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border: 1px solid #ddd;
        margin: 5px 0;
    }
    .todo-item input[type="checkbox"] {
        margin-right: 10px;
    }
    .todo-item .delete-btn {
        background-color: #f44336;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }
    .add-task {
        display: flex;
        margin-top: 20px;
    }
    .add-task input[type="text"] {
        flex: 1;
        padding: 10px;
    }
    .add-task button {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        padding: 10px;
        cursor: pointer;
    }
</style>
@endsection