@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Tüm Yazılar')
@section('content')
<div class="row g-2 align-items-center">
    <div class="col">
      <h2 class="page-title">
        Tüm Yazılar
      </h2>
    </div>
  </div>

  @livewire('all-posts')
@endsection
