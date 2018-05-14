<style>
	.menu-list a.active{
		background: #f85800;
		transition-duration: 300ms;

	}

	.menu-item-wrapper.is-active .menu-item .menu-icon, .menu-item-wrapper.is-active .menu-item .menu-text{
			color: orange !important;
		transition-duration: 300ms;

	}

	.menu-item-wrapper.is-active{
		background: #c8e2d5;
		transition-duration: 300ms;
	}

	.menu-list li a:hover{
		transition-duration: 300ms;
	}
</style>

<section class="is-small is-pad-bot-200 is-pad-top-30 has-text-white " style="min-height: 800px !important;">
	<div class="menu-wrapper">
		<aside class="menu">
		  <p class="menu-label has-text-white ">
		    Administration
		  </p>
		  <ul class="menu-list">
		    <li><a ui-sref="admins.dashboard" ui-sref-active="is-active" class="has-text-white ">Dashboard</a></li>
		    <li>
		    	 <a class="has-text-white ">Auditeurs</a>
				<ul>
					<li><a ui-sref="admins.accounts.view" class="has-text-white ">Membres</a></li>
					<li><a ui-sref="admins.accounts.create" class="has-text-white ">Ajouter un membre</a></li>
				</ul>
		    </li>
		    <li><a ui-sref="admins.trainings.all" ui-sref-active="is-active" class="has-text-white ">Formations</a></li>
		  </ul>
		  <p class="menu-label has-text-white">
		    Liens utiles
		  </p>
		</aside>
	</div>
</section>

<?= $this->element('Admins/modal_users')  ?>

<script>
	$(document).ready(function(){
		$('.menu-list-include-wrapper').on('click', function(){
			$('.menu-list-include-wrapper').removeClass('active');
			$(this).toggleClass('is-active');
			if($(this).hasClass('is-active'))
			  $(this).next('ul').slideDown();
			else
			  $(this).next('ul').slideUp();

		});
	});
</script>


