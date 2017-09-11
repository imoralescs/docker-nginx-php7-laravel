@extends('layouts.app')

@section('content')
<div>
	<div>
		@include('common.errors')
		<form action="{{ url('task') }}" method="POST">
			<div>
				<label>Task</label>
				<div>
					<input type="text" name="name" id="name">
				</div>
			</div>
			<div>
				<div>
					<button type="submit">Add Task</button>
				</div>
			</div>
			{{ csrf_field() }}
		</form>
	</div>
</div>
@if($tasks->count())
<div>
	<div>
		<h2>Current Tasks</h2>
	</div>
	<div>
		<table>
			<thead>
				<th>Task</th>
				<th>&nbsp;</th>
			</thead>
			<tbody>
				@foreach($tasks as $task)
					<tr>
						<td>{{ $task->name }}</td>
						<td>
							<form action="{{ url('task/' . $task->id) }}" method="POST">
								<button type="submit">Delete</button>
								{{ method_field('DELETE') }}
								{{ csrf_field() }}
							</form>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endif
@endsection