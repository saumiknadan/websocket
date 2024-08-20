@extends('main')

@section('content')

<div class="row">
	<div class="col-sm-4 col-lg-3">
		<div class="card">
			<div class="card-header"><b>Connected User</b></div>
			<div class="card-body" id="user_list">
				
			</div>
		</div>
	</div>
	<div class="col-sm-4 col-lg-6">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col col-md-6" id="chat_header"><b>Chat Area</b></div>
					<div class="col col-md-6" id="close_chat_area"></div>
				</div>
			</div>
			<div class="card-body" id="chat_area">
				
			</div>
		</div>
	</div>
	<div class="col-sm-4 col-lg-3">
		<div class="card" style="height:255px; overflow-y: scroll;">
			<div class="card-header">
				<input type="text" class="form-control" placeholder="Search User..." autocomplete="off" id="search_people" onkeyup="search_user('{{ Auth::id() }}', this.value);" />
			</div>
			<div class="card-body">
				<div id="search_people_area" class="mt-3"></div>
			</div>
		</div>
		<br />
		<div class="card" style="height:255px; overflow-y: scroll;">
			<div class="card-header"><b>Notification</b></div>
			<div class="card-body">
				<ul class="list-group" id="notification_area">
					
				</ul>
			</div>
		</div>
	</div>
</div>

<style>

	#chat_area
	{
		min-height: 500px;
		/*overflow-y: scroll*/;
	}

	#chat_history
	{
		min-height: 500px; 
		max-height: 500px; 
		overflow-y: scroll; 
		margin-bottom:16px; 
		background-color: #ece5dd;
		padding: 16px;
	}

	#user_list
	{
		min-height: 500px; 
		max-height: 500px; 
		overflow-y: scroll;
	}
</style>

@endsection('content')

<script>
	var conn = new WebSocket('ws://127.0.0.1:8090/?token={{ auth()->user()->token }}');

	var from_user_id = "{{ Auth::user()->id }}";

	var to_user_id = "";

	conn.onopen = function(e){
		console.log("connection established");

		load_unconnected_user(from_user_id);

	};

	conn.onmessage = function(e){

	}


	function load_unconnected_user(from_user_id)
	{
		var data = {
			from_user_id : from_user_id,
			type : 'request_load_unconnected_user'
		};

		conn.send(JSON.stringify(data));
	}
</script>