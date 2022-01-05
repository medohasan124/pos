@extends('layouts.home')
@section('content')


	   {{$dataTable->table()}}



	   
@push('scripts')
    {{$dataTable->scripts()}}
@endpush
@endsection




