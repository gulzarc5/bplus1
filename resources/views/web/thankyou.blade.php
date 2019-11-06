@extends('web.templet.master')

@section('title', 'aboutus')



@section('content')
	<center>
		<div style="margin-top: 10%; margin-bottom: 4%;">
			<h2 >Thank You for Shopping With Us</h2>
		<p><a href="{{ route('web.order_history') }}">Click Here To See Order History</a></p>
		</div>
	</center>
@endsection