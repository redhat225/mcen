<section ui-view ng-controller="RegisterController as regctrl">



<div class="columns is-centered">
	<div class="pageloader is-right-to-left {{loading_state}}">
		<div class="columns">
			<div class="column has-text-centered">
					<img src="/img/chartkit/armoirie.png" style="width:10% !important;" alt="">
			</div>
		</div>

		<span class="title">Enregistrement en cours</span>
	</div>
	<div class="column is-8">
		<!-- Logo -->
		<div class="column has-text-left">
				<img src="/img/chartkit/logo-mcen.png" width="70%" width="" alt="">
		</div>
		<div class="is-radiusless is-shadowless">
	<div class="section is-small is-pad-top-0">
		<div class="level">
			<div class="level-left">
				<h3 class="level-item is-size-4 has-text-weight-semibold">
					Formulaire inscription auditeur
				</h3>
			</div>
		</div>
		<form name="createuserForm" ng-submit="upload(user)">
			<h3 class="subtitle has-text-weight-semibold">
				Informations personnelles
			</h3>
			<!-- Nom complet -->
			<div class="field is-horizontal">
				<div class="field-label is-normal">
						<label class="label">Nom Complet*</label>
				</div>
				<div class="field-body">
					<div class="field">
						<p class="control is-expanded has-icons-left has-icons-right">
							<input type="text" ng-minlength="5" required ng-maxlength="300" ng-model="user.user_fullname" ng-pattern='/^[^@&()"!_$*€£`+=\/;?#]+$/' name="user_fullname" ng-class="analyze(createuserForm.user_fullname.$valid,createuserForm.user_fullname.$pristine)" class="input is-uppercase" placeholder="ex: RIEHL Emmanuel">
							<span class="icon is-small is-left">
								<i class="fas fa-user"></i>
							</span>

							<span class="icon is-right is-small" ng-if="createuserForm.user_fullname.$valid">
								<i class="fa fa-check has-text-success" aria-hidden="true"></i>
							</span>

						</p>
						<p class="help is-error" ng-if="createuserForm.user_title.$invalid">
							<span>
								le nom est obligatoire et comprend entre 10 et 300 caractères
							</span> <br>
							<span>
								les caractères suivants ne sont pas autorisés <code>@&amp;()"!_$*€£`+=\/;?#</code>
							</span>
						</p>
					</div>
				</div>
			</div>
			<!-- Sexe -->
			<div class="field is-horizontal">
				<div class="field-label is-normal">
					<label class="label">Sexe*</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left">
							<div class="select" ng-init="user.user_sexe = 'H'">
								<select name="user_sexe" ng-model="user.user_sexe" required>
									<option value="H">Homme</option>
									<option value="F">Femme</option>
								</select>
							</div>
							<div class="icon is-small is-left">
								<i class="fa fa-transgender"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Contact -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Contact*</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right is-expanded">
							<input name="user_contact" type="text" ng-model="user.user_contact" required type="number" ng-pattern="/^[0-9]{8}$/" class="input" placeholder="ex: 08080808">
							<span class="icon is-small is-left">
								<i class="fas fa-phone"></i>
							</span>
							<span class="icon is-small is-right" ng-if="createuserForm.user_contact.$valid">
								<i class="fa fa-check has-text-success"></i>
							</span>
						</div>
					</div>

				</div>
			</div>
			<!-- email pro -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Email Professionnel*</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right is-expanded">
							<input name="user_personal_email" ng-model="user.user_personal_email" type="email" class="input" required placeholder="ex: riehlemm@gmail.com">
							<span class="icon is-small is-left">
								<i class="far fa-envelope"></i>
							</span>
							<span class="icon is-small is-right" ng-if="createuserForm.user_personal_email.$valid">
								<i class="fa fa-check has-text-success"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- email -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Email Personnel*</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right is-expanded">
							<input name="user_pro_email" ng-model="user.user_pro_email" type="email" class="input" required placeholder="ex: riehlemm@gmail.com">
							<span class="icon is-small is-left">
								<i class="far fa-envelope"></i>
							</span>
							<span class="icon is-small is-right" ng-if="createuserForm.user_pro_email.$valid">
								<i class="fa fa-check has-text-success"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- Job -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Intitulé Poste*</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right is-expanded">
							<input name="user_job" ng-model="user.user_job" type="text" class="input" required placeholder="ex: Ingénieur Security By Design">
							<span class="icon is-small is-left">
								<i class="fas fa-briefcase"></i>
							</span>
							<span class="icon is-small is-right" ng-if="createuserForm.user_job.$valid">
								<i class="fa fa-check has-text-success"></i>
							</span>
						</div>
					</div>
				</div>
			</div>
			<!-- Photo -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Photo</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div required ng-if="!user.user_photo_candidate" class="button is-mar-bot-30" ngf-select ng-model="user.user_photo_candidate" name="cover" ngf-pattern="'image/*'" ngf-accept="'image/*'" ngf-max-size="3MB" ng-min-height="200" ngf-min-width="200">Sélectionner</div>

						<div class="image-preview">
							<figure class="image" style="max-width: 200px;">
								<img ngf-thumbnail="user.user_photo_candidate || '/img/assets/forms/image_upload_drag_area.png'">
							</figure>

						</div>
					
						<div ng-if="user.user_photo_candidate" class="button is-vne-orange is-outlined is-mar-top-30" ng-click="user.user_photo_candidate=''">
							Effacer
						</div>

						<p class="help" ng-if="createuserForm.cover.$invalid">
							la photo est obligatoire, représente une image (jpeg, jpg, bitmap, png) et la taille ne doit pas être supérieure à 3MB 
						</p>
					</div>
				</div> 
			</div>

			<h3 class="subtitle has-text-weight-semibold">Informations de compte</h3>
			<!-- Username -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Nom Utilisateur</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<input name="account_username" class="input" type="text" ng-model="user.account.user_account_username" required ng-pattern='/^[^@&()"!_$*€£`+=\/;?#]+$/' placeholder="ex: Remmanuel225">
							<span class="icon is-small is-left">
								<i class="fa fa-user"></i>
							</span>
							<span class="icon is-small is-right" ng-if="createuserForm.account_username.$valid">
								<i class="fa fa-check has-text-success"></i>
							</span>
						</div>

					</div>
				</div>
			</div>
			<!-- Avatar -->
				<div class="field is-horizontal">
					<div class="field-label">
						<label for="" class="label">Avatar (optionnel)</label>
					</div>
					<div class="field-body">
							<div class="field">
								<div ng-if="!user.account.user_account_avatar_candidate" class="button is-mar-bot-30" ngf-select ng-model="user.account.user_account_avatar_candidate" name="user_account_avatar_candidate" ngf-pattern="'image/*'" ngf-accept="'image/*'" ngf-max-size="3MB" ng-min-height="200" ngf-min-width="200">Sélectionner</div>

								<div class="image-preview">
									<figure class="image" style="max-width: 200px;">
										<img ngf-thumbnail="user.account.user_account_avatar_candidate || '/img/assets/forms/image_upload_drag_area.png'">
									</figure>

								</div>
							
								<div ng-if="user.account.user_account_avatar_candidate" class="button is-vne-orange is-outlined is-mar-top-30" ng-click="user.account.user_account_avatar_candidate=''">
									Effacer
								</div>
								<p class="help" ng-if="createuserFormaccount.user_account_avatar_candidate.$invalid">
									l'image d'avatar n'est pas obligatoire, représente une image (jpeg, jpg, bitmap, png) et la taille ne doit pas être supérieure à 3MB 
								</p>
							</div>
					  </div> 
				</div>
	
			<!-- Password -->
			<div class="field is-horizontal">
				<div class="field-label">
					<label for="" class="label">Mot de Passe</label>
				</div>
				<div class="field-body">
					<div class="field">
						<div class="control has-icons-left has-icons-right">
							<input ng-maxlength="20" class="input" name="user_account_password" type="password" ng-model="user.account.user_account_password" required ng-pattern='/(?=.*[A-Z]+.*)(?=.*[0-9]+.*)(?=.*[a-z]+.*)(?=.*[!@#$&*]+.*)/'>
							<span class="icon is-small is-left">
								<i class="fa fa-lock"></i>
							</span>
							<span class="icon is-small is-right" ng-if="createuserForm.user_account_password.$valid">
								<i class="fa fa-check has-text-success"></i>
							</span>
							<p class="help" ng-if="createuserForm.user_account_password.$invalid">
								Il est impératif de définir un mot de passe contenant au moins une lettre majuscule, un/plusieurs nombres,un caractère spécial, ainsi qu'une/plusieurs lettres minuscules.
							</p>
							<p class="help" ng-if="createuserForm.user_account_password.$error.maxlength">
								Le mot de passe ne doit pas dépasser 20 caractères
							</p>
						</div>

					</div>
				</div>
			</div>

			<!-- Buttons controls -->
			<div class="field is-grouped is-pad-top-10">
				<div class="field-label">
					<label for="" class="label"></label>
				</div>
				<div class="field-body">
				  <p class="control is-mar-rgt-30">
				    <button type="submit" ng-disabled="createuserForm.$invalid || is_loading=='is-loading'" class="button is-mcen-green" ng-class="{{is_loading}}">
				      S'inscrire
				    </button>
				  </p>
				  <p class="control">
				    <a target="_self" href="/admins/login" type="reset" class="button is-black">
				      Annuler
				    </a>
				  </p>
				</div>
			</div>
		</form>
	</div>
</div>
	</div>
</div>

</section>

