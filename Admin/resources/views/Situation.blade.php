@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Materiel</h2>
            </div>
            <div class="py-3"></div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Formulaire d'ajout de Materiel</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success2'))
                        <div class="alert alert-success w-6">
                            {{ session('success2') }}
                        </div>
                    @endif
                    <form action="{{ route('AjoutSituation') }}" method="post">
                        @csrf
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="col-8">
                                    <label for="Nom" class="form-control-label">Situation juridique</label>
                                    <textarea class="form-control" name="situation" id="nom" rows="3" ></textarea>
                                </div>
                            </div>
                            <div class="py-2"></div>
                            <div class="form-group">
                                <div class="col-11">
                                    <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-check"></i> Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
