<style>
    #wangwei{
        position:absolute; bottom: -100px; right:300px; overflow: hidden; z-index: 9999;
		transition-duration: 850ms;

    }
	#wangwei:hover{
		cursor:pointer;
		bottom: -30px;
		transition-duration: 850ms;
	}
</style>

<div class="columns is-mar-bot-0" style="position:relative; overflow: hidden;">
	<div id="side-menu" class="column is-3-widescreen is-hidden-mobile is-pad-rgt-0 is-pad-top-0 is-mar-top-10 is-pad-bot-0 mcen-green-b" style="position:relative; overflow:hidden;">
				<figure class="image">
			<img src="/img/chartkit/logo-mcen.png" style="width: 90% !important;" alt="">
		</figure>	
		<?= $this->element('side-menu') ?>
	    <?= $this->element('about-me') ?>
	</div>
	<div id="wide-menu" class="column is-9-widesceern is-12-mobile is-mar-top-10 is-pad-top-0 is-pad-lft-0 is-pad-rgt-0" style="border-left:2px solid #1a572b;overflow-y: scroll;">
	    <?= $this->element('navbar_2') ?>
		<!-- Main Section -->
		<section ui-view ng-hide="preloader" class="is-pad-lft-50 is-pad-top-50"></section>

      </div>



<script>
	$('.trigger-resizer').on('click', function(){
		$('#side-menu').toggleClass('is-display-none');
		$('#wide-menu').toggleClass('is-12');
	});
</script>