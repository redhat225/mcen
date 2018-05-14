<style>
	.modal-hover-tabs li:not(.is-active) a:hover{
		color: white !important;
		background: #1a572b !important;
		transition-duration: 300ms;
	}
</style>

<div class="modal {{showContentTrainingModalTrigger}}" id="show_workflow_modal">
  <div class="modal-background" ng-click="closeModalContent()"></div>
  <div class="modal-card" style="width:70%;">
    <header class="modal-card-head is-none-radius mcen-green-b">
      <p class="modal-card-title has-text-white">Contenu Formation - {{content_trainings.training_denomination}}</p>
      <button class="delete" type="button" ng-click="closeModalContent()" aria-label="close"></button>
    </header>
    <section class="modal-card-body is-pad-top-0 is-pad-rgt-0 is-pad-lft-0">
	<div class="tabs is-centered is-boxed is-fullwidth ">
	  <ul class="modal-hover-tabs">
	    <li class="is-active">
	      <a ng-click="workflow_tab = 'courseware'">
	        <span class="icon is-small"><i class="fas fa-book"></i></span>
	        <span>Cours</span>
	      </a>
	    </li>
	    <li>
	      <a ng-click="workflow_tab = 'tools'">
	        <span class="icon is-small"><i class="fas fa-briefcase"></i></span>
	        <span>Outils</span>
	      </a>
	    </li>
	    <li>
	      <a ng-click="workflow_tab = 'others'">
	        <span class="icon is-small"><i class="fas fa-file-archive"></i></span>
	        <span>Autres</span>
	      </a>
	    </li>
	  </ul>
	</div>
	<!-- TAbs Switch Area -->
	<div ng-switch on="workflow_tab">
		<div ng-switch-when="courseware">
			<!-- Courseware table -->
			<table class="table is-fullwidth is-striped is-hoverable content_training">
				<thead>
					<tr>
						<th>Nom</th>
						<th>Création</th>
						<th>Type</th>
						<th>Taille</th>
						<th>Télécharger</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="content_training in content_trainings.training_assets" ng-if="content_training.training_asset_type.type_denomination == 'Cours'" class="has-text-centered">
						<td>{{content_training.asset_details.name}}</td>
						<td>{{content_training.created | date: "dd/MM/yyyy HH:mm:ss"}}</td>
						<td>{{content_training.asset_details.type}}</td>
						<td>{{content_training.asset_details.size}}</td>
						<td>
							<a href="{{content_training.asset_details.remote_path}}" class="button is-outlined is-mcen-green">
								<span class="icon">
									<i class="fas fa-download"></i>
								</span>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div ng-switch-when="tools">
			<table class="table is-fullwidth is-striped is-hoverable content_training">
				<thead>
					<tr>
						<th>Nom</th>
						<th>Création</th>
						<th>Type</th>
						<th>Taille</th>
						<th>Télécharger</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="content_training in content_trainings.training_assets" ng-if="content_training.training_asset_type.type_denomination == 'Outil'" class="has-text-centered">
						<td>{{content_training.asset_details.name}}</td>
						<td>{{content_training.created | date: "dd/MM/yyyy HH:mm:ss"}}</td>
						<td>{{content_training.asset_details.type}}</td>
						<td>{{content_training.asset_details.size}}</td>
						<td>
							<a href="{{content_training.asset_details.remote_path}}" class="button is-outlined is-mcen-green">
								<span class="icon">
									<i class="fas fa-download"></i>
								</span>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div ng-switch-when="others">
			<table class="table is-fullwidth is-striped is-hoverable content_training">
				<thead>
					<tr>
						<th>Nom</th>
						<th>Création</th>
						<th>Type</th>
						<th>Taille</th>
						<th>Télécharger</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="content_training in content_trainings.training_assets" ng-if="content_training.training_asset_type.type_denomination == 'Autre'" class="has-text-centered">
						<td>{{content_training.asset_details.name}}</td>
						<td>{{content_training.created | date: "dd/MM/yyyy HH:mm:ss"}}</td>
						<td>{{content_training.asset_details.type}}</td>
						<td>{{content_training.asset_details.size}}</td>
						<td>
							<a href="{{content_training.asset_details.remote_path}}" class="button is-outlined is-mcen-green">
								<span class="icon">
									<i class="fas fa-download"></i>
								</span>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
    </section>
    <footer class="modal-card-foot is-none-radius">
      <button class="button is-black" type="button" ng-click="closeModalContent()">Fermer</button>
    </footer>
  </div>	
</div>

<script>
	$(document).ready(function(){
		$('.modal-hover-tabs li').on('click', function(){
			$('.modal-hover-tabs li').removeClass('is-active');
			$(this).addClass('is-active');
		});
	});
</script>

