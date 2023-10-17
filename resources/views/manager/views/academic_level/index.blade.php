@php
    $count = 1;
@endphp
@extends('manager/layout/Layout')
@section('content')
    <div class="container-fluid">
        <h1>Academic level</h1>
        <form action="{{ route('admin-add-academic_level') }}" method="post">
            <input type="hidden" name="formType" value="add">
            @csrf
            <button class="btn btn-primary mb-3" type="submit">
                Add academic level
            </button>
        </form>
        <div class="row">
            <div class="col-lg-12 shadow-lg p-3 mb-5 bg-body rounded">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Degree place</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listAcademicLevel as $academicLevel)
                            <tr>
                                <th scope="row">{{ $count++ }}</th>
                                <td>{{ $academicLevel->name }}</td>
                                <td>
                                    <img src="{{ url($academicLevel->image) }}" alt="image"
                                        style="width: 100px; height: 100px;">
                                </td>
                                <td>{{ $academicLevel->degree_place }}</td>
                                <td>
                                    <span
                                        class="badge badge-{{ $academicLevel->status == 1 ? 'success' : 'danger' }}">{{ $academicLevel->status == 1 ? 'active' : 'hide' }}</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{ route('admin-add-academic_level') }}" method="post">
                                            <input type="hidden" name="formType" value="update">
                                            <input type="hidden" name="id" value="{{ $academicLevel->id }}">
                                            @csrf
                                            <button class="btn btn-warning btn-sm mr-1" type="submit">
                                                <i class="fas fa-edit pr-1"></i>Sửa
                                            </button>
                                        </form>
                                        <form action="{{ route('admin-delete-academic_level', $academicLevel->id) }}"
                                            method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm" type="submit"
                                                onclick=" return confirm('Are you sure???')">
                                                <i class="fas fa-trash pr-1"></i>Xóa
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$listAcademicLevel->links()}}
            </div>
        </div>
    </div>
@endsection
