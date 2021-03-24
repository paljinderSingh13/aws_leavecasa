@extends('frontend.layout.materialize')
@section('content')

<div class="container">
	<div class="row">
		<div class="col s8 offset-s2"> 
			<a href="{{ route('wallet') }}"> Add Amount </a>
	<table class="responsive-table ">
        <thead>
          <tr>
              <th>Date of transaction </th>
              <th> Credit</th>
              <th>Debited </th>
              <th>Purpose </th>
              <th>Balance </th>
          </tr>
        </thead>

        <tbody>
        @forelse($detail as $key => $val)
          <tr>
            <td>{{ $val['date_of_transaction'] }}</td>
            <td>{{ $val['credited'] }}</td>
            <td>{{ $val['debited'] }}</td>
            <td>{{ $val['type'] }}</td>
            <td>{{ $val['available_balance'] }}</td>
          </tr>
         @empty
		    <p>No users</p>
		@endforelse
         
        </tbody>
      </table>
      </div>
      </div>
</div>
@endsection