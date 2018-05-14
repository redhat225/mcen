<div class="modal {{modal_show_captures_trigger}}">
  <div class="modal-background" ng-click="modal_close_show_captures()"></div>
  <div class="modal-card">
    <header class="modal-card-head is-radiusless oci-orange-b">
      <p class="modal-card-title has-text-white">Captures</p>
      <button class="delete" aria-label="close" ng-click="modal_close_show_captures()"></button>
    </header>
    <section class="modal-card-body">
    	<div class="capture has-text-centered">
    		   <zoom ng-repeat="capture in tmp_selected.correction_captures track by $index" src="{{capture.composed_image}}" frame="example{{$index}}" img="image{{$index}}" zoomlvl="2.5"></zoom>
    	</div>
    </section>
  </div>
</div>
