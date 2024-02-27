<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        /* Define your CSS styles for the PDF content here */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Search Results</h1>
    <table>
        <thead>
            <tr>
                <th>Column 1</th>
                <th>Column 2</th>
                <!-- Add more table headers as needed -->
            </tr>
        </thead>
        <tbody>
            <!-- Iterate over your search results and populate the table rows -->
            @foreach($searchResults as $result)
            <tr>
                <td>{{ $result->column1 }}</td>
                <td>{{ $result->column2 }}</td>
                <!-- Add more table cells as needed -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
