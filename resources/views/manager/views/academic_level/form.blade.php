<form action="{{route('admin-add-academic_level')}}" method="post" enctype="multipart/form-data" >
    @csrf
    <input type="text" name="xxx" id="xxx">
    <button class="btn btn-danger btn-sm" type="submit">
        <i class="fas fa-trash"></i>
    </button>
</form>
