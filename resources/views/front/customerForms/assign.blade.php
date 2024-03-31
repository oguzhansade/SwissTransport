@extends('layouts.app')
@section('header')
<style>
    .bg-white span {
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
                <div class="col-md-6 text-dark">
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

                        <tr>
                            <td><span class="text-primary">Nach Strasse:</span></td>
                            <td><span>{{ $data['nachStreet'] }}</span></td>
                        </tr>

                        <tr>
                            <td><span class="text-primary">Nach PLZ:</span></td>
                            <td><span>{{ $data['nachPlz'] }}</span></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <form action="{{ route('customerForms.assignCustomer',['id' => $data['id']]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-4">
                            <label for="customer">Kundenliste</label>
                            <select id="customer" name="customer" class="m-b-10 form-control quittungId" data-placeholder="Kunde auswählen" data-toggle="select2" required>
                                <option class="form-control" value="">Kunde auswählen</option>
                                @foreach ($customers as $k => $v)
                                    <option class="form-control"  value="{{ $v['id'] }}" @if($data['customerId'] == $v['id']) selected @endif>{{ $v['name'] }} {{ $v['surname'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-actions mt-3">
                            <div class="form-group row">
                                <div class="col-md-12 ml-md-auto btn-list">
                                    <button class="btn btn-primary btn-rounded" type="submit"> @if($data['customerId']) Reassign @else Assign @endif</button>

                                    @if($data['customerId']) <br><a class="btn btn-warning btn-rounded" href="{{ route('customerForms.unAssignCustomer', ['id' => $data['id']]) }}">Unassign Customer</a> @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
