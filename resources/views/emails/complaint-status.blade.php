<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { background: white; max-width: 600px; margin: 0 auto; border-radius: 10px; overflow: hidden; }
        .header { background: #1e293b; color: white; padding: 20px; text-align: center; }
        .body { padding: 30px; }
        .status { display: inline-block; padding: 6px 16px; border-radius: 20px; font-weight: bold; }
        .resolved { background: #dcfce7; color: #16a34a; }
        .in_progress { background: #dbeafe; color: #2563eb; }
        .pending { background: #fef9c3; color: #ca8a04; }
        .footer { background: #f8fafc; padding: 15px; text-align: center; color: #94a3b8; font-size: 12px; }
        .btn { background: #2563eb; color: white; padding: 10px 24px; border-radius: 6px; text-decoration: none; display: inline-block; margin-top: 16px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>🏛️ Smart Hyderabad City</h2>
            <p style="margin:0; opacity:0.8">Complaint Update Notification</p>
        </div>
        <div class="body">
            <p>Dear <strong>{{ $complaint->user->name }}</strong>,</p>

            @if($updateType === 'status')
                <p>Your complaint <strong>#{{ $complaint->id }} — {{ $complaint->title }}</strong> status has been updated to:</p>
                <span class="status {{ $complaint->status }}">
                    {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                </span>
            @elseif($updateType === 'department')
                <p>Your complaint <strong>#{{ $complaint->id }} — {{ $complaint->title }}</strong> has been assigned to:</p>
                <span class="status in_progress">
                    {{ $complaint->department->icon ?? '' }} {{ $complaint->department->name ?? 'A Department' }}
                </span>
            @endif

            <p style="margin-top: 20px;">
                <strong>Complaint Details:</strong><br>
                Category: {{ $complaint->category ?? 'N/A' }}<br>
                City: {{ $complaint->city ?? 'N/A' }}<br>
                Priority: {{ ucfirst($complaint->priority ?? 'N/A') }}
            </p>

            <a href="{{ url('/complaints') }}" class="btn">View My Complaints</a>
        </div>
        <div class="footer">
            Smart Hyderabad City — Citizen Complaint Management System
        </div>
    </div>
</body>
</html>