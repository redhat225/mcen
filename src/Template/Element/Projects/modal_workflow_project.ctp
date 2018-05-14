<style>
	.modal-hover-tabs li:not(.is-active) a:hover{
		color: #f85800 !important;
		background: black !important;
		transition-duration: 300ms;
	}
</style>

<div class="modal {{showWorkflowModalTrigger}}" id="show_workflow_modal">
  <div class="modal-background" ng-click="closeWorkflowModal()"></div>
  <div class="modal-card" style="width:70%;">
    <header class="modal-card-head is-none-radius oci-orange-b">
      <p class="modal-card-title has-text-white">Workflow Projet</p>
      <button class="delete" type="button" ng-click="closeWorkflowModal()" aria-label="close"></button>
    </header>
    <section class="modal-card-body is-pad-top-0 is-pad-rgt-0 is-pad-lft-0">
	<div class="tabs is-centered is-boxed if-fullwidth oci-orange-b">
	  <ul class="modal-hover-tabs">
	    <li class="is-active">
	      <a ng-click="workflow_tab = 'history'">
	        <span class="icon is-small"><i class="fas fa-history"></i></span>
	        <span>Historique</span>
	      </a>
	    </li>
	    <li>
	      <a ng-click="workflow_tab = 'comments'">
	        <span class="icon is-small"><i class="fas fa-comments"></i></span>
	        <span>Commentaires</span>
	      </a>
	    </li>
	    <li>
	      <a ng-click="workflow_tab = 'docs'">
	        <span class="icon is-small"><i class="fas fa-file-archive"></i></span>
	        <span>Documents</span>
	      </a>
	    </li>
	  </ul>
	</div>
	<!-- TAbs Switch Area -->
	<div ng-switch on="workflow_tab">
		<div ng-switch-when="history">
			<!-- History table -->
			<table class="table is-fullwidth is-striped is-hoverable">
				<thead>
					<tr>
						<th>Action</th>
						<th>Acteur</th>
						<th>Date</th>
						<th>Issue</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Création Projet</td>
						<td>RIEHL EMMANUEL</td>
						<td>05-04-2018 10H15</td>
						<td>Succès</td>
						<td><button class="button is-white">
							<span class="icon">
								<i class="fas fa-cog"></i>
							</span>
						</button></td>
					</tr>
					<tr>
						<td>Création fiche sécurité projet</td>
						<td>Colombe COULIBALY</td>
						<td>07-04-2018 10H15</td>
						<td>Succès</td>
						<td><button class="button is-white">
							<span class="icon">
								<i class="fas fa-cog"></i>
							</span>
						</button></td>
					</tr>
					<tr>
						<td>Modification Fiche sécurité projet</td>
						<td>Colombe COULIBALY</td>
						<td>07-04-2018 12H15</td>
						<td>Succès</td>
						<td><button class="button is-white">
							<span class="icon">
								<i class="fas fa-cog"></i>
							</span>
						</button></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div ng-switch-when="comments">
				<article class="media">
				  <figure class="media-left">
				    <p class="image is-64x64">
				      <img ng-src="/img/assets/admins/avatar/93960b35-ce1d-4c69-8bda-f5558405bf68.png">
				    </p>
				  </figure>
				  <div class="media-content">
				    <div class="content">
				      <p>
				        <strong>Colombe COULIBALY</strong> <small>@colombeocit7</small> <small>25m</small>
				        <br>
				          Hi Emmanuel Pourrait-tu débuter l'audit de l'infrastructure projet NEXMO
				      </p>
				    </div>
				    <nav class="level is-mobile">
				      <div class="level-left">
				        <a class="level-item">
				          <span class="icon is-small"><i class="fas fa-reply"></i></span>
				        </a>
				        <a class="level-item">
				          <span class="icon is-small"><i class="fas fa-retweet"></i></span>
				        </a>
				        <a class="level-item">
				          <span class="icon is-small"><i class="fas fa-heart"></i></span>
				        </a>
				      </div>
				    </nav>
				  </div>
				</article>
				<article class="media">
				  <figure class="media-left">
				    <p class="image is-64x64">
				      <img ng-src="/img/assets/admins/avatar/a5b60053-8179-40e8-9c5a-6b9a45b1ab23.png">
				    </p>
				  </figure>
				  <div class="media-content">
				    <div class="content">
				      <p>
				        <strong>RIEHL Emmanuel</strong> <small>@remmanuel225</small> <small>31m</small>
				        <br>
				          Il est impératif de fournir la fiche de prérequis d'audit afin que je puisses conduire l'audit de l'infrastructure
				      </p>
				    </div>
				    <nav class="level is-mobile">
				      <div class="level-left">
				        <a class="level-item">
				          <span class="icon is-small"><i class="fas fa-reply"></i></span>
				        </a>
				        <a class="level-item">
				          <span class="icon is-small"><i class="fas fa-retweet"></i></span>
				        </a>
				        <a class="level-item">
				          <span class="icon is-small"><i class="fas fa-heart"></i></span>
				        </a>
				      </div>
				    </nav>
				  </div>
				</article>
		</div>
		<div ng-switch-when="docs">
			<table class="table is-fullwidth is-striped is-hoverable">
				<thead>
					<tr>
						<th>Auteur</th>
						<th>Fichier</th>
						<th>Date</th>
						<th>type</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="asset in current_modal_project.project_assets">
						<td><span class="has-text-weight-semibold is-uppercase">{{asset.user_account.user.user_fullname}}</span></td>
						<td>{{asset.asset_name}}</td>
						<td>{{asset.created | date:'dd/MM/yyyy HH:mm:ss'}}</td>
						<td>{{asset.asset_type}}</td>
						<td>	      
							<a ng-click="download_asset(asset)">Télécharger</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
    </section>
    <footer class="modal-card-foot is-none-radius">
      <button class="button is-black" type="button" ng-click="closeWorkflowModal()">Fermer</button>
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

