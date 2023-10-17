@php
    $count = 1;
@endphp
@extends('manager/layout/Layout')
@section('content')
    <div class="container-fluid">
        <h1>Contract Type</h1>
        <div class="row">
            <div class="col-lg-4">
                <div class="shadow-lg p-3 mb-5 bg-body rounded">
                    <form action="{{route('admin-add-contract_type')}}" method="post" onsubmit="return validate()">
                        @csrf
                        <input type="hidden" id="hidden" name="id" value="{{$hiddenId}}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Contract type name:</label>
                            <input type="text" id="name" name="name" class="form-control"
                                   placeholder="Contract type name...">
                        </div>
                        <div class="mb-3">
                            <label for="numberOfYearContract" class="form-label">Number of year contract:</label>
                            <input type="number" min="0" id="numberOfYearContract" name="number_of_year_contract" class="form-control"
                                   placeholder="Number of year contract...">
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
                        <th scope="col">Contract type name</th>
                        <th scope="col">Number of year contract</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contractTypes as $contractType)
                        <tr>
                            <th scope="row">{{$count++}}</th>
                            <td>{{$contractType->name}}</td>
                            <td>{{$contractType->number_of_year_contract}}</td>
                            <td>
                                <span class="badge badge-{{$contractType->status==1?'success':'danger'}}">
                                    {{$contractType->status==1?'active':'hide'}}</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <div>
                                        <button type="button" class="btn btn-warning btn-sm mr-1"
                                                onclick="updateContractType({{$contractType->id}},'{{$contractType->name}}'
                                   ,{{$contractType->number_of_year_contract}},'{{$contractType->status}}')">
                                            <i class="fas fa-edit pr-1"></i>Sửa
                                        </button>
                                    </div>
                                    <form action="{{route('admin-delete-contract_type', $contractType->id)}}"
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
            let contractTypeName = $('#name');
            let numberOfYearContract = $('#numberOfYearContract');
            if (isInputEmpty(contractTypeName)) {
                notification('warning', 'Contract type name cant be empty');
                return false;
            }
            if (isInputEmpty(numberOfYearContract)) {
                notification('warning', 'Number of year contract cant be empty');
                return false;
            }
            return true;
        }

        function updateContractType(id, name, quantity, status) {
            let hidden = $('#hidden');
            let contractTypeName = $('#name');
            let numberOfYearContract = $('#numberOfYearContract');
            let contractTypeStatus = $('#status');
            hidden.val(id);
            contractTypeName.val(name);
            numberOfYearContract.val(quantity);
            contractTypeName.focus();
            if (status === '1') {
                contractTypeStatus.attr('checked', true);
            } else {
                contractTypeStatus.removeAttr('checked');
            }
        }
    </script>
@endsection
