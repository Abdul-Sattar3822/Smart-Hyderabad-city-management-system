<!DOCTYPE html>
<html>
<head>
    <title>City Management</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        a {
            text-decoration: none;
            background: #3490dc;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background: #3490dc;
            color: white;
        }

        input {
            padding: 8px;
            width: 300px;
            margin-bottom: 10px;
        }

        button {
            background: green;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    @yield('content')
</div>

</body>
</html>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete?");
    }
</script>