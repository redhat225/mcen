<style>
	.loginForm input:focus{
        border-color: #C1872A;
        box-shadow: 0 0 0 0.125em rgba(193, 135, 42, 0.25);
	}
</style>



<div class="columns is-mar-bot-0 is-centered " ng-controller="LoginController as logincontroller">
	<div class="pageloader is-right-to-left {{loading_state}}">
		<div class="columns">
			<div class="column has-text-centered">
					<img src="/img/chartkit/armoirie.png" style="width:10% !important;" alt="">
			</div>
		</div>

		<span class="title">Authentification en cours</span>
	</div>
	 <div class="column is-6">
		<section class="section is-medium ">
						<!-- MCEN Logo -->
						<figure class="image">
							<img src="/img/chartkit/logo-mcen.png" alt="">
						</figure>
						<!-- Form Description -->
						<form ng-submit="logincontroller.login(logincontroller.credentials)" name="loginBlogForm" class="is-pad-top-40">
							<!-- Identifiant -->
							<div class="field">
							  <label class="label has-text-mcen-green">Identifiant</label>
							  <div class="loginForm control has-icons-right has-icons-left">
							    <input class="input" name='username' required ng-model="logincontroller.credentials.user_account_username" type="text" ng-minlength="6" ng-maxlength="20" placeholder="Identifiant">
								 	<span class="icon is-small is-left">
								 		<i class="fas fa-address-card"></i>
								 	</span>
								    <span ng-if="loginBlogForm.username.$valid" class="icon is-small is-right">
								      <i class="fa fa-check has-text-success"></i>
								    </span>
							  </div>
							</div>
							<!-- Mot de passe -->
							<div class="field">
							  <label class="label has-text-mcen-green">Mot de Passe</label>
							  <div class="loginForm control has-icons-left has-icons-right">
							    <input class="input" name="password" required ng-minlength="8" ng-maxlength="20" ng-model="logincontroller.credentials.user_account_password" type="password" placeholder="Mot de passe">
							    <span class="icon is-small is-left">
							    	<i class="fa fa-lock" aria-hidden="true"></i>
							    </span>
							    <span ng-if="loginBlogForm.password.$valid" class="icon is-small is-right">
								      <i class="fa fa-check has-text-success"></i>
								</span>
							  </div>
							</div>
							
							<div class="field is-horizontal is-pad-top-25">
									<div class="field-body">
										<div class="field">
											<p class="control">
						                          <button ng-disabled="loginBlogForm.$invalid || logincontroller.is_authenticating" class="button is-fullwidth is-mcen-green {{logincontroller.isSubmitting}}" type="submit">
						                                <span class="has-text-weight-bold">Connexion</span>
						                          </button>
											</p>
										</div>
										<div class="field">
											<p class="control">
		                   						<a href="/admins/register" target="_self" class="button has-text-weight-bold is-mcen-grey is-fullwidth" ng-click="logincontroller.forgotpassword()">S'inscrire</a>
											</p>
										</div>
									</div>
							</div>
						</form>
		</section>
		</div>

</div>

