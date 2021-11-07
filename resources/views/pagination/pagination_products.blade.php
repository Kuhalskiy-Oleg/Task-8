
<div class="product_pagination" style="display: flex;justify-content: center;">
	<ul class="pagination">

		<style type="text/css">
			
			.product_pagination ul li:not(:last-child)
			{
				margin-right: 10px!important;
			}
			li span,li a{
				font-size: 20px!important;
			}
			li.active span{
				color: red!important;
			}


		</style>

		<!-- previus -->
		@if ($paginator->onFirstPage())
			<li class="disabled"><span>&laquo;</span></li>
		@else 
			<li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
		@endif


		<!-- pagination number page -->
		@foreach ($elements as $element)

			<!-- three dots -->
			@if (is_string($element))
				<li class="disabled"><span>{{ $element }}</span></li>
			@endif

			<!-- number page -->
			@if (is_array($element))
				@foreach ($element as $page => $url)
					@if ($page == $paginator->currentPage())
						<li class="active"><span>{{ $page }}</span></li>
					@else 
						<li><a data-paginate href="{{ $url }}">{{ $page }}</a></li>
					@endif
				@endforeach
			@endif

		@endforeach


		<!-- next -->
		@if ($paginator->hasMorePages())
			<li><a data-paginate href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
		@else 
			<li class="disabled"><span>&raquo;</span></li>
		@endif

	</ul>
</div>

