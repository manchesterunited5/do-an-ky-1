@php
    $count = 1;
@endphp
@extends('manager/layout/Layout')
@section('content')
    <div class="container-fluid">
        <h1>Certificate</h1>
        <div class="row">
            <div class="col-lg-4">
                <div class="shadow-lg p-3 mb-5 bg-body rounded">
                    <form action="{{route('admin-add-certificate')}}" method="post" onsubmit="return validate()">
                        @csrf
                        <input type="hidden" id="hidden" name="id" value="{{$hiddenId}}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Certificate name:</label>
                            <input type="text" id="name" name="name" class="form-control"
                                   placeholder="certificate name...">
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
                        <th scope="col">Certificate name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($certificates as $certificate)
                        <tr>
                            <th scope="row">{{$count++}}</th>
                            <td>{{$certificate->name}}</td>
                            <td>
                                <span class="badge badge-{{$certificate->status==1?'success':'danger'}}">{{$certificate->status==1?'active':'hide'}}</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <div>
                                        <button type="button" class="btn btn-warning btn-sm mr-1"
                                                onclick="updatePosition({{$certificate->id}},'{{$certificate->name}}','{{$certificate->status}}')">
                                            <i class="fas fa-edit pr-1"></i>Sửa
                                        </button>
                                    </div>
                                    <form action="{{route('admin-delete-certificate', $certificate->id)}}" method="post">
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
            let ratingName = $('#name');
            if(isInputEmpty(ratingName)){
                notification('warning','rating cant be empty');
                return false;
            }
            return true;
        }

        function updatePosition(id, name, status) {
            let hidden = $('#hidden');
            let ratingName = $('#name');
            let ratingStatus = $('#status');
            hidden.val(id);
            ratingName.val(name);
            ratingName.focus();
            if (status === '1') {
                ratingStatus.attr('checked',true);
            }else {
                ratingStatus.removeAttr('checked');
            }
        }
    </script>
@endsection
