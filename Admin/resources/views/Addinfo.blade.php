@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Camp penal</h2>
            </div>
            <div class="py-3"></div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h3">Ajouter les infos supplementaire sur le camp</div>
                    <form action="{{ route('FormAddUsers') }}" method="post">
                        @csrf
                        <div class="card-body card-block">
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="camp" class="form-control-label">Camp</label>
                                    <input type="text" id="camp" name="camp" value="{{ request()->segment(2) }}" disabled class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="matricule" class="form-control-label">Distance DRAP </label>
                                    <textarea name="distance"id="distance" class="form-control" rows="2" ></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="litige" class="form-control-label">Litige(ha)</label>
                                    <input type="text" id="litige" name="litige" placeholder="" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="ncultivable" class="form-control-label">Surface cultivable (ha)</label>
                                    <input type="text" id="ncultivable" name="cultivable" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="ncultivable" class="form-control-label">Surface non cultivable (ha)</label>
                                    <input type="text" id="ncultivable" name="ncultivable" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-9">
                                    <label for="region" class="form-control-label">Localites</label>
                                    <select id="region" name="region" class="form-control">
                                        @foreach( $regions as $region )
                                            <option value="{{ $region->id }}">{{ $region->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-9">
                                    <label for="situation" class="form-control-label">Situation juridique</label>
                                    <select id="situation" name="situation" class="form-control">
                                        <option value="1">D.R.A.P</option>
                                        <option value="2">Agent du Ministere</option>
                                    </select>
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

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#region, #situation').select2({
                placeholder: "Sélectionnez une option",
                allowClear: true
            });
        });
    </script>
@endsection
