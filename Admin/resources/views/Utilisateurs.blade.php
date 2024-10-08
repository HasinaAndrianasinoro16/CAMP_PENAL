@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Utilisateurs</h2>
                <a href="{{ route('AddUsers') }}">
                    <button class="au-btn au-btn-icon au-btn--green">
                        <i class="zmdi zmdi-plus"></i>Ajouter Utilisateur
                    </button>
                </a>
            </div>

            <div class="py-3"></div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-title h3">Liste utilisateur</div>
                    <table id="example" class="table table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Imatricule</th>
                            <th>Adresse electronique</th>
                            <th>Position</th>
                            <th>Province</th>
                            <th> -- </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->matricule }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->usertype == 1 ? $user->position .' '. $user->region : $user->position  }}</td>
                                <td>{{ $user->province }}</td>
                                <td>
                                    <a href="{{ route('UpdateUsers', ['id' => $user->id]) }}"><button class="btn btn-warning" ><i class="fas fa-pencil-square-o"></i></button></a>
                                    <a href="{{ route('DeleteUsers',['id' => $user->id]) }}"><button class="btn btn-danger"><i class="fas fa-trash" ></i></button></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script>
        var table = new DataTable('#example', {
            language: {
                url: 'https://api.allorigins.win/raw?url=http://cdn.datatables.net/plug-ins/2.1.4/i18n/fr-FR.json',
            },
        });
    </script>
@endsection
