<html>
<head>
  <title>Laravel 9 Generate PDF File Using DomPDF - Techsolutionstuff</title>
  <style>
    .bordered-table {
        border: 1px solid #000;
        /* Add other styling as needed */
    }
    .bordered-cell {
        border: 1px solid #000;
        /* Add other styling as needed */
    }
</style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-12" style="margin-top: 15px ">
        <div class="pull-left">
          <h2>{{ $title}}</h2>
          <h4>{{$date}}</h4>
        </div>

      </div>
    </div><br>
    <table   class="table table-striped table-bordered" style="width:100%;border-collapse: collapse !important;">
      <tr>
        <th class="bordered-cell">Application Number</th>
        <th class="bordered-cell">Name</th>
        {{-- <th class="bordered-cell">Address</th>

        <th class="bordered-cell">Age</th>
        <th class="bordered-cell">Gender</th> --}}
        {{-- <th class="bordered-cell">Eligible For IMPDS</th>

        <th class="bordered-cell">Mobile Number </th>
        <th class="bordered-cell">Adhar Number</th>
        <th class="bordered-cell">Ration Card Number</th>
        <th class="bordered-cell">Since when staying in Kerala </th>
        <th class="bordered-cell">District </th>
		<th class="bordered-cell">Location  </th>
		<th class="bordered-cell">Created Date  </th> --}}
      </tr>
      @foreach ($users as $user)

      <tr>
        <td class="bordered-cell">{{ @$user->name }}</td>
        <td class="bordered-cell">{{ @$user->name }}</td>
        {{-- <td class="bordered-cell">{{ @$user->address }}</td>
        <td class="bordered-cell">{{ @$user->age }}</td>
        <td class="bordered-cell">{{ @$user->gender }}</td> --}}

        {{-- <td class="bordered-cell">{{ @$user->eligibility }}</td>
        <td class="bordered-cell">{{ @$user->mobile }}</td>
        <td class="bordered-cell">{{ @$user->aadhaar }}</td>
        <td class="bordered-cell">{{ @$user->ration }}</td>
        <td class="bordered-cell">{{ @$user->years }}</td> --}}

{{--
        <td class="bordered-cell">{{ @$user->district }}</td>
        <td class="bordered-cell">{{ @$user->location }}</td>
        <td class="bordered-cell">{{ @$user->created_at->format('Y-m-d') }}</td> --}}

      </tr>
      @endforeach
    </table>
  </div>
</body>
</html>
