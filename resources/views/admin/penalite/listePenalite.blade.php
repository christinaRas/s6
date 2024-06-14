@extends('admin.layout.layout')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Penalite</h4>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Etape</th>
                <th>Equipe</th>
                <th>Penalite</th>
                <th>Supprimer</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($penalites as $penalite)
              <tr>
                <td>{{$penalite ->nom_etape}}</td>
                <td>{{$penalite ->equipe}}</td>
                <td>{{$penalite ->penalite}} </td>
                <td>
                    <form action="{{ route('delete.penalite', $penalite ->id_penalite) }}" method="post" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <br><br>
          <a href="{{ route('ajoutPenalite')}}" class="btn btn-primary mr-2">Ajouter penalite</a>
        </div>
      </div>
    </div>
  </div>
@endsection
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const forms = document.querySelectorAll('.delete-form');
  
      forms.forEach(form => {
          form.addEventListener('submit', function (event) {
              event.preventDefault(); // Empêche la soumission par défaut
  
              const confirmed = confirm('Êtes-vous sûr de vouloir supprimer cette pénalité ?');
  
              if (confirmed) {
                  form.submit(); // Soumet le formulaire si l'utilisateur confirme
              }
          });
      });
  });
  </script>
{{-- onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette pénalité ?'); --}}