<style>
	.modal-hover-tabs li:not(.is-active) a:hover{
		color: #f85800 !important;
		background: black !important;
		transition-duration: 300ms;
	}
</style>

<div class="modal {{addAssetModalTrigger}}" id="show_workflow_modal">
  <div class="modal-background" ng-click="closeAssetModal()"></div>
  <div class="modal-card">
  	<form name="uploadAssetForm" ng-submit="upload_asset(upload_asset_project)">
	    <header class="modal-card-head is-none-radius oci-orange-b">
	      <p class="modal-card-title has-text-white">Upload Document</p>
	      <button class="delete" type="button" ng-click="closeAssetModal()" aria-label="close"></button>
	    </header>
	    <section class="modal-card-body is-pad-top-0 is-pad-rgt-0 is-pad-lft-0">
	    	<div class="columns is-centered">
	    		<div class="column">
							<div required ng-if="!upload_asset_project.asset" class="has-text-centered is-centered is-mar-bot-30 drop-box" ngf-select="inspect_asset($file)" ngf-drop="inspect_asset($file)" ng-model="upload_asset_project.asset" name="cover" ngf-max-size="10MB">	
									<img width="300px" height="300px" src='/img/assets/forms/image_upload_drag_area_2.png'">
							</div>

							<div class="image-preview has-text-centered is-centered" ng-if="upload_asset_project.type_asset == 'image' && upload_asset_project.asset!=''">
									<img ngf-thumbnail="upload_asset_project.asset" style="max-width: 70%;">
							</div>

							<div class="image-preview has-text-centered is-centered" ng-if="upload_asset_project.type_asset == 'file' && upload_asset_project.asset!=''">
									<img src="/img/assets/forms/upload_file_vector.png" style="max-width: 50%;" />
							</div>
	    		</div>
	    	</div>
	    </section>

	    <footer class="modal-card-foot is-none-radius">
	      <button type="submit" ng-disabled="uploadAssetForm.$invalid || is_upload_asset" class="button is-oci" type="button" ng-if="upload_asset_project.asset">Upload</button>

	      <button type="button" class="button is-black" type="button" ng-if="upload_asset_project.asset" ng-click="upload_asset_project.asset=''" >Effacer</button>
	      
	      <button type="button" class="button is-pulled-right is-outlined" type="button" ng-click="closeAssetModal()">Fermer</button>
	    </footer>
	</form>
  </div>	
</div>
