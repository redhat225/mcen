<nav class="navbar is-black" style="max-height: 1.25rem !important;">
  <div class="navbar-brand">
    <a class="navbar-item trigger-resizer has-text-oci is-hidden-mobile">
      <span class="icon is-medium">
            <i class="fas fa-bars is-ft-sz-25"></i>
         </span>
    </a>
    <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

  <div id="navbarExampleTransparentExample" class="navbar-menu">
    <div class="navbar-start">
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link has-text-white" href="/documentation/overview/start/">
          Administration
        </a>
        <div class="navbar-dropdown is-boxed">
          <a class="navbar-item" href="/documentation/overview/start/">
            Membres
          </a>
          <a class="navbar-item" href="https://bulma.io/documentation/modifiers/syntax/">
            Ajouter un membre
          </a>
          <a class="navbar-item" href="https://bulma.io/documentation/columns/basics/">
            Formation
          </a>
        </div>
      </div>
    </div>

    <div class="navbar-end">
      <div class="navbar-item has-dropdown is-hoverable" class="account-dropdown">
        <a class="navbar-link has-text-intercoton-green" >
          <span class="has-text-weight-semibold has-text-white">{{profile.user_account_username}} &nbsp;</span>
            <figure class="image is-32x32">
                <img src="/img/assets/admins/avatar/{{profile.user_account_avatar}}" alt="" style="max-height:100%; border-radius:50%;">
            </figure>
        </a>

        <div class="navbar-dropdown mcen-green-b">
            <a class="navbar-item" ui-sref="admins.profile.edit" ui-sref-active="is-active">
             <span class="has-text-white">Mon profil</span> 
            </a>
             <a class="navbar-item" href="/admins/logout" target="_self">
             <span class="has-text-white">Déconnexion</span> 
            </a>
        </div>  
      </div>

      <div class="navbar-item">
          <a  class="navbar-item" href="/admins/logout" target="_self">
            <button class="button is-white">
              <span class="icon">
                <i class="fa fa-power-off"></i>
              </span>
              <span class="has-text-semibold">
                Déconnexion
              </span>
            </button>
          </a>
      </div>
    </div>
  </div>
</nav>