<div class="modal-body">
    <form id="addTaskForm" action="{{Route('task.store')}}" class="row" method="POST">
        @csrf
        <div class="mb-3 col-md-12">
            <textarea class="form-control" name="task_content" id="" cols="20" rows="5">Type here...</textarea>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-md-6">
            <label for="" class="form-label">Category</label>
            <select class="form-select" id="categories_add" name="category_id" aria-label="Default select example"></select>
        </div>
        <div class="col-md-6">
            <label for="" class="form-label">Set Date</label>
            <input type="date" name="task_date" class="form-control">
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="FormAddSubmit()">Save</button>
    </form>
</div>