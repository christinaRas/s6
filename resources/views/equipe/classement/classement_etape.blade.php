@extends('equipe.include.elayout')
@section('content')

<br><br><br>
<div class="section-heading text-center mb-40 wow fadeInUp" data-wow-delay="100ms">
    <h2>Classement par etape</h2>
</div>

{{-- <section class="team-section bg-gray padding">
    <div class="container">
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Étape</th>
                        <th>Login</th>
                        <th>Durée</th>
                        <th>Classement</th>
                        <th>Point</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classements as $classement)
                    <tr>
                        <td>{{$classement->nom_etape}}</td>
                        <td>{{$classement->login}}</td>
                        <td>{{$classement->duree}}</td>
                        <td>{{$classement->classement}}</td>
                        <td>{{$classement->point}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> --}}


<section class="team-section bg-gray padding">
    <div class="container">
        <div class="row">
            <form action="{{ route('equipeClassementEtape') }}" method="POST">
                @csrf
                <select name="etape">
                    <option value="">Toutes les étapes</option>
                    @foreach ($etapes as $etape)
                        <option value="{{ $etape->id }}" {{ $selectedEtapeId == $etape->id ? 'selected' : '' }}>
                            {{ $etape->nom_etape }}
                        </option>
                    @endforeach
                </select>
                <button type="submit">Valider</button>
            </form>
            <br><br><br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Étape</th>
                        <th>Equipe</th>
                        <th>Coureur</th>
                        <th>Durée</th>
                        <th>Classement</th>
                        <th>Point</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classements as $classement)
                    <tr>
                        <td>{{$classement->nom_etape}}</td>
                        <td>{{$classement->login}}</td>
                        <td>{{$classement->nom_runner}}</td>
                        <td>{{$classement->duree}}</td>
                        <td>{{$classement->classement}}</td>
                        <td>{{$classement->point}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection