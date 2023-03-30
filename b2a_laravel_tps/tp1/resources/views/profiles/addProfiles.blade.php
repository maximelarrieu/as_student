@extends('profiles/layout');

@section('title')
    Bonsoir Administrateur - Ajouter un nouvel administrateur
@endsection

@section('content')
    <nav>
        <ul>
            <li style="margin-left: -40px; list-style-type: none;"><a href="{{ route('list') }}"><button type="submit" class="btn btn-secondary"><i class="fa fa-home" style="padding-right: 10px"></i>Liste des administrateurs</button></a></li>
        </uL>
    </nav>
    <form method="post" action="{{ route('valid') }}">
        <div class="form-group">
            <label for="last_name">Nom</label>
            <input type="text" name="last_name" id="last_name" placeholder="Definissez un nom" class="form-control">
        </div>
        <div class="form-group">
            <label for="last_name">Prenom</label>
            <input type="text" name="first_name" id="first_name" placeholder="Definissez un prénom" class="form-control">
        </div>
        <div class="form-group">
            <label for="last_name">Date de naissance</label>
            <input type="date" name="age" id="age" placeholder="Definissez une date de naissance" class="form-control">
        </div>
        <div class="form-group">
            <label for="last_name">Numéro de téléphone</label>
            <input type="text" name="phone_number" id="phone_number" placeholder="Definissez un numéro" class="form-control">
        </div>
        <div class="form-group">
            <label for="last_name">Adresse</label>
            <input type="text" name="address" id="address" placeholder="Definissez une adresse" class="form-control">
        </div>
        @csrf
        <div class="form-group">
            <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle" style="padding-right: 10px"></i>Ajouter un administrateur</button>
        </div>
    </form>
@endsection
