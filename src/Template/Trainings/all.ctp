<section ui-view>
	  <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
	<div class="columns">
		<div class="column">
			<nav class="breadcrumb" aria-label="breadcrumbs">
			  <ul>
			    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
			    <li class="is-active"><a >Formations</a></li>
			  </ul>
			</nav>
		</div>
		<div class="column">
				<div class="field has-addons is-expanded">
					<div class="control is-expanded">
						<input type="text" class="input" ng-model="filter_keys">
					</div>
					<div class="control">
						<a class="button is-intercoton-green is-static">
							<span class="icon">
								<i class="fa fa-search"></i>
							</span>
							<span>Rechercher</span>
						</a>
					</div>
				</div>



		</div>
		<div class="column">
				<button class="button is-mcen-green" ui-sref="admins.trainings.create">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span>Créer une formation</span>
				</button>
		</div>
	</div>
	<!-- Pagintaion module -->
     	<div class="level is-mobile is-pad-bot-30">
     		<div class="level-left">
     			<div class="span level-item">
     				&nbsp;
     			</div>
     		</div>
     		<div class="level-right">
				<div class="field has-addons level-item">
				  <p class="control">
				    <a class="button is-intercoton-green" ng-click="previous_page()" ng-disabled="is_loading">
				      <span class="icon is-small">
				        <i class="fa fa-chevron-left"></i>
				      </span>
				      <span class="has-text-weight-semibold">Précédent</span>
				    </a>
				  </p>
				  <p class="control">
				    <a class="button is-static is-disabled">
				      <span ng-bind="pagination.current_page" ng-hide="is_loading">1</span> sur <span ng-bind="pagination.all_pages" ng-hide="is_loading">45</span>
				    </a>
				  </p>
				  <p class="control">
				    <a class="button is-intercoton-green" ng-click="next_page()" ng-disabled="is_loading">
				      <span class="has-text-weight-semibold">Suivant</span>
				      <span class="icon is-small">
				        <i class="fa fa-chevron-right"></i>
				      </span>
				    </a>
				  </p>
				</div>
     		</div>
     	</div>
		<div>
				<!-- Tabular view -->
				<table class="table is-hoverable is-striped is-fullwidth">
					<thead>
						<tr class="mcen-green-b">
							<th class="has-text-mcen-yellow">Id</th>
							<th class="has-text-mcen-yellow">Dénomination</th>
							<th class="has-text-mcen-yellow">Date création</th>
							<th class="has-text-mcen-yellow">Dernière Modification</th>
							<th class="has-text-mcen-yellow">Plus d'infos</th>
							<th class="has-text-mcen-yellow">Contenu</th>
							<th class="has-text-mcen-yellow">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="training in trainings | filter:filter_keys" class="">
							<td>{{$index+1}}</td>
							<td>{{training.training_denomination}}</td>
							<td>{{training.created | date:'dd/MM/yyyy HH:mm:ss'}}</td>
							<td>{{training.modified | date:'dd/MM/yyyy HH:mm:ss'}}</td>
							<td>
								<span class="icon has-text-mcen-green" ng-click="showInfoContentModal(training)">
									<i class="fas fa-info-circle"></i>
								</span>
							</td>
							<td>
								<span class="icon has-text-mcen-green" ng-click="showModalContent(training)">
									<i class="fas fa-info-circle"></i>
								</span>
							</td>
				  			<td>
									   <div class="dropdown is-hoverable is-right">
											  <div class="dropdown-trigger">
											    <button class="button">
											      <span class="icon is-small">
													<i class="fas fa-cogs menu-icon"></i>
											      </span>
											    </button>
											  </div>
											  <div class="dropdown-menu" id="dropdown-menu" role="menu">
											    <div class="dropdown-content">
													 <a ui-sref="admins.trainings.edit({training_id:training.id})" class="dropdown-item">
											            	Changer Dénomination
													 </a>
													 <a ng-click="openAssetModal(training)" class="dropdown-item">
											            	Upload Contenu
													 </a>
													 <a class="dropdown-item" ng-click="lock_user_account_trigger(user.user_accounts[0].id, user.user_accounts[0])" ng-if="user.user_accounts[0].user_account_is_active==true">
											            	Verrouiller formation
													 </a>
											    </div>
											  </div>
										</div>
				  			</td>
						</tr>
					</tbody> 
				</table>
		</div>
	</div>
	<!-- Pagintaion module -->
     	<div class="level is-mobile is-pad-bot-30">
     		<div class="level-left">
     			<div class="span level-item">
     				&nbsp;
     			</div>
     		</div>
     		<div class="level-right">
				<div class="field has-addons level-item">
				  <p class="control">
				    <a class="button is-intercoton-green" ng-click="previous_page()" ng-disabled="is_loading">
				      <span class="icon is-small">
				        <i class="fa fa-chevron-left"></i>
				      </span>
				      <span class="has-text-weight-semibold">Précédent</span>
				    </a>
				  </p>
				  <p class="control">
				    <a class="button is-static is-disabled">
				      <span ng-bind="pagination.current_page" ng-hide="is_loading">1</span> sur <span ng-bind="pagination.all_pages" ng-hide="is_loading">45</span>
				    </a>
				  </p>
				  <p class="control">
				    <a class="button is-intercoton-green" ng-click="next_page()" ng-disabled="is_loading">
				      <span class="has-text-weight-semibold">Suivant</span>
				      <span class="icon is-small">
				        <i class="fa fa-chevron-right"></i>
				      </span>
				    </a>
				  </p>
				</div>
     		</div>
     	</div>
     	<!-- Modal Box Info project -->
     	<?= $this->element('Trainings/modal_assets') ?>
     	<?= $this->element('Trainings/modal_add_assets') ?>
     	<?= $this->element('Trainings/modal_info_training') ?>
</section>