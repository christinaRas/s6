@extends('admin.layout.layout')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Resultat par coureur</h4>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Coureur</th>
                <th>Genre</th>
                <th>Chrono</th>
                <th>Penalite</th>
                <th>Temps final</th>
                <th>Classement</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($resultats as $resultat)
              <tr>
                <td>{{$resultat ->nom_runner}}</td>
                <td>{{$resultat ->genre}}</td>
                <td>{{$resultat ->duree}} </td>
                <td>{{$resultat ->penalite}}</td>
                <td>{{$resultat ->temps_final}}</td>
                <td>{{$resultat ->classement}}</td>
            </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection