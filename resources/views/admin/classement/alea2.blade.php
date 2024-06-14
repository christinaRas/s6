@extends('admin.layout.layout')
@section('content')
{{-- <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Classement par étape</h4>
            <div class="table-responsive">
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
    </div>
</div> --}}

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        
        <div class="card-body">
        <br><br><br>
            <h4 class="card-title">Details</h4>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Étape</th>
                            <th>Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                        <tr>
                            <td>{{$data->nom_etape}}</td>
                            <td>{{$data->sum}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection