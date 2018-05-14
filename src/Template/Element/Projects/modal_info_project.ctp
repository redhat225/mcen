<div class="modal {{openViewModalTrigger}}">
  <div class="modal-background" ng-click="closeViewModalTrigger()"></div>
  <div class="modal-card">
    <header class="modal-card-head is-radiusless oci-orange-b">
      <p class="modal-card-title has-text-white">Informations - {{info_project.project_fullname}}</p>
      <button class="delete" aria-label="close" ng-click="closeViewModalTrigger()"></button>
    </header>
    <section class="modal-card-body">
      <article>
          <div class="field is-horizontal">
            <div class="field-label">
              <label for="">
                Créateur
              </label>
            </div>
            <div class="field-body">
              <div class="field">
                 <span class="has-text-weight-semibold"> {{info_project.user_account.user.user_fullname}}</span> <br>
                 <span class="has-text-weight-semibold">
                   {{info_project.user_account.user.user_job}}
                 </span>
              </div>
            </div>
          </div>
      </article>
      <br>
      <article>
          <div class="field is-horizontal">
            <div class="field-label">
              <label for="">
                Type Projet
              </label>
            </div>
            <div class="field-body">
              <div class="field">
                 <span class="has-text-weight-semibold"> {{info_project.project_type.project_type_denomination}}</span>
              </div>
            </div>
          </div>
      </article>
      <br>
      <article>
          <div class="field is-horizontal">
            <div class="field-label">
              <label for="">
                Contributeurs
              </label>
            </div>
            <div class="field-body">
              <div class="field">
                 <div ng-repeat="contributor in info_project.project_contributors">
                    <span class="has-text-weight-semibold">
                      {{contributor.user_account.user.user_fullname}}
                    </span> <br>
                    <span class="has-text-weight-semibold">
                      {{contributor.user_account.user.user_job}}
                    </span> <br>
                    rôle: <span class="has-text-weight-semibold">
                      {{contributor.project_contributor_role.role_denomination}}
                    </span>
                 </div>
              </div>
            </div>
          </div>
      </article>
      <br>
      <article>
          <div class="field is-horizontal">
            <div class="field-label">
              <label for="">
                Indices projet
              </label>
            </div>
            <div class="field-body">
              <div class="field">
                Exposition Franchise
              </div>
              <div class="field">
                <p class="has-text-right">
                   <span ng-if="info_project.project_indices.project_is_franchise_exposed=='true'" class="has-text-weight-semibold">Oui</span>
                   <span ng-if="info_project.project_indices.project_is_franchise_exposed=='false'" class="has-text-weight-semibold">Non</span>                   
                </p>
               
              </div>
            </div>
          </div>
      </article>

      <article>
          <div class="field is-horizontal">
            <div class="field-label">
              <label for="">
                &nbsp;
              </label>
            </div>
            <div class="field-body">
              <div class="field">
                Service OCI et filiales?
              </div>
              <div class="field">
                <p class="has-text-right">
                    <span ng-if="info_project.project_indices.project_is_for_oci_and_subs=='true'" class="has-text-weight-semibold">Oui</span>
                    <span ng-if="info_project.project_indices.project_is_for_oci_and_subs=='false'" class="has-text-weight-semibold">Non</span> 
                </p>
               
              </div>
            </div>
          </div>
      </article>
    <br>



      <article>
          <div class="field is-horizontal">
            <div class="field-label">
              <label for="">
                &nbsp;
              </label>
            </div>
            <div class="field-body">
              <div class="field">
                Centralisation de données client?
              </div>
              <div class="field">
                <p class="has-text-right">
                    <span ng-if="info_project.project_indices.project_is_client_data_centralized=='true'" class="has-text-weight-semibold">Oui</span>
                    <span ng-if="info_project.project_indices.project_is_client_data_centralized=='false'" class="has-text-weight-semibold">Non</span>
                </p>
              </div>
            </div>
          </div>
      </article>
  <br>
      <article>
          <div class="field is-horizontal">
            <div class="field-label">
              <label for="">
                &nbsp;
              </label>
            </div>
            <div class="field-body">
              <div class="field">
                Connectivité Internet
              </div>
              <div class="field">
                <p class="has-text-right">
                   <span ng-if="info_project.project_indices.project_is_internet_connected=='true'" class="has-text-weight-semibold">Oui</span>
                   <span ng-if="info_project.project_indices.project_is_internet_connected=='false'" class="has-text-weight-semibold">Non</span>
                </p>
              </div>
            </div>
          </div>
      </article>
      <br>
      <article>
          <div class="field is-horizontal">
            <div class="field-label">
              <label for="">
                &nbsp;
              </label>
            </div>
            <div class="field-body">
              <div class="field">
                Connexions Tierces
              </div>
              <div class="field">
               <p class="has-text-right">
                  <span ng-if="info_project.project_indices.project_is_used_third_connexions=='true'" class="has-text-weight-semibold">Oui</span>
                  <span ng-if="info_project.project_indices.project_is_used_third_connexions=='false'" class="has-text-weight-semibold">Non</span>
                </p>
              </div>
            </div>
          </div>
      </article>
      <br>
      <article>
          <div class="field is-horizontal">
            <div class="field-label">
              <label for="">
                &nbsp;
              </label>
            </div>
            <div class="field-body">
              <div class="field">
                Utilisation de données sensibles?
              </div>
              <div class="field">
                <p class="has-text-right">
                   <span ng-if="info_project.project_indices.project_is_used_harmful_data=='true'" class="has-text-weight-semibold">Oui</span>
                   <span ng-if="info_project.project_indices.project_is_used_harmful_data=='false'" class="has-text-weight-semibold">Non</span>
                </p>
              </div>
            </div>
          </div>
      </article>
    </section>


    <footer class="modal-card-foot is-radiusless">
      <button class="button is-black" ng-click="closeViewModalTrigger()">Fermer</button>
    </footer>
  </div>
</div>