<div class="modal {{active_failure_project_modal}}">
  <div class="modal-background" ui-sref="admins.projects.view"></div>
  <div class="modal-content">
   	<div class="box">
   		<div class="columns">
	   		<div class="column is-6">
	   			<img src="/img/assets/wangwei/ww.png" width="80%" alt="">
	   		</div>
	   		<div class="column is-6">
	   			 <h3 class="title">Désolé</h3>
	   			 <p>Votre projet n'est pas éligible à un audit du pôle security by Design. Veuillez prendre connaissance de votre ticket projet pour plus d'informations</p>
	   			 <p class="is-mar-top-40">
	   			 	<a class="button is-oci is-outlined" target="_blank" href="/projects/preview/{{ticket_path}}.pdf">
	   			 		Voir la fiche
	   			 	</a>
	   			 	<a ui-sref="admins.projects.view" class="is-black button">
	   			 		Non merci
	   			 	</a>
	   			 </p>
	   		</div>
   		</div>

   	</div>
  </div>
  <button class="modal-close is-large" ui-sref="admins.projects.view" aria-label="close"></button>
</div>