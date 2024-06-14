@extends('equipe.include.elayout')
@section('content')

<br><br>
<section class="blog-section padding">
    <div class="container">
        <div class="blog-wrap row">
            <div class="col-lg-8 sm-padding">
                <form action="{{route('attribution')}}" method="post">
                    @csrf
                    <input type="hidden" name="id_etape" value="{{ $etape->id }}">
                    <div class="row">
                            <div class="col-sm-6 padding-15">
                                <div class="blog-item box-shadow">
                                    <div class="blog-content">
                                        <p>
                                            @foreach ($runners as $runner)
                                            <p>
                                                <input type="checkbox" name="id_runner" id="" value="{{ $runner->id }}"> {{$runner->nom_runner }}
                                            </p>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <p><button type="submit" class="btn btn-secondary">Valider</button></p>
                </form>
            </div>
            <div class="col-lg-4 padding-15">
                <div class="sidebar-wrap">
                    <div class="widget-content">
                        <h4>Assigner les coureur</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection