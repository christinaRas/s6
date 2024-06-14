@extends('admin.layout.layout')
@section('content')

@if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif

  @if(session()->has('error'))
  <div class="alert alert-danger">
      <ul>
          <li>{{session('error')}}</li>
      </ul>
  </div>
  @endif
  
<div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Import point</h4>
          <form action="{{ route('importPointPost') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Points</label>
                <input type="file" class="file-upload-default" name="csv_file_point">
                <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload ">
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                </span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-light">Cancel</button>
        </form>
        </div>
      </div>
    </div>
</div>
@endsection