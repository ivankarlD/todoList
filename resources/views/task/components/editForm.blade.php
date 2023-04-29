<div class="modal-body">
    <form id="updateTaskForm" action="{{Route('task.update')}}" class="row" method="POST">
        @csrf
        <div class="mb-3 col-md-12">
            <textarea class="form-control" name="task_content" id="" cols="20" rows="5">{{ $task[0]->task_content }}</textarea>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-md-6">
            <label for="" class="form-label">Category</label>
            <select class="form-select" id="categories_add" value='{{ $task[0]->category_id }}' name="category_id" aria-label="Default select example"></select>
        </div>
        <div class="col-md-6">
            <label for="" class="form-label">Set Date</label>
            <input type="date" name="task_date" value="{{ $task[0]->task_date }}" class="form-control">
            <input type="hidden" name="task_id" value="{{ $task[0]->id }}" class="form-control">
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="FormUpdateSubmit()">Save</button>
    </form>
</div>