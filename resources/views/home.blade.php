@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <button id="addTaskBtn" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('task.script')
    <script>
        $(document).ready(function(){
            
            // modal
            taskmodal = $('#TaskModal')
            // modal container
            taskmodal_container = $('#TaskModalContainer')

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            })

            $('#addTaskBtn').on('click', function(){
                GetAddForm()
                taskmodal.modal('show')
            })

            $('#addTaskForm').on('submit', function(e) {
                e.preventDefault();
                alert()
            })

        })

        function GetAddForm() {
            $.get("{{Route('task.addform')}}", function(data){
                taskmodal_container.empty().html(data)
                GetCategories()
            });
        }

        function GetCategories() {
            $.get("{{Route('category.categories')}}", function(data){
                $("#categories_add").empty().html(data)
            });
        }

    </script>
@endsection
