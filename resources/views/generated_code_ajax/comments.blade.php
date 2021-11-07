
@if(isset($response['comments']))
	@foreach($response['comments'] as $comment)
		<div class="panel">
			<div class="panel-body">
				<div class="media-block" style="background-color: aliceblue;">
					<div class="media-body">
						<div class="mar-btm">
							<span href="#" class="btn-link text-semibold media-heading box-inline">
								{{ $comment->user->name }}
							</span>
							<p class="text-muted text-sm">{{ $comment->created_at }}</p>
						</div>
						<p>{{ $comment->text }}</p>
						<hr style="margin-bottom: 0">
					 </div>
				</div>
			</div>
		</div>
	@endforeach
@endif