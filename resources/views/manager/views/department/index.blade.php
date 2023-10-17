@php
    $count = 1;
@endphp
@extends('manager/layout/Layout')
@section('content')
    <div class="container-fluid">
        <h1>Department</h1>
        <div class="row">
            <div class="col-lg-4">
                <div class="shadow-lg p-3 mb-5 bg-body rounded">
                    <form action="{{route('admin-add-department')}}" method="post" onsubmit="return validate()">
                        @csrf
                        <input type="hidden" id="hidden" name="id" value="{{$hiddenId}}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Department name:</label>
                            <input type="text" id="name" name="name" class="form-control"
                                   placeholder="department name...">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="number" min="0" id="quantity" name="quantity" class="form-control"
                                   placeholder="quantity...">
                        </div>
                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" checked name="status" class="custom-control-input form-control-lg"
                                   id="status">
                            <label class="custom-control-label" for="status">Status</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 shadow-lg p-3 mb-5 bg-body rounded">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Department name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($departments as $department)
                        <tr>
                            <th scope="row">{{$count++}}</th>
                            <td>{{$department->name}}</td>
                            <td>{{$department->quantity}}</td>
                            <td>
                                <span class="badge badge-{{$department->status==1?'success':'danger'}}">
                                    {{$department->status==1?'active':'hide'}}</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <div>
                                        <button type="button" class="btn btn-warning btn-sm mr-1"
                                                onclick="updateDepartment({{$department->id}},'{{$department->name}}'
                                   ,{{$department->quantity}},'{{$department->status}}')">
                                            <i class="fas fa-edit pr-1"></i>Sửa
                                        </button>
                                    </div>
                                    <form action="{{route('admin-delete-department', $department->id)}}"
                                          method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure???')">
                                            <i class="fas fa-trash pr-1"></i>Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function validate() {
            let departmentName = $('#name');
            let quantity = $('#quantity');
            if (isInputEmpty(departmentName)) {
                notification('warning', 'department name cant be empty');
                return false;
            }
            if (isInputEmpty(quantity)) {
                notification('warning', 'quantity cant be empty');
                return false;
            }
            return true;
        }

        function updateDepartment(id, name, quantity, status) {
            let hidden = $('#hidden');
            let departmentName = $('#name');
            let departmentQuantity = $('#quantity');
            let departmentStatus = $('#status');
            hidden.val(id);
            departmentName.val(name);
            departmentQuantity.val(quantity);
            departmentName.focus();
            if (status === '1') {
                departmentStatus.attr('checked', true);
            } else {
                departmentStatus.removeAttr('checked');
            }
        }
    </script>
@endsection
