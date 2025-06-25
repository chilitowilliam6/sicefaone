@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <h1>Edit Response for {{ ucfirst($eventType) }} #{{ $event->id }}</h1>

    <form action="{{ route('sstsena.event_responses.update', [$eventType, $event->id, $response->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="response" class="form-label">Response</label>
            <textarea class="form-control @error('response') is-invalid @enderror" id="response" name="response" rows="5">{{ old('response', $response->response) }}</textarea>
            @error('response')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('sstsena.event_responses.index', [$eventType, $event->id]) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection