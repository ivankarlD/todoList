
@if (count($notDone) != 0)
    @foreach ($notDone as $task)
        <div class="taskItem p-3 mb-3">
            <div class="row">
                <div class="col-md-1">
                    <input class="form-check-input flexCheck" @if ($task->task_status) {{  $status='checked'; }} @endif onchange="ChangeStatus(this)" type="checkbox" data-id="{{$task -> id}}" id="flexCheck{{$task -> id}}">
                </div>
                <button class="taskBtn col" onclick="edit({{$task->id}})">
                    <p class=" m-0 text-truncate text-start">{{ $task->task_content }}</p>
                </button>
                <p class="col-md-3 m-0">{{ $task->task_date }}</p>
            </div>
        </div>
    @endforeach
@else
<div class="taskItem p-3 mb-3">
    <p class="m-0">No Task</p>
</div>
@endif
<div class="done">
    <p>Done</p>
</div>
@if (count($done) != 0)
    @foreach ($done as $task)
        <div class="taskItem p-3 mb-3">
            <div class="row">
                <div class="col-md-1">
                    <input class="form-check-input flexCheck" @if ($task->task_status) {{  $status='checked'; }} @endif onchange="ChangeStatus(this)" type="checkbox" data-id="{{$task -> id}}" id="flexCheck{{$task -> id}}">
                </div>
                <button class="taskBtn col" onclick="edit({{$task->id}})">
                    <p class="m-0 text-truncate text-start">{{ $task->task_content }}</p>
                </button>
                <p class="col-md-3 m-0">{{ $task->task_date }}</p>
            </div>
        </div>
    @endforeach
@else
<div class="taskItem p-3 mb-3">
    <p class="m-0">No Task</p>
</div>
@endif