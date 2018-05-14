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
			    <li class="is-active"><a >Comptes Utilisateur</a></li>
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
				<button class="button is-mcen-green" ui-sref="admins.accounts.create">
					<span class="icon">
						<i class="fa fa-plus"></i>
					</span>
					<span>Créer un utilisateur</span>
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
							<th class="has-text-mcen-yellow">Photo</th>
							<th class="has-text-mcen-yellow">Nom Complet</th>
							<th class="has-text-mcen-yellow">Poste</th>
							<th class="has-text-mcen-yellow">Role</th>
							<th class="has-text-mcen-yellow">Création</th>
							<th class="has-text-mcen-yellow">Dernière Modification</th>
							<th class="has-text-mcen-yellow">Informations</th>
							<th class="has-text-mcen-yellow">Action</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="user in users | filter:filter_keys" ng-class="set_cooperative_state(cooperative.deleted)" class="">
							<td>
								<figure>
									<img width="100px" ng-src="/img/assets/admins/photo/{{user.user_photo}}" alt="">
								</figure>
							</td>
							<td>{{user.user_fullname}}</td>
							<td>{{user.user_job}}</td>
							<td>{{user.user_accounts[0].role.role_denomination}}</td>
							<td>{{user.user_accounts[0].created | date:'dd/MM/yyyy HH:mm:ss' }}</td>
							<td>{{user.user_accounts[0].modified | date:'dd/MM/yyyy HH:mm:ss' }}</td>
							<td>
								<button class="button is-oci is-outlined" ng-click='openViewModal(user)'>
									<span class="icon">
										<i class="fas fa-info"></i>
									</span>
									<span>
										voir les infos
									</span>
								</button>
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
													 <a ui-sref="admins.accounts.edit({user_id:user.id})" class="dropdown-item">
											            	Modifier utilisateur
													 </a>
													 <a class="dropdown-item" ng-click="lock_user_account_trigger(user.user_accounts[0].id, user.user_accounts[0])" ng-if="user.user_accounts[0].user_account_is_active==true">
											            	Verrouiller utilisateur
													 </a>
													 </a>
													 <a ng-click="lock_user_account_trigger(user.user_accounts[0].id, user.user_accounts[0])" ng-if="user.user_accounts[0].user_account_is_active==false" class="dropdown-item">
											            	Déverrouiller utilisateur
													 </a>
													 <a ng-click="reinit_passsword(user.user_accounts[0].id)"  class="dropdown-item">
											            	Réinitialiser mot de passe
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
     	<?= $this->element('Accounts/modal_more_account') ?>
</section>
