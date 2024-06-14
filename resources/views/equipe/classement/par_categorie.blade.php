@extends('equipe.include.elayout')
@section('content')

<br><br><br>
<div class="section-heading text-center mb-40 wow fadeInUp" data-wow-delay="100ms">
    <h2>Classement par categorie</h2>
</div>

<section class="team-section bg-gray padding">
    <div class="container">
        <div class="row">
            <form action="{{ route('ClassementCategorie') }}" method="POST">
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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Equipe</th>
                        <th>Classement</th>
                        <th>Point</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classements as $classement)
                        <tr>
                            {{-- <td>{{ $classement->login }}</td>
                            <td>{{ $classement->classement }}</td>
                            @if ($classement->classement == 1)
                            <td><span style="color: rgb(17, 224, 6)">{{$classement->point}}</span></td>
                            @elseif ($classement->classement == 2)
                                <td><span style="color: rgb(21, 0, 255)">{{$classement->point}}</span></td>
                            @else
                                <td><span style="color: rgb(255, 0, 0)">{{$classement->point}}</span></td>
                            @endif --}}
                            
                            <td>{{ $classement->login }}</td>
                            <td>{{ $classement->classement }}</td>
                            <td>{{ $classement->point }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

@endsection