<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Dashboard</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                   <a href="{{route('logout')}}" class="btn btn-primary">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Hello, {{ Auth::user()->name }}!</h1>
            <p class="lead">Welcome to your dashboard.</p>
            <hr class="my-4">
        </div>

        {{-- Add Task --}}
        <div class="mb-3">
            <h3>Add New Task</h3>
            <form id="add-task-form">
                <div class="mb-3">
                    <label for="task" class="form-label">Task</label>
                    <input type="text" id="task" class="form-control" name="task" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Task</button>
            </form>
        </div>

        {{-- Task List --}}
        <h3>Tasks</h3>
        <ul id="task-list" class="list-group mt-4">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center" data-id="{{ $task->id }}">
                    <span>{{ $task->task }}</span>
                    <div>
                        <span class="badge {{ $task->status == 'done' ? 'bg-success' : 'bg-warning' }}">{{ $task->status }}</span>
                        <button class="btn btn-sm btn-primary toggle-status">{{ $task->status == 'done' ? 'Mark as Pending' : 'Mark as Done' }}</button>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    <script>
        $(document).ready(function() {
            // Handle status toggle
            $('#task-list').on('click', '.toggle-status', function() {
                var listItem = $(this).closest('li');
                var taskId = listItem.data('id');
                var currentStatus = listItem.find('.badge').hasClass('bg-success') ? 'done' : 'pending';
                var newStatus = currentStatus === 'done' ? 'pending' : 'done';
        
                $.ajax({
                    url: '/api/todo/status',
                    type: 'POST',
                    data: {
                        task_id: taskId,
                        status: newStatus,
                        _token: '{{ csrf_token() }}' // include csrf token
                    },
                    headers: {
                        'API_KEY': 'helloatg'
                    },
                    success: function(response) {
                        console.log('Status change response:', response);
                        if (response.status === 1) {
                            listItem.find('.badge').text(response.task.status)
                                .removeClass('bg-success bg-warning')
                                .addClass(response.task.status === 'done' ? 'bg-success' : 'bg-warning');
                            listItem.find('.toggle-status').text(response.task.status === 'done' ? 'Mark as Pending' : 'Mark as Done');
                        } else {
                            alert('Error: ' + response.message);
                        }
                    }
                });
            });
        
            // Handle add task form submission
            $('#add-task-form').submit(function(e) {
                e.preventDefault();
                var task = $('#task').val();
        
                $.ajax({
                    url: '/api/todo/add',
                    type: 'POST',
                    data: {
                        task: task,
                        user_id: {{ Auth::user()->id }},
                        _token: '{{ csrf_token() }}' // include csrf token
                    },
                    headers: {
                        'API_KEY': 'helloatg'
                    },
                    success: function(response) {
                        console.log('Add task response:', response);
                        if (response.status == 1) {
                            $('#task-list').append('<li class="list-group-item d-flex justify-content-between align-items-center" data-id="' + response.task.id + '">' +
                                '<span>' + response.task.task + '</span>' +
                                '<div>' +
                                '<span class="badge bg-warning">pending</span>' +
                                '<button class="btn btn-sm btn-primary toggle-status">Mark as Done</button>' +
                                '</div>' +
                                '</li>');
                            $('#task').val('');
                            alert(response.message);
                        } else {
                            alert('Error: ' + response.message);
                        }
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
