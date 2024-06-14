@extends('equipe.include.elayout')
@section('content')

<br><br><br>
<div class="section-heading text-center mb-40 wow fadeInUp" data-wow-delay="100ms">
    <h2>Equipe {{ Auth::user()->login}}</h2>
</div>

{{-- <section class="team-section bg-gray padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            @foreach ($etapes as $etape)
            <div class="col-lg-3 col-sm-6 padding-15">
              <div class="service-item box-shadow">
                <h3>{{ $etape->rang }} - {{ $etape->nom_etape }}</h3>
                <p>Longueur: {{ $etape->km }} km </p>
                <p>Nombre de coureur: {{ $etape->nb_coureur }} </p>
                <a href="{{ route('etape', $etape->id ) }}" class="read-more">Attribuer</a>
              </div>
            </div>
            @endforeach
          </div>
        </div>
    </div>
</section> --}}

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

<section class="team-section bg-gray padding">
  <div class="container">
    @foreach ($etapes as $etape)
      <div class="row">
        <p><span style="color: orange">{{ $etape->nom_etape }} ({{ $etape->km }} km) - {{ $etape->nb_coureur }} coureur</span></p>
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>Nom coureur</th>
                      <th>Chrono</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($runner_chronos->where('id_etape', $etape->id) as $chrono)
                      <tr>
                          <td>{{ $chrono->nom_runner }}</td>
                          <td>{{ $chrono->duree}}</td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
          <form action="{{ route('etape', $etape->id) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-secondary"> Ajouter coureur</button>
          </form>
        <br><br><br><br><br>
      </div>
    @endforeach
  </div>
</section>


@endsection