<div id="header">
    <div class="container">
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <router-link :to="{ name: 'home'}" class="navbar-item">
                    <img src="https://www.mailerlite.com/assets/logo-color.png">
                </router-link>

                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
                   data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-start">
                    <router-link :to="{ name: 'home'}" class="navbar-item">
                        Home
                    </router-link>

                    <router-link :to="{ name: 'subscribers'}" class="navbar-item">
                        Subscribers
                    </router-link>

                    <router-link :to="{ name: 'fields'}" class="navbar-item">
                        Fields
                    </router-link>
                </div>
            </div>
        </nav>
    </div>
</div>