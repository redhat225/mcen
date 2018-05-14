<div class="modal {{modal_add_alert}}">
  <div class="modal-background" ng-click="hide_alert_add_box()"></div>
  <div class="modal-card">
    <header class="modal-card-head is-radiusless oci-orange-b">
      <p class="modal-card-title has-text-white">Ajouter une alerte</p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
      <form ng-submit="loop">
        <div class="field is-horizontal">
          <div class="field-label">
            <label for="" class="label"> description</label>
          </div>
          <div class="field-body">
            <div class="field">
              <textarea class="textarea" ng-model="temp_alert.description"></textarea>
            </div>
            <div class="field">
              <button class="button is-oci" ng-click="add_alert_inscription(temp_alert)">
                  <i class="fas fa-plus"></i>
                  <span class="has-text-white"> Ajouter</span>
              </button>
            </div>
          </div>
        </div>
      </form>  
    </section>
    <footer class="modal-card-foot is-radiusless">
      <button class="button is-black" ng-click="hide_alert_add_box()">Fermer</button>
    </footer>
  </div>
</div>