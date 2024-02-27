<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ration Aadhaar Applications</title>
    <!-- Include any CSS styles if needed -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
    <h1>Ration Aadhaar Applications</h1>
    <table  class="table table-bordered">
        <thead>
            <tr>
            <th >Sl No.</th>
                <th >Application No.</th>
                <th >Name</th>
                <th>Application No.</th>
                <th >Name</th>
                <th>Application No.</th>
                <th >Name</th>
                <th >Application No.</th>
                <th >Name</th>

                <!-- Add other table headers as needed -->
            </tr>
        </thead>
        <tbody>
        @php $i=1; @endphp
            @foreach($records as $record)
                <tr>
                 <td >{{ $i++ }}</td>
                    <td >{{ $record->application_no }}</td>
                    <td >{{ $record->name }}</td>
                     <td >{{ $record->application_no }}</td>
                    <td >{{ $record->name }}</td>
                     <td >{{ $record->application_no }}</td>
                    <td >{{ $record->name }}</td>
                     <td >{{ $record->application_no }}</td>
                    <td>{{ $record->name }}</td>
                    <!-- Add other table data as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>