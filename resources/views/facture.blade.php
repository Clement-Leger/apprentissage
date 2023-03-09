@extends('template.templateNumero')
 
@section('titre')
    Les factures
@endsection
 
@section('contenu')
    <p>C'est la facture n° {{ $numero }}</p>
@endsection