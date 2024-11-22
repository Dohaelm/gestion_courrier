<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Courrier</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>


<body>
    @include('components.navbar')
    <div class="container">
        <form action="{{ route('courrier.index') }}" method="GET" class="search-form">
            <input type="text" name="search" class="search-input" value="{{ $searchTerm ?? '' }}" placeholder="Filtrer par expediteur, destinataire, type ou date">
            <button type="submit" class="search-button">Rechercher</button>
        </form>

        <div class="message">
            @if(session()->has('success'))
            <div class="alert-success">
                {{session('success')}}
            </div>
            @endif
        </div>
        
        <div class="table-container">
            @if ($courriers->total() > 0)
            <table class="courrier-table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Destinataire</th>
                        <th>Expéditeur</th>
                        <th>Description</th>
                        <th>Document</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courriers as $courrier)
                    <tr>
                        <td>{{$courrier->type}}</td>
                        <td>{{ $courrier->date->format('Y-m-d H:i:s') }}</td>
                        <td>{{$courrier->destinataire}}</td>
                        <td>{{$courrier->expediteur}}</td>
                        <td>{{$courrier->description}}</td>
                        <td>
                            @if ($courrier->image)
                            <a href="{{ asset('storage/' . $courrier->image) }}" target="_blank" class="view-image-link">Ouvrir le document</a>
                            @else
                                Aucun document
                            @endif
                        </td>
                        <td class="action-column">
                            <a href="{{route('courrier.edit',['courrier'=>$courrier])}}" class="edit-icon"><i class="fas fa-edit"></i></a>
                           
                            <div class="delete-icon" data-toggle="modal" data-target="#deleteModal" data-id="{{ $courrier->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </div>
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Saisir le motif de suppression</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="deleteForm" method="POST" action="{{ route('courrier.destroy', $courrier->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="courrier_id" id="courrier_id">
                                                <div class="form-group">
                                                   
                                                    <input type="text" class="form-control" id="motif_de_suppression" name="motif_de_suppression" required>
                                                </div>
                                                <div class="delete-button">
                                                <button type="submit"class="delete-icon" >Supprimer <i class="fas fa-trash-alt"></i> </button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <script>
                            $('#deleteModal').on('show.bs.modal', function (event) {
                                var button = $(event.relatedTarget); // Button that triggered the modal
                                var id = button.data('id'); // Extract info from data-* attributes
                                var modal = $(this);
                                modal.find('.modal-body #courrier_id').val(id);
                                modal.find('#deleteForm').attr('action', '/courrier/' + id);
                            });
                        </script>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $courriers->links() }}
            </div>
            @else
            <p class="no-results">Aucun résultat.</p>
            @endif
        </div>
      
    </div>
</body>
</html>
