<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    
    <title>To-Do List</title>
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
    
</head>
<body>
    <div class="todo-container">
        
        <div class="todo-header">
            <h1>To-Do List</h1>
        </div>

        <form class="add-form" action="{{route('add.task')}}" method="POST">
            @csrf
            <div class="add-task">
                <input  type="text" name ='task' id = 'task' placeholder="Add a new task">
                <button class = "add-tasks">Add</button>
            </div>
        </form>
        
        
        
        <div class = 'container'>
            @foreach ($tasks as $item)
            <ul class="todo-list">
                <li class="todo-item">
                    <form class='complete-task' action="/complete-task/{{$item->id}}" method="put">
                        @csrf
                        @if($item->iscompleted == 1)
                            <input class='complete' type="checkbox" value="{{$item->id}}" checked >
                        @else
                            <input class='complete' type="checkbox"  value="{{$item->id}}">
                        @endif
                    </form>
                    <span>{{$item->task}} {{$item->id}}</span>
                    <form class="delete-task" action="/delete-task/{{$item->id}}" method="POST">
                        @csrf
                       {{-- <input type="hidden"  id='id_task' > --}}
                    <button class="delete-btn" value="{{$item->id}}">Delete</button>
                    </form>
                </li>
            </ul>
            @endforeach
        </div>
        
    </div>
    <div id="error-container" class="error-message"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script>
$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
</script>
<script>
    $(document).ready(function(){
        // alert('hello');
        $(document).on('click','.delete-btn',function(e){
            e.preventDefault();
            let id = $(this).val();
            
            
            $.ajax({
                url:"/delete-task/"+id+"",
                method:'POST',
                data:{id:id},
                success:function(res){
                    if(res.status == 'success'){
                        $('.todo-container').load(location.href + ' .todo-container');
                        Command: toastr["success"]("Task deleted!", "Success")

                        toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        }
                    }
                },error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors,function(index,value){
                        $('.error-message').append('<span class="text-danger">'+value+'</span>'+'<br>');
                    })
                    
                }
            })
        })

        $(document).on('click','.complete',function(e){
            e.preventDefault();
            let id = $(this).val();
            $.ajax({
                url:"/complete-task/"+id+"",
                method:'put',
                data:{id:id},
                success:function(res){
                    if(res.status == 'success'){
                        $('.todo-container').load(location.href + ' .todo-container');
                        Command: toastr["success"]("Task completed!", "Success")

                        toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        }
                    }
                },error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors,function(index,value){
                        $('.error-message').append('<span class="text-danger">'+value+'</span>'+'<br>');
                    })
                    
                }
            })
        })

        $(document).on('click','.add-tasks',function(e){
            e.preventDefault();
            let task = $('#task').val();
            // console.log(task);
            $.ajax({
                url:"{{route('add.task')}}",
                method:'POST',
                data:{task:task},
                success:function(res){
                    if(res.status == 'success'){
                        $('.add-form')[0].reset();
                        $('.todo-container').load(location.href + ' .todo-container');
                        Command: toastr["success"]("Task add!", "Success")

                        toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        }
                    }
                },error:function(err){
                    let error = err.responseJSON;
                    $.each(error.errors,function(index,value){
                        $('.error-message').append('<span class="text-danger">'+value+'</span>'+'<br>');
                    }) 
                }
            });
        })

        
    });
</script>
{!! Toastr::message() !!}
</body>
</html>

    






