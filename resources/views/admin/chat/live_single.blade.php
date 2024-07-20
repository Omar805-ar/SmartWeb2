@extends('layouts.admin')
@section('content')

    @livewire('chatmessages' ,  ['id'=> $id])

@endsection
