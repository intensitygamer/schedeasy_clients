@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Clients </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('create_client') }}" title="Create a client"> Create a client <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>Client ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>
            <th>CRM URL</th>
            <th>Date Created</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->user_info->first_name }} {{ $client->last_name }} </td>
                <td>{{ isset( $client->user_details->address ) ? $client->user_details->address : '' }}</td>
                <td>{{ $client->user_info->email }}</td>
                <td>{{ $client->user_info->crm_url }}</td>
                <td>{{ date_format($client->created_at, 'jS M Y') }}</td>
                <td> 
                        <form action="{{ route('delete_client',$client->id) }}" method="POST">   
                            <a class="btn btn-info" href="{{ route('clients.show', $client->id) }}">Show</a>    
                            <a class="btn btn-primary"  href="{{ route('edit.client', $client->id) }}">Edit</a>   
                            @csrf
                            @method('DELETE')      
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                 </td>

            </tr>
        @endforeach
    </table>

@endsection
