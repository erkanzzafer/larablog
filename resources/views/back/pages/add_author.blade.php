@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Add Author')
@section('content')
@livewire('add-author')
@endsection
