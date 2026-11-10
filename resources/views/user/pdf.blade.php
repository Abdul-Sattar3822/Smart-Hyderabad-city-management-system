<!DOCTYPE html>
<html>
<head>
    <title>Complaint PDF</title>
</head>
<body>

    <h2>Complaint Receipt</h2>

    <p><strong>Title:</strong> {{ $complaint->title }}</p>
    <p><strong>Description:</strong> {{ $complaint->description }}</p>
    <p><strong>Status:</strong> {{ $complaint->status }}</p>
    <p><strong>Date:</strong> {{ $complaint->created_at }}</p>

</body>
</html>