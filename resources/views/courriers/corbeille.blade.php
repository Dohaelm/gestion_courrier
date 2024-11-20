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
        <form action="{{ route('courrier.corbeille') }}" method="GET" class="search-form">
            <input type="text" name="search" class="search-input" placeholder="Filtrer par expediteur, destinataire, type, date ou motif de suppression">
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
                        <th>Motif de suppression</th>
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
                        <td>
                            {{$courrier->motif_de_suppression}}
                      
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
