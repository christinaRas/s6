@extends('admin.layout.layout')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Liste des etapes</h4>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Rang</th>
                <th>Nom</th>
                <th>Longeur</th>
                <th>Nombre coureur</th>
                <th>Affectation</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($etapes as $etape)
              <tr>
                <td>{{$etape ->rang}}</td>
                <td>{{$etape ->nom_etape}}</td>
                <td>{{$etape ->km}} km</td>
                <td>{{$etape ->nb_coureur}}</td>
                <td><a href="{{ route('etapeAdmin', $etape ->id) }}">Affecter temps</a></td>
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