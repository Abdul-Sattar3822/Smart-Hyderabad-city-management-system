<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Complaint Report — Smart Hyderabad</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #1f2937; background: #fff; }

        /* Header */
        .header { background: #1e3a5f; color: white; padding: 24px 30px; margin-bottom: 24px; }
        .header-top { display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 20px; font-weight: bold; }
        .logo span { color: #60a5fa; }
        .header-sub { color: #93c5fd; font-size: 11px; margin-top: 2px; }
        .report-title { text-align: right; }
        .report-title h2 { font-size: 16px; font-weight: bold; }
        .report-title p { color: #93c5fd; font-size: 11px; margin-top: 2px; }

        /* Stats Row */
        .stats { display: flex; gap: 12px; margin: 0 30px 20px; }
        .stat-box { flex: 1; padding: 12px; border-radius: 8px; text-align: center; }
        .stat-box.total { background: #eff6ff; border: 1px solid #bfdbfe; }
        .stat-box.pending { background: #fefce8; border: 1px solid #fde68a; }
        .stat-box.progress { background: #eff6ff; border: 1px solid #bfdbfe; }
        .stat-box.resolved { background: #f0fdf4; border: 1px solid #bbf7d0; }
        .stat-number { font-size: 22px; font-weight: bold; }
        .stat-label { font-size: 10px; color: #6b7280; margin-top: 2px; }
        .stat-box.total .stat-number { color: #1d4ed8; }
        .stat-box.pending .stat-number { color: #d97706; }
        .stat-box.progress .stat-number { color: #2563eb; }
        .stat-box.resolved .stat-number { color: #16a34a; }

        /* Section Title */
        .section-title { margin: 0 30px 10px; font-size: 13px; font-weight: bold; color: #374151; border-bottom: 2px solid #e5e7eb; padding-bottom: 6px; }

        /* Table */
        .table-wrap { margin: 0 30px; }
        table { width: 100%; border-collapse: collapse; font-size: 11px; }
        thead tr { background: #1e3a5f; color: white; }
        thead th { padding: 10px 8px; text-align: left; font-weight: 600; }
        tbody tr { border-bottom: 1px solid #f3f4f6; }
        tbody tr:nth-child(even) { background: #f9fafb; }
        tbody tr:hover { background: #eff6ff; }
        tbody td { padding: 9px 8px; vertical-align: middle; }

        /* Badges */
        .badge { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 10px; font-weight: 600; }
        .badge-pending { background: #fef9c3; color: #92400e; }
        .badge-progress { background: #dbeafe; color: #1e40af; }
        .badge-resolved { background: #dcfce7; color: #166534; }
        .badge-high { background: #fee2e2; color: #991b1b; }
        .badge-medium { background: #fef9c3; color: #92400e; }
        .badge-low { background: #dcfce7; color: #166534; }

        /* Footer */
        .footer { margin-top: 24px; padding: 16px 30px; background: #f9fafb; border-top: 1px solid #e5e7eb; display: flex; justify-content: space-between; font-size: 10px; color: #9ca3af; }

        /* Page Break */
        .page-break { page-break-after: always; }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <div class="header-top">
            <div>
                <div class="logo">🏛️ Smart <span>Hyderabad</span> City</div>
                <div class="header-sub">Citizen Complaint Management System</div>
            </div>
            <div class="report-title">
                <h2>📄 Complaint Report</h2>
                <p>Generated: {{ now()->format('d M Y, h:i A') }}</p>
            </div>
        </div>
    </div>

    <!-- STATS -->
    @php
        $total      = $complaints->count();
        $pending    = $complaints->where('status','pending')->count();
        $inProgress = $complaints->where('status','in_progress')->count();
        $resolved   = $complaints->where('status','resolved')->count();
    @endphp
    <div class="stats">
        <div class="stat-box total">
            <div class="stat-number">{{ $total }}</div>
            <div class="stat-label">Total Complaints</div>
        </div>
        <div class="stat-box pending">
            <div class="stat-number">{{ $pending }}</div>
            <div class="stat-label">Pending</div>
        </div>
        <div class="stat-box progress">
            <div class="stat-number">{{ $inProgress }}</div>
            <div class="stat-label">In Progress</div>
        </div>
        <div class="stat-box resolved">
            <div class="stat-number">{{ $resolved }}</div>
            <div class="stat-label">Resolved</div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="section-title">All Complaints</div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>User</th>
                    <th>Category</th>
                    <th>City</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($complaints as $c)
                <tr>
                    <td style="color:#9ca3af; font-family:monospace;">#{{ $c->id }}</td>
                    <td style="font-weight:600;">{{ $c->title }}</td>
                    <td>{{ $c->user->name ?? 'N/A' }}</td>
                    <td>{{ ucfirst($c->category ?? 'N/A') }}</td>
                    <td>{{ $c->city ?? 'N/A' }}</td>
                    <td>
                        <span class="badge
                            {{ $c->priority == 'high' ? 'badge-high' :
                               ($c->priority == 'medium' ? 'badge-medium' : 'badge-low') }}">
                            {{ ucfirst($c->priority ?? 'N/A') }}
                        </span>
                    </td>
                    <td>
                        <span class="badge
                            {{ $c->status == 'pending' ? 'badge-pending' :
                               ($c->status == 'in_progress' ? 'badge-progress' : 'badge-resolved') }}">
                            {{ ucfirst(str_replace('_',' ',$c->status)) }}
                        </span>
                    </td>
                    <td style="color:#9ca3af;">{{ $c->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <span>🏛️ Smart Hyderabad City — Complaint Management System</span>
        <span>Total: {{ $total }} complaints | Resolved: {{ $resolved }} | Resolution Rate: {{ $total > 0 ? round(($resolved/$total)*100) : 0 }}%</span>
        <span>{{ now()->format('d M Y') }}</span>
    </div>

</body>
</html>