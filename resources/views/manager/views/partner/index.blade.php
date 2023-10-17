@php
    $count = 1;
@endphp
@extends('manager/layout/Layout')
@section('content')
    <div class="container-fluid">
        <h1>Partner</h1>
        <div class="row">
            <div class="col-lg-4">
                <div class="shadow-lg p-3 mb-5 bg-body rounded">
                    <form action="{{route('admin-add-partner')}}" method="post" onsubmit="return validate()">
                        @csrf
                        <input type="hidden" id="hidden" name="id" value="{{$hiddenId}}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Partner name:</label>
                            <input type="text" id="name" name="name" class="form-control"
                                   placeholder="partner name...">
                        </div>
                        <div class="mb-3">
                            <label for="address_partner" class="form-label">Address partner:</label>
                            <input type="text" min="0" id="address_partner" name="address_partner" class="form-control"
                                   placeholder="address partner...">
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
                        <th scope="col">Partner name</th>
                        <th scope="col">Partner address</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($partners as $partner)
                        <tr>
                            <th scope="row">{{$count++}}</th>
                            <td>{{$partner->name}}</td>
                            <td>{{$partner->address_partner}}</td>
                            <td>
                                <span class="badge badge-{{$partner->status==1?'success':'danger'}}">
                                    {{$partner->status==1?'active':'hide'}}</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <div>
                                        <button type="button" class="btn btn-warning btn-sm mr-1"
                                                onclick="updatePartner({{$partner->id}},'{{$partner->name}}'
                                   ,'{{$partner->address_partner}}','{{$partner->status}}')">
                                            <i class="fas fa-edit pr-1"></i>Sửa
                                        </button>
                                    </div>
                                    <form action="{{route('admin-delete-partner', $partner->id)}}"
                                          method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm" type="submit" onclick=" return confirm('Are you sure???')">
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
            let partnerName = $('#name');
            let addressPartner = $('#address_partner');
            if (isInputEmpty(partnerName)) {
                notification('warning', 'Partner name cant be empty');
                return false;
            }
            if (isInputEmpty(partnerName)) {
                notification('warning', 'Partner address cant be empty');
                return false;
            }
            return true;
        }

        function updatePartner(id, name, address_partner, status) {
            let hidden = $('#hidden');
            let partnerName = $('#name');
            let partnerAddress = $('#address_partner');
            let partnerStatus = $('#status');
            hidden.val(id);
            partnerName.val(name);
            partnerAddress.val(address_partner);
            partnerName.focus();
            if (status === '1') {
                partnerStatus.attr('checked', true);
            } else {
                partnerStatus.removeAttr('checked');
            }
        }
    </script>
@endsection
