@extends('layouts.app')

@section('task.style')
    <style>
        .taskItem {
            /* border: dotted red 1px; */
            box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
        }

        .taskBtn {
            background: transparent;
            border: none;
        }

        .flexCheck {
            height: 20px;
            width: 20px;
            margin: 0;
            padding: 0;
        }


    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <button id="addTaskBtn" class="btn btn-primary mb-3">Add</button>
                    {{-- start category --}}
                    <div id="categoryContainer" class="mb-3">
                        <select class="form-control" onchange="GetTask()" name="" id="categorySelect"></select>
                    </div>
                    {{-- end category --}}
                    {{-- start task --}}
                    <div id="task" class="mb-3">
                        
                    </div>
                    {{-- end task --}}
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

            $.get("{{Route('category.categories')}}", function(data){
                $("#categorySelect").empty().html(data)
            });
            
            GetTask();

            $('#addTaskBtn').on('click', function(){
                GetAddForm()
                taskmodal.modal('show')
            })
        });

        function ChangeStatus(input){
            let data = {
                'task' : input.getAttribute('data-id'),
                'status' : $('#' + input.getAttribute('id')).is(":checked")
            };
            $.ajax({
                type: "POST",
                url: "{{ Route('task.status')}}",
                // data: JSON.stringify(data),
                data: data,
                beforeSend: function() {
                    
                },
                success: function(response) {
                    GetTask()
                },
                async: true,
                error: function(e) {
                    console.log(e);
                },
                cache: false,
            });
        }
        function GetTask() {
            id = $('#categorySelect').val();
            let route = '/home/task/index/' + id;
            $.get(route , function(data){
                $('#task').empty().html(data)
            });
        }

        function GetAddForm() {
            $.get("{{Route('task.addform')}}", function(data){
                taskmodal_container.empty().html(data)
                GetCategoriesAddForm()
            });
        }

        function GetCategoriesAddForm() {
            $.get("{{Route('category.categories')}}", function(data){
                $("#categories_add").empty().html(data)
            });
        }

        function FormAddSubmit(){
            const data = $('#addTaskForm').serialize();
            $.ajax({
                type: "POST",
                url: "{{ Route('task.store')}}",
                data: data,
                beforeSend: function() {
                    
                },
                success: function(response) {
                    if(response['success'] !== undefined) {
                        taskmodal.modal('hide')
                        GetTask()
                    } else {
                        $.each( response['error'], function( key, value ) {
                            $(`[name='${key}']`).addClass('is-invalid')
                            $(`[name='${key}']`).next().html(value)
                        });
                    } 
                    
                },
                async: true,
                error: function(e) {
                    console.log(e);
                },
                cache: false,
            });
        }
        
        function FormUpdateSubmit(){
            const data = $('#updateTaskForm').serialize();
            $.ajax({
                type: "POST",
                url: "{{ Route('task.update')}}",
                data: data,
                beforeSend: function() {
                    
                },
                success: function(response) {
                    if(response['success'] !== undefined) {
                        taskmodal.modal('hide')
                        GetTask()
                    } else {
                        $.each( response['error'], function( key, value ) {
                            $(`[name='${key}']`).addClass('is-invalid')
                            $(`[name='${key}']`).next().html(value)
                        });
                    }
                   
                },
                async: true,
                error: function(e) {
                    console.log(e);
                },
                cache: false,
            });
        }

        function edit(task) {
            let route = '/home/task/edit/' + task;
            $.get(route , function(data){
                taskmodal_container.empty().html(data)
                GetCategoriesAddForm()
                taskmodal.modal('show')
            });
        }

    </script>
@endsection
