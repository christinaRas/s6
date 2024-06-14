@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
                <form action="{{ route('adminClassementCategorie') }}" method="POST">
                    @csrf
                    <select name="id_categorie">
                        <option value="">Toutes categories</option>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ $selectedCategorieId == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->nom_categorie }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit">Valider</button>
                </form>
                <br><br><br>
              <h4 class="card-title">Classement par categorie</h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                        <th>Equipe</th>
                        <th>Classement</th>
                        <th>Point total</th>
                    </tr>
                  </thead>
                  <tbody>
                        @foreach ($classements as $index => $classement)
                        <tr>
                            @if ($index > 0 && $classement->classement == $classements[$index - 1]->classement)
                            <td><a href="{{ route('alea', $classement->id_equipe) }}"><span style="color: red">{{ $classement->login }}</span></a></td>
                                <td><span style="color: red">{{ $classement->classement }}</span></td>
                                <td><span style="color: red">{{ $classement->point }}</span></td>
                            @elseif ($index < count($classements) - 1 && $classement->classement == $classements[$index + 1]->classement)
                            <td><a href="{{ route('alea', $classement->id_equipe) }}"><span style="color: red">{{ $classement->login }}</span></a></td>
                                <td><span style="color: red">{{ $classement->classement }}</span></td>
                                <td><span style="color: red">{{ $classement->point }}</span></td>
                            @else
                                <td><a href="{{ route('alea', $classement->id_equipe) }}">{{ $classement->login }}</a></td>
                                <td>{{ $classement->classement }}</td>
                                <td>{{ $classement->point }}</td>
                            @endif
                        </tr>
                        @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

            <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Diagramme</h4>
                        <canvas id="pieChart" style="width: 100%; height: 350px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Récupérer les données PHP en JSON
        const classements = @json($classements);

        // Extraire les logins et les points
        const labels = classements.map(item => item.login);
        const data = classements.map(item => item.point);

        // Configuration du pie chart
        const ctx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Points',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' points';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection