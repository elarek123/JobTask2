@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Task list with pagination -->
        <div class="row">
            <div class="col-md-12">
                <!-- Task list -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style ="float: left;"> Task List </h3>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#taskModal"
                            style="float: right;">
                            Create Task
                        </button>
                    </div>


                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                    @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td> <td> {{ $task->description }} </td> <td>{{ $task->currentStatus() }} </td>
                                            <td>
                                                <form id="statusForm" method ="POST"
                                                        action="{{ route('task.delete', '$task->id') }}" style = "display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger delete-btn"
                                                            style="float: right ;">
                                                            Delete
                                                        </button>
                                                    </form>
                                                    <button type="button" class="btn btn-primary history-btn" data-toggle="modal"
                                                        data-target="#getStatusModal" style="float: right; margin-right: 5px;"
                                                        data-editId="{{ $task->id }}">
                                                        History
                                                    </button>

                                                    <button type="button" class="btn btn-primary status-btn" data-toggle="modal"
                                                        data-target="#editStatusModal" style="float: right; margin-right: 5px;"
                                                        data-editId="{{ $task->id }}">
                                                        Update status
                                                    </button>
                                                    <button type="button" class="btn btn-primary edit-btn" data-toggle="modal"
                                                        data-target="#editTaskModal" style="float: right; margin-right: 5px;"
                                                        data-editId="{{ $task->id }}">
                                                        Edit task
                                                    </button>
                                            </td>
                                            
                                    
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class = "w-20 d-flex justify-content-left h-20">
                    {{ $tasks->links('pagination::bootstrap-4') }}
                </div>
            </div>

        </div>

        <!-- Modal for creating and editing tasks -->
        <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel"
            aria-hidden="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal content for creating and editing tasks -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="taskModalLabel">Create Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="taskForm" method ="POST" action="{{ route('store') }}">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <!-- Form for creating and editing tasks -->
                            <!-- Task input fields -->
                            <div class="form-group">
                                <label for="taskName">Title</label>
                                <input type="text" class="form-control" id="taskName" placeholder="Enter task name"
                                    name="title">
                                <label for="taskName">Description</label>
                                <textarea type="text" class="form-control" id="taskName" placeholder="Enter task name" name="description"></textarea>

                            </div>
                            <!-- Additional input fields for task details -->
                            <!-- ... -->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel"
            aria-hidden="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal content for creating and editing tasks -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="taskModalLabel">Edit Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="taskFormEdit" method ="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <!-- Form for creating and editing tasks -->
                            <!-- Task input fields -->
                            <div class="form-group">
                                <label for="taskName">Title</label>
                                <input type="text" class="form-control" id="editTaskTitle"
                                    placeholder="Enter task name" name="title">
                                <label for="taskName">Description</label>
                                <textarea type="text" class="form-control" id="editTaskDescription" placeholder="Enter task name"
                                    name="description"></textarea>

                            </div>
                            <!-- Additional input fields for task details -->
                            <!-- ... -->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editStatusModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel"
            aria-hidden="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal content for creating and editing tasks -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="taskModalLabel">Update Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="statusFormEdit" method ="POST">
                        @csrf
                        <div class="modal-body">
                            <!-- Form for creating and editing tasks -->
                            <!-- Task input fields -->
                            <div class="form-group">
                                <label for="taskName">Select</label>
                                <select class="form-control" id="editTaskStatus" name="status">
                                    <option value="0">Created</option>
                                    <option value="1">In Progress</option>
                                    <option value="2">Completed</option>
                                </select>

                            </div>
                            <!-- Additional input fields for task details -->
                            <!-- ... -->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal for viewing status change history -->
        <div class="modal fade" id="getStatusModal" tabindex="-1" role="dialog" aria-labelledby="historyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="historyModalLabel">History</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Changed at</th>
                                </tr>
                            </thead>
                            <tbody id="historyTableBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var statusHistory = [
            'Created',
            'In Progress',
            'Completed'
        ];
        document.querySelectorAll('.edit-btn').forEach(function(element) {
            element.addEventListener('click', function(event) {
                const buttonData = event.target.dataset;
                const editId = buttonData.editid;
                $.ajax({
                    type: "GET",
                    url: "{{ route('task', ':task') }}".replace(':task', editId),

                    data: {
                        task: editId
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        document.getElementById('taskFormEdit').action =
                            "{{ route('task.update', ':task') }}".replace(':task', editId);
                        document.getElementById('editTaskTitle').value = data.data.title;
                        document.getElementById('editTaskDescription').value = data.data
                            .description;
                    }
                })

            })
        });

        document.querySelectorAll('.status-btn').forEach(function(element) {
            element.addEventListener('click', function(event) {
                const buttonData = event.target.dataset;
                const editId = buttonData.editid;
                $.ajax({
                    type: "GET",
                    url: "{{ route('task', ':task') }}".replace(':task', editId),

                    data: {
                        task: editId
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        document.getElementById('statusFormEdit').action =
                            "{{ route('status', ':task') }}".replace(':task', editId);
                        $('#editTaskStatus').val(data.status);
                    }
                })

            })
        });

        document.querySelectorAll('.history-btn').forEach(function(element) {
            element.addEventListener('click', function(event) {
                const buttonData = event.target.dataset;
                const editId = buttonData.editid;
                $.ajax({
                    type: "GET",
                    url: "{{ route('statusAll', ':task') }}".replace(':task', editId),

                    data: {
                        task: editId
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        data = JSON.parse(data).status;
                        const tableBody = document.getElementById('historyTableBody');
                        tableBody.innerHTML = '';
                        data.forEach(function(item) {
                            // Create a table row
                            const row = document.createElement('tr');

                            // Create table data cells and set their content
                            const idCell = document.createElement('td');
                            idCell.textContent = statusHistory[item.status];
                            const nameCell = document.createElement('td');
                            nameCell.textContent = item.created_at;

                            // Append the cells to the row
                            row.appendChild(idCell);
                            row.appendChild(nameCell);

                            // Append the row to the table body
                            tableBody.appendChild(row);
                        });

                    }
                })

            })
        });
    </script>
@endsection
