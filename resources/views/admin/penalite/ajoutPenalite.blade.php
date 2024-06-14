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
          <h4 class="card-title">Entrer place</h4>
          <form class="forms-sample" action="{{ route('traitementPenalite') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="etape">etape</label>
                  <select class="form-control" name="id_etape">
                    @foreach ($etapes as $etape)
                    <option value="{{ $etape->id }}">{{ $etape->nom_etape }}</option>
                    @endforeach
                  </select>
            </div>

            <div class="form-group">
                <label for="equipe">equipe</label>
                  <select class="form-control"name="id_equipe">
                    @foreach ($equipes as $equipe)
                    <option value="{{ $equipe->id }}">{{ $equipe->login }}</option>
                    @endforeach
                  </select>
            </div>

            <div class="form-group">
                <label for="exampleInputName1">Penalite</label>
                <input type="text" class="form-control" id="exampleInputName1" placeholder="penalite (hh:mm:ss)" name="penalite">
            </div>

            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <button type="reset" class="btn btn-light">Cancel</button>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection