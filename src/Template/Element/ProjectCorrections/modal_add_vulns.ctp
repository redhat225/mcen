<div class="modal {{modal_add_vuln}}" >
  <div class="modal-background" ng-click="hide_vuln_box()"></div>
  <div class="modal-card" style="width: 70%;">
    <header class="modal-card-head is-radiusless oci-orange-b">
      <p class="modal-card-title has-text-white">Ajouter une vulnérabilité</p>
      <button class="delete" aria-label="close" type="button" ng-click="hide_vuln_box()"></button>
    </header>
    <section class="modal-card-body is-pad-bot-100">
      <form ng-submit="loop">
        <div class="field is-horizontal">
          <div class="field-label">
            <label for="" class="label">Recherche</label>
          </div>
          <div class="field-body">
            <div class="field">
                  <div class="dropdown is-hoverable" style="display: block !important;">
                    <div class="dropdown-trigger">
                       <div class="control is-expanded">
                          <input ng-model="vuln_filter" type="text" style="width: 100%;" aria-haspopup="true" aria-controls="dropdown-menu">
                       </div>
                    </div>
                    <div class="dropdown-menu" id="dropdown-menu" role="menu" style="width: 100%;">
                      <div class="dropdown-content">
                        <a href="#" ng-repeat="vuln in vulnerabilities | filter: vuln_filter" ng-click="add_vuln(vuln)" class="dropdown-item">
                          <span>{{vuln.vulnerability_denomination}}</span>
                           <span class="icon has-text-oci tooltip is-tooltip-oci is-tooltip-multiline is-tooltip-right" data-tooltip="{{vuln.vulnerability_explicit_denomination}}">
                             <i class="fas fa-info-circle"></i>
                           </span>
                        </a>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="field">
              <button class="button is-oci" ng-click="add_vuln(temp_alert)">
                  <i class="fas fa-plus"></i>
                  <span class="has-text-white">&nbsp;Ajouter</span>
              </button>
            </div>
          </div>
        </div>
      </form>  
    </section>
    <footer class="modal-card-foot is-radiusless">
      <button class="button is-black" ng-click="hide_vuln_box()">Fermer</button>
    </footer>
  </div>
</div>