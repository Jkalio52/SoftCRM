@extends('layouts.base')

@section('caption', 'Informacje o kliencie')

@section('title', 'Informacje o kliencie')

@section('lyric', 'Informacje o kliencie')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-6">
            <!-- will be used to show any messages -->
            @if(session()->has('message_success'))
                <div class="alert alert-success">
                    <strong>Bardzo dobrze!</strong> {{ session()->get('message_success') }}
                </div>
            @elseif(session()->has('message_danger'))
                <div class="alert alert-danger">
                    <strong>Uwaga!</strong> {{ session()->get('message_danger') }}
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    Więcej informacji na temat {{ $clients->name }}
                </div>

                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" data-toggle="tab">Podstawowe informacje</a>
                        </li>
                        <li class=""><a href="#profile" data-toggle="tab">Przypisane firmy <span
                                        class="badge badge-warning">{{ count($clients->companies) }}</span></a>
                        </li>
                        <li class=""><a href="#messages" data-toggle="tab">Przypisani pracownicy <span
                                        class="badge badge-warning">0</span></a>
                        </li>
                        <div class="text-right">
                            {{ Form::open(array('url' => 'client/' . $clients->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Usuń', array('class' => 'btn btn-small btn-danger')) }}
                            {{ Form::close() }}
                            @if($clients->is_active == TRUE)
                                <a class="btn btn-small btn-warning"
                                   href="{{ URL::to('client/disable/' . $clients->id) }}">Deaktywuj</a>
                            @else
                                <a class="btn btn-small btn-warning"
                                   href="{{ URL::to('client/enable/' . $clients->id) }}">Aktywuj</a>
                            @endif
                        </div>

                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="home">
                            <h4></h4>

                            <table class="table table-striped table-bordered">
                                <tbody class="text-right">
                                <tr>
                                    <th>Imie i nazwisko</th>
                                    <td>{{ $clients->full_name }}</td>
                                </tr>
                                <tr>
                                    <th>Telefon</th>
                                    <td>{{ $clients->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Adres email</th>
                                    <td>{{ $clients->email }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $clients->is_active ? 'Yes' : 'No' }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="profile">
                            <h4>Lista firm</h4>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Nazwa</th>
                                    <th>Numer telefonu</th>
                                    <th>NIP</th>
                                    <th>Akcja</th>
                                </tr>
                                </thead>
                                    @foreach($companies as $companies_relation)
                                    <tbody>
                                    <tr class="odd gradeX">
                                        <td>{{ $companies_relation->name }}</td>
                                        <td>{{ $companies_relation->phone }}</td>
                                        <td>{{ $companies_relation->tax_number }}</td>
                                        <td>
                                            {{ Form::open(array('url' => 'companies/' . $companies_relation->id, 'class' => 'pull-right')) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {{ Form::submit('Usuń', array('class' => 'btn btn-danger btn-sm')) }}
                                            {{ Form::close() }}
                                        </td>
                                    @endforeach
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="messages">
                            <h4>Messages Tab</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                mollit anim id est laborum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection