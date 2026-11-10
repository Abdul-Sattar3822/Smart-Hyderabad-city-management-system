<form method="POST" action="/admin/complaints/{{ $c->id }}/status">
    @csrf
    <select name="status" onchange="this.form.submit()">
        <option {{ $c->status=='pending'?'selected':'' }}>pending</option>
        <option {{ $c->status=='in_progress'?'selected':'' }}>in_progress</option>
        <option {{ $c->status=='resolved'?'selected':'' }}>resolved</option>
    </select>
</form>

{{-- ✅ YAHAN ADD KARO -- Department Assign Form --}}
<form method="POST"
    action="{{ route('admin.complaints.assign-department', $c) }}">
    @csrf
    <div class="flex gap-2 items-center mt-2">
        <select name="department_id"
            class="border rounded px-2 py-1 text-xs text-gray-700">
            <option value="">-- Assign Dept --</option>
            @foreach($departments as $dept)
                <option value="{{ $dept->id }}"
                    {{ $c->department_id == $dept->id ? 'selected' : '' }}>
                    {{ $dept->icon }} {{ $dept->name }}
                </option>
            @endforeach
        </select>
        <button type="submit"
            class="bg-purple-600 text-white px-3 py-1 rounded text-xs hover:bg-purple-700">
            Assign
        </button>
    </div>
    @if($c->department)
        <p class="text-xs text-green-600 mt-1">
            ✅ {{ $c->department->name }}
        </p>
    @endif
</form>
{{-- Department Assign Form End --}}

<form method="POST" action="/admin/complaints/{{ $c->id }}/note">
    @csrf
    <input type="text" name="note" value="{{ $c->admin_note }}">
</form>
<img src="{{ asset('storage/'.$c->image) }}" class="w-20 cursor-pointer">
@if($c->created_at->diffInHours(now()) > 24)
    <span class="text-red-500">Overdue</span>
@endif
@if($c->priority == 'high')
    <span class="bg-red-600 text-white px-2 py-1 rounded">
        🔥 Critical
    </span>
@endif