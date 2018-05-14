<section class="ui-view">
			<div class="columns">
				<div class="column">
					<nav class="breadcrumb" aria-label="breadcrumbs">
					  <ul>
					    <li><a ui-sref="admins.dashboard">Dashboard</a></li>
					    <li ui-sref="admins.trainings.all({page_id:1})"><a >Formations</a></li>
					    <li class="is-active"><a >Créer une formation</a></li>
					  </ul>
					</nav>
				</div>
			</div>




	<h3 class="subtitle">Formulaire de création formation</h3>

	<form name="createTrainingForm" ng-submit="create(training)">
		<div class="field is-horizontal" id="main-zone-item">
			<div class="field-label">
				<label for="" class="label">
					Dénomination
				</label>
			</div>
			<div class="field-body">
				<div class="field">
					<div class="control has-icons-left has-icons-right">
						<input type="text" name="training_denomination" class="input is-uppercase" ng-model="training.training_denomination" ng-maxlength="100" required>

						<span class="icon is-small is-left">
							<i class="fa fa-globe"></i>
						</span>
						<span class="icon is-small is-right" ng-show="createTrainingForm.training_denomination.$valid">
							<i class="fa fa-check has-text-intercoton-green"></i>
						</span>
					</div>
				</div>
				
			</div>
		</div>

		<div class="field is-horizontal">
			<div class="field-label">


		<div class="field is-horizontal is-pad-top-20">
			<div class="field-label">
				<label for="" class="label">
					&nbsp;
				</label>
			</div>
			<div class="field-body">
				<div class="field is-grouped">
					<div class="control has-icons-left has-icons-right">
						<button class="button is-mcen-green has-text-weight-bold" ng-disabled="createTrainingForm.$invalid || is_loading" type="submit">Valider</button>
					</div>
					<div class="control">
						<button class="button is-grey has-text-weight-bold" type="reset" ng-click="reset_zones()">Annuler</button>
					</div>
				</div>
			</div>
		</div>

	</form>
</section>