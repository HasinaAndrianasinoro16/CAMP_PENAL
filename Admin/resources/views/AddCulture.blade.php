@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Camp pénal</h2>
            </div>
            <div class="py-3"></div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Ajouter une culture au camp</div>
                    <div class="py-3"></div>
                    <p>ce camp est composé de terre <code class="" >{{ $sol->sol }}</code>
                        ma suggestion pour ce type de terre sont les cultures suivantes :
                        @foreach( $sugs as $sug )
                            <code>{{ $sug->culture }}</code>,
                        @endforeach
                        car cette terre est plus favorable pour ces cultures.
                    </p>
                    <div class="py-3"></div>
                    <form action="{{ route('Ajout-culture') }}" method="post">
                        @csrf
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="culture" class="form-control-label">Culture</label>
                                    <input type="hidden" name="camp" value="{{ request()->segment(2) }}">
                                    <select id="culture" class="form-control" name="culture" >
                                        @foreach($cultures as $culture )
                                            <option value="{{ $culture->id }}" > {{ $culture->nom }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="py-2"></div>
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="superficie" class="form-control-label">supperficie (en hectare)</label>
                                    <input type="text" class="form-control" id="superficie" name="superficie">
                                </div>
                            </div>
                            <div class="py-2"></div>
                            <div class="form-group">
                                <div class="col-9">
                                    <button type="submit" class="btn btn-success w-25 btn-lg"><i class="fas fa-check"></i> Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="py-2"></div>

                    <table class="table table-hover">
                        <thead>
                        <th>Culture</th>
                        <th>Superficie</th>
                        <th> -- </th>
                        </thead>
                        <tbody>
                        @foreach($campcultures as $campculture)
                            <tr>
                                <td>{{ $campculture->culture }}</td>
                                <td>{{ $campculture->superficie }} ha</td>
                                <td>
                                    <a href=""><button class="btn btn-danger"><i class="fas fa-trash"></i> </button> </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
