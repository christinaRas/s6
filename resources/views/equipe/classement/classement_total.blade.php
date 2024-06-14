@extends('equipe.include.elayout')
@section('content')

<br><br><br>
<div class="section-heading text-center mb-40 wow fadeInUp" data-wow-delay="100ms">
    <h2>Classement total</h2>
</div>

<section class="team-section bg-gray padding">
    <div class="container">
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Login</th>
                        <th>Classement</th>
                        <th>Point total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classements as $classement)
                    <tr>
                        <td>{{$classement->login}}</td>
                        <td>{{$classement->classement}}</td>
                        @if ($classement->point < 5)
                            <td><span style="color: red">{{$classement->point}}</span></td>
                        @elseif ($classement->point > 10)
                            <td><span style="color: green">{{$classement->point}}</span></td>
                        @else
                            <td><span style="color: rgb(38, 0, 255)">{{$classement->point}}</span></td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if (Auth::User()->id == collect($winner)->first()->id_equipe)
                <a href="{{ route('pdf') }}">Voir certificat</a>
            @endif
        </div>
    </div>
</section>
@endsection