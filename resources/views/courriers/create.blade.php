<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Nouveau courrier</title>
</head>
<body >
    @include('components.navbar')
    <div class="errors">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="error">{{ $error }}</div>
            @endforeach
        @endif
    </div>
    </div>
    <div class="form-container">

    <form action="{{ route('courrier.store') }}" method="post" enctype="multipart/form-data" class="courrier-form">
        @csrf
        @method('post')
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" id="type" class="form-control">
                <option value="envoyé">Envoyé</option>
                <option value="reçu">Reçu</option>
            </select>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="datetime-local" name="date" id="date" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="destinataire">Destinataire</label>
            <input type="text" name="destinataire" id="destinataire" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="expediteur">Expéditeur</label>
            <input type="text" name="expediteur" id="expediteur" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="image">Document</label>
            <input type="file" name="image" id="image" accept="image/*,.pdf" class="form-control-file"/>
        </div>
        <div class="form-group button-container">
            <input type="submit" value="Ajouter un nouveau courrier" class="btn btn-primary"/>
            <a href="{{ route('courrier.index') }}" class="btn btn-secondary">Quitter</a>
        </div>
      
    </form>
</div>
 
</body>
</html>