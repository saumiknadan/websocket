@extends('main')

@section('content')

<div class="row">
	<div class="col-sm-4 col-lg-3">
		<div class="card">
			<div class="card-header"><b>Connected User</b></div>
			<div class="card-body" id="user_list">
					You are login in Laravel chat application.
			</div>
		</div>
	</div>
	
</div>

@endsection

<script>
	var conn = new WebSocket('ws://127.0.0.1:8090/');

	conn.onopen = function(e){
		console.log("connection established");
	};

	conn.onmessage = function(e){

	}
</script>