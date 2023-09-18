@extends('layouts.app')
@section('header')
<style>
    span {
        font-size:1.2rem;
    }
</style>
@endsection
@section('content')
    
    <div class="container-fluid">
        <div class="row d-flex justify-content-between">
            <div class="col-md-10">
                <h1>{{ $data['type'] }}: {{ $data['customerName'] }}</h1>
            </div>
            <div class="col-md-2">
                <h3>@if($data['status'] == 1) <div class="bg-success p-1 rounded text-center">Registered</div>
                    @else <div class="bg-warning p-1 rounded text-center">Unregistered</div>@endif</h3>
            </div>
        </div>
        <div class="bg-white rounded-pill shadow-lg p-3 ">
            <div class="row">
                <div class="col-md-12 text-dark">
                    <table>
                        @php
                            $fullName = $data['customerName'];
                            $wordCount = str_word_count($fullName);
                            $lastSpaceIndex = strrpos($fullName, ' ');

                            $name = substr($fullName, 0, $lastSpaceIndex);
                            $surname = substr($fullName, $lastSpaceIndex + 1);
                        @endphp
                        <tr>
                            <td><span class="text-primary">Name:</span></td>
                            <td><span>{{ $name }}</span></td>
                        </tr>
                        <tr>
                            <td><span class="text-primary">Surname:</span></td>
                            <td><span>{{ $surname }}</span></td>
                        </tr>

                        <tr>
                            <td><span class="text-primary">Mail:</span></td>
                            <td><span>{{ $data['mail'] }}</span></td>
                        </tr>

                        <tr>
                            <td><span class="text-primary">Telefon:</span></td>
                            <td><span>{{ $data['phone'] }}</span></td>
                        </tr>

                        <tr>
                            <td><span class="text-primary">Von Strasse:</span></td>
                            <td><span>{{ $data['vonStreet'] }}</span></td>
                        </tr>
                        <tr>
                            <td><span class="text-primary">Von Plz:</span></td>
                            <td><span>{{ $data['vonPlz'] }}</span></td>
                        </tr>
                    </table>
                    
                    
                    <div class="form-group row mt-3">
                        <div class="col-md-12 ml-md-auto btn-list">
                            @if($data['status'] == 0)
                            <a class="btn btn-primary btn-rounded" href="{{ route('customer.createForm', ['id' => $data['id']]) }}">Kundendaten übernehmen</a>
                            @endif
                            
                            @if($data['status'] == 1)
                            <a class="btn btn-primary btn-rounded" href="{{ route('customer.detail', ['id' => $data['customerId']]) }}">Kunden</a>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection