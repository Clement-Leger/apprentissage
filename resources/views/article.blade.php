@extends('template.templateNumero')
 
@section('titre')
    Les articles
@endsection
 
@section('contenu')
    <p>C'est l'article n° {{ $numero }}</p>
@endsection