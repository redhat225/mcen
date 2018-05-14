<style>
	.modal-hover-tabs li:not(.is-active) a:hover{
		color: #f85800 !important;
		background: black !important;
		transition-duration: 300ms;
	}
</style>

<div class="modal {{addAssetModalTrigger}}" id="show_workflow_modal">
  <div class="modal-background" ng-click="closeAssetModal()"></div>
  <div class="modal-card" style="width: 75% !important;">
  	<form name="uploadAssetForm" ng-submit="upload_asset(upload_asset_project)">
		   <header class="modal-card-head is-none-radius mcen-green-b">
	      <p class="modal-card-title has-text-white">Upload Document</p>
	      <button class="delete" type="button" ng-click="closeAssetModal()" aria-label="close"></button>
	    </header>
	    <section class="modal-card-body is-pad-top-0 is-pad-rgt-0 is-pad-lft-0">
	    	<div class="columns is-centered">
	    		<div class="column is-2-widescreen">
							<div required class="has-text-centered is-centered is-mar-bot-30 is-mar-top-30 drop-box" ngf-select="inspect_asset($files)" ngf-multiple="true" ngf-keep="'distinct'" ngf-drop="inspect_asset($files)" ng-model="upload_asset_project.assets" name="cover" ngf-max-total-size="'100MB'">	
									<img width="300px" height="300px" src='/img/assets/forms/image_upload_drag_area_2.png'">
							</div>

							<div class="image-preview has-text-centered is-centered" ng-if="upload_asset_project.assetsasset == 'file' && upload_asset_project.assets!=''">
									<img src="/img/assets/forms/upload_file_vector.png" style="max-width: 50%;" />
							</div>
	    		</div>
	    		<div class="column is-10-widescreen">
	    			    <table class="table striped is-fullwidth" style="overflow: scroll;">
	    			    	<thead>
	    			    		<tr>
	    			    			<th>#</th>
	    			    			<th>Nom</th>
	    			    			<th>Extension</th>
	    			    			<th>Type</th>
	    			    			<th>Taille</th>
	    			    			<th>Effacer</th>
	    			    		</tr>
	    			    	</thead>
	    			    	<tbody>
	    			    		<tr ng-repeat="asset in upload_asset_project.assets track by $index">
	    			    			<td>{{$index+1}}</td>
	    			    			<td>
	    			    				<div class="field">
	    			    					<div class="control">
	    			    						<input type="text" readonly required class="input" ng-model="asset.name">
	    			    					</div>
	    			    				</div>
	    			    			</td>
	    			    			<td>
	    			    				{{asset.type}}
	    			    			</td>
	    			    			<td>
	    			    				<div class="field">
	    			    					<div class="select">
	    			    						<div class="control">
	    			    							<select required ng-options="t.id as t.type_denomination for t in training_asset_types" ng-model="asset.training_asset_type_id">
	    			    							</select>
	    			    						</div>
	    			    					</div>
	    			    				</div>
	    			    			</td>
	    			    			<td>
	    			    				{{asset.size}} KB
	    			    			</td>
	    			    			<td>
	    			    				<span class="icon" ng-click="remove_asset(asset, $index)">
	    			    					<i class="fas fa-window-close"></i>
	    			    				</span>
	    			    			</td>
	    			    		</tr>
	    			    	</tbody>
	    			    </table>
	    		</div>
	    	</div>
	    </section>

	    <footer class="modal-card-foot is-none-radius mcen-grey-b">
	      <button type="submit" ng-disabled="uploadAssetForm.$invalid || is_upload_asset" class="button is-mcen-green" type="button" ng-if="upload_asset_project.assets">Upload</button>

	      <button type="button" class="button is-black" type="button" ng-if="upload_asset_project.assets" ng-click="upload_asset_project.assets=''" >Effacer</button>
	      
	      <button type="button" class="button is-pulled-right is-outlined is-black" type="button" ng-click="closeAssetModal()">Fermer</button>
	    </footer>
	</form>
  </div>	
</div>
