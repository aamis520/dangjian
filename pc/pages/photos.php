<script type="text/javascript">
	// Sample Javascript code for this page
	jQuery(document).ready(function($)
	{
		// Sample Select all images
		$("#select-all").on('change', function(ev)
		{
			var is_checked = $(this).is(':checked');
			
			$(".album-image input[type='checkbox']").prop('checked', is_checked).trigger('change');
		});
		
		// Edit Modal
		$('.gallery-env a[data-action="edit"]').on('click', function(ev)
		{
			ev.preventDefault();
			$("#gallery-image-modal").modal('show');
		});
		
		// Delete Modal
		$('.gallery-env a[data-action="trash"]').on('click', function(ev)
		{
			ev.preventDefault();
			$("#gallery-image-delete-modal").modal('show');
		});
		
		
		// Sortable
		
		$('.gallery-env a[data-action="sort"]').on('click', function(ev)
		{
			ev.preventDefault();
			
			var is_sortable = $(".album-images").sortable('instance');
			
			if( ! is_sortable)
			{
				$(".gallery-env .album-images").sortable({
					items: '> div'
				});
				
				$(".album-sorting-info").stop().slideDown(300);
			}
			else
			{
				$(".album-images").sortable('destroy');
				$(".album-sorting-info").stop().slideUp(300);
			}
		});
	});
</script>


		<section class="gallery-env">
			
	<div class="row">
	
		<!-- Gallery Album Optipns and Images -->
		<div class="col-sm-12 gallery-right">
			
			<!-- Album Header -->
			<div class="album-header">
				<h2>活动剪影</h2>
			</div>
			
			
			<!-- Album Images -->
			<div class="album-images row">
				
				<!-- Album Image -->
				<div class="col-md-3 col-sm-4 col-xs-6">
					<div class="album-image">
						<a href="#" class="thumb" data-action="edit">
							<img src="assets/images/album-img-1.png" class="img-responsive">
						</a>
						
						<a href="#" class="name">
							<p>IMG_007.jpg</p>
							<em>28 September 2014</em>
						</a>
						
					</div>
				</div>
				
				<!-- Album Image -->
				<div class="col-md-3 col-sm-4 col-xs-6">
					<div class="album-image">
						<a href="#" class="thumb" data-action="edit">
							<img src="assets/images/album-img-2.png" class="img-responsive">
						</a>
						
						<a href="#" class="name">
							<p>IMG_008.jpg</p>
							<em>20 September 2014</em>
						</a>
						
					</div>
				</div>
				
				<!-- Album Image -->
				<div class="col-md-3 col-sm-4 col-xs-6">
					<div class="album-image">
						<a href="#" class="thumb" data-action="edit">
							<img src="assets/images/album-img-3.png" class="img-responsive">
						</a>
						
						<a href="#" class="name">
							<p>IMG_060.jpg</p>
							<em>03 September 2014</em>
						</a>
						
					</div>
				</div>
				
				<!-- Album Image -->
				<div class="col-md-3 col-sm-4 col-xs-6">
					<div class="album-image">
						<a href="#" class="thumb" data-action="edit">
							<img src="assets/images/album-img-4.png" class="img-responsive">
						</a>
						
						<a href="#" class="name">
							<p>IMG_1008.jpg</p>
							<em>23 August 2014</em>
						</a>
						
					</div>
				</div>
				
				<!-- Album Image -->
				<div class="col-md-3 col-sm-4 col-xs-6">
					<div class="album-image">
						<a href="#" class="thumb" data-action="edit">
							<img src="assets/images/album-img-5.png" class="img-responsive">
						</a>
						
						<a href="#" class="name">
							<p>IMG_023.jpg</p>
							<em>30 July 2014</em>
						</a>
						
					</div>
				</div>
				
				<!-- Album Image -->
				<div class="col-md-3 col-sm-4 col-xs-6">
					<div class="album-image">
						<a href="#" class="thumb" data-action="edit">
							<img src="assets/images/album-img-6.png" class="img-responsive">
						</a>
						
						<a href="#" class="name">
							<p>IMG_012.jpg</p>
							<em>16 July 2014</em>
						</a>
						
					</div>
				</div>
				
				<!-- Album Image -->
				<div class="col-md-3 col-sm-4 col-xs-6">
					<div class="album-image">
						<a href="#" class="thumb" data-action="edit">
							<img src="assets/images/album-img-7.png" class="img-responsive">
						</a>
						
						<a href="#" class="name">
							<p>IMG_207.jpg</p>
							<em>25 June 2014</em>
						</a>
						
					</div>
				</div>
				
				<!-- Album Image -->
				<div class="col-md-3 col-sm-4 col-xs-6">
					<div class="album-image">
						<a href="#" class="thumb" data-action="edit">
							<img src="assets/images/album-img-8.png" class="img-responsive">
						</a>
						
						<a href="#" class="name">
							<p>IMG_002.jpg</p>
							<em>24 August 2013</em>
						</a>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
</section>











