<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Edit Courrier</title>
</head>
<body>
    @include('components.navbar')
    <div >
        <div class="form-heading">
            <h2>Modifier les données</h2>
        </div>

        <div class="errors">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="error">{{ $error }}</div>
                @endforeach
            @endif
        </div>
        </div>
         <div class="form-container">
        <form action="{{ route('courrier.update', $courrier->id) }}" method="post" enctype="multipart/form-data" class="courrier-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="envoyé" {{ $courrier->type == 'envoyé' ? 'selected' : '' }}>Envoyé</option>
                    <option value="reçu" {{ $courrier->type == 'reçu' ? 'selected' : '' }}>Reçu</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date">Date</label>
                <input type="datetime-local" name="date" id="date" value="{{ old('date', $courrier->date) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="destinataire">Destinataire</label>
                <input type="text" name="destinataire" id="destinataire" value="{{ old('destinataire', $courrier->destinataire) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="expediteur">Expéditeur</label>
                <input type="text" name="expediteur" id="expediteur" value="{{ old('expediteur', $courrier->expediteur) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" value="{{ old('description', $courrier->description) }}" class="form-control">
            </div>

            <div class="form-group">
                <label for="image">Document</label>
                <input type="file" name="image" id="image" accept="image/*,.pdf" class="form-control-file">
                <br>
                @if($courrier->image)
                <label>
                    <input type="checkbox" name="delete_image" value="1"> Supprimer le document existant
                </label>
                @endif
            </div>

            <div class="button-container">
                <input type="submit" value="Valider" class="btn btn-primary">
            
                <a href="{{ route('courrier.index') }}" class="btn btn-secondary">Quitter</a>
        </div>
        </form>

        
    </div>
</div>
</body>
</html>
