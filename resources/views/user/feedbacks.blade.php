@extends('layouts.user')

@section('content')

<div class="max-w-lg mx-auto bg-white p-6 shadow rounded">
    <h2 class="text-xl font-bold mb-4">Give Feedback</h2>

    <form method="POST"action="/feedback/{{ $complaint->id }}">
        @csrf

        <label class="block mb-2">Rating:</label>
        <select name="rating" class="w-full border p-2 mb-4">
            <option value="1">1 ⭐</option>
            <option value="2">2 ⭐⭐</option>
            <option value="3">3 ⭐⭐⭐</option>
            <option value="4">4 ⭐⭐⭐⭐</option>
            <option value="5">5 ⭐⭐⭐⭐⭐</option>
        </select>

        <label class="block mb-2">Feedback:</label>
        <textarea name="feedback" class="w-full border p-2 mb-4" placeholder="Write your feedback..."></textarea>

        <button class="bg-green-500 text-white px-4 py-2 rounded">
            Submit Feedback
        </button>
    </form>
</div>

@endsection