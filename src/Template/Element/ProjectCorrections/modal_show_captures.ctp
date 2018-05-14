<div class="modal {{modal_show_captures_trigger}}">
  <div class="modal-background" ng-click="hide_captures_box()"></div>
  <div class="modal-card">
    <header class="modal-card-head is-radiusless oci-orange-b">
      <p class="modal-card-title has-text-white">Carrousel - capture</p>
      <button class="delete" aria-label="close" ng-click="hide_captures_box()"></button>
    </header>
    <section class="modal-card-body">
    	<div class="capture has-text-centered">
    		   <zoom ng-repeat="slide in slides" src="{{slide}}" frame="example{{$index}}" img="image{{$index}}" zoomlvl="2.5"></zoom>
    	</div>
    </section>
  </div>
</div>
