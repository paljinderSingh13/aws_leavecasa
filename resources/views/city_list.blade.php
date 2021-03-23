
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>

	<table>
		<thead>
			<tr><th>sr.</th>
				<th>city</th>
				<th> status</th>
				<th> Action</th>
			</tr>
		</thead>

		<tbody>
			@foreach($data as $key => $val)
			<tr>
				<td>{{ $loop->index }}</td>
				<td>{{ $val }}</td>		
				<td></td>		
				<td> <a href="{{ route('gethotel',['ccode'=>$key]) }}"> get hotels</a></td>		
			</tr>
			@endforeach
			

		</tbody>
	</table>

</body>
</html>