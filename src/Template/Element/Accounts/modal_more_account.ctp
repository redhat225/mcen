<div class="modal {{openViewModalTrigger}}">
  <div class="modal-background" ng-click="closeViewModalTrigger()"></div>
  <div class="modal-card">
    <header class="modal-card-head is-radiusless mcen-green-b">
      <p class="modal-card-title has-text-white">Informations - {{info_user.user_fullname}}</p>
      <button class="delete" aria-label="close" ng-click="closeViewModalTrigger()"></button>
    </header>
    
    <section class="modal-card-body">
      <article>
          <div class="field is-horizontal">
            <div class="field-label">
              <label for="">
                Contacts
              </label>
            </div>
            <div class="field-body">
              <div class="field">
                 <span class="has-text-weight-semibold"> {{info_user.user_email}}</span> <br>
                 <span class="has-text-weight-semibold">
                    {{info_user.user_contact}}
                 </span> <br>
              </div>
            </div>
          </div>
      </article>
    </section>

    <footer class="modal-card-foot is-radiusless mcen-green-b">
      <button class="button is-black" ng-click="closeViewModalTrigger()">Fermer</button>
    </footer>
  </div>
</div>