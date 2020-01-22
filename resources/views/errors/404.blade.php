@extends('layouts.app')

@push('body')
  <h2>{{ $exception->getMessage() }}</h2>
@endpush