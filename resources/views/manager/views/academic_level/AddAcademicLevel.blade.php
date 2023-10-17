@php
    $count = 1;
@endphp
@extends('manager/layout/Layout')
@section('content')
    <div class="container-fluid">
        <h1>{{$hiddenId==-1?"Add ":"Update "}} academic level</h1>
        <div class="shadow-lg p-3 mb-5 bg-body rounded">
            <form action="{{route('admin-update-academic_level', $academicLevel->id)}}" method="post" enctype="multipart/form-data" onsubmit="return validate()">
                <div class="row">
                    <div class="col-lg-4">
                        @csrf
                        <input type="hidden" id="hidden" name="id" value="{{$hiddenId}}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Academic level name:</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{$academicLevel->name}}"
                                   placeholder="Academic level name...">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Image:</label>
                            <input type="file" id="image" name="image" class="form-control" onchange="previewImage(this)" >
                        </div>
                        <div class="mb-3">
                            <label for="degreePlace" class="form-label">Degree place:</label>
                            <input type="text" id="degreePlace" name="degree_place" class="form-control" value="{{$academicLevel->degree_place}}"
                                   placeholder="Degree place name...">
                        </div>
                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" {{$academicLevel->status==0?'':'checked'}} name="status" class="custom-control-input form-control-lg"
                                   id="status">
                            <label class="custom-control-label" for="status">Status</label>
                        </div>

                    </div>
                    <div class="col-lg-3">
                        <img style="height: 100%; width: 100%; border: 1px solid black;" src="{{asset($academicLevel->image)}}"
                             alt="image of academic level" id="imagePreview">
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="specialize" class="form-label">Specialize:</label>
                                <select class="form-control" id="specialize" name="specialized">
                                    <option value="IT" {{$academicLevel->specialized=="IT"?'selected':''}}>IT</option>
                                    <option value="Marketing" {{$academicLevel->specialized=="Marketing"?'selected':''}}>Marketing</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="diplomaType" class="form-label">Diploma type:</label>
                                <select class="form-control" id="diplomaType" name="diploma_type">
                                    <option value="University" {{$academicLevel->diploma_type=="IT"?'selected':''}}>University</option>
                                    <option value="Collage" {{$academicLevel->diploma_type=="Collage"?'selected':''}}>Collage</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{$hiddenId==-1?"Submit ":"Update "}}</button>
            </form>
        </div>
    </div>
    <script>
        function validate() {
            let name = $('#name');
            let degreePlace = $('#degreePlace');
            let specialize = $('#specialize');
            let diplomaType = $('#diplomaType');
            let image = $('#imagePreview');
            console.log(name);
            if(isInputEmpty(name)){
                notification('warning','Academic level name cant be empty');
                return false;
            }
            if(isInputEmpty(degreePlace)){
                notification('warning','Degree place cant be empty');
                return false;
            }
            if(image.attr('src')===''){
                notification('warning','Image cant be empty');
                image.focus();
                return false;
            }
            if(isInputEmpty(specialize)){
                notification('warning','Specialize cant be empty');
                return false;
            }
            if(isInputEmpty(diplomaType)){
                notification('warning','Diploma type cant be empty');
                return false;
            }
            return true;
        }
    </script>
@endsection
