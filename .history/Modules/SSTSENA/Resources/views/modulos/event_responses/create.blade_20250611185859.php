@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <h1>Responses for {{ ucfirst($eventType) }} #{{ $event->id }}</h1>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('sstsena.event_responses.create', [$eventType, $event->id]) }}" class="btn btn-primary mb-3">Add Response</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Response</th>
                <th>Created By</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($responses as $response)
                <tr>
                    <td>{{ $response->id }}</td>
                    <td>{{ $response->response }}</td>
                    <td>{{ $response->createdBy->name ?? 'Unknown' }}</td>
                    <td>{{ $response->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>
                        <a href="{{ route('sstsena.event_responses.edit', [$eventType, $event->id, $response->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('sstsena.event_responses.destroy', [$eventType, $event->id, $response->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No responses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection