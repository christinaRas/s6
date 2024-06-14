@extends('admin.layout.layout')
@section('content')

<div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"></h4>
          <form class="forms-sample" action="{{ route('course') }}" method="post">
            @csrf
            @foreach ($courses as $course)
            <input type="hidden" name="id_assignement[]" value="{{ $course->id_assignement }}">
                <p style="color: rgb(255, 136, 0)">Equipe:{{ $course->id_equipe }}</p>
                <div class="form-group">
                    <label for="heure"><span style="color: rgb(132, 0, 255)">{{ $course->dossard }}</span> - {{ $course->nom_runner }}  </label>    
                    <input type="text" class="form-control" placeholder="depart (dd/mm/yyyy hh:mm:ss)" name="depart[]">
                    <input type="text" class="form-control" placeholder="arrivée (dd/mm/yyyy hh:mm:ss) " name="arrive[]">
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-light">Cancel</button>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection