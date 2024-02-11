<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <router-link class="navbar-brand" :to="{ path: '/principal/' }">LibX</router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="form-inline my-2 my-lg-0 mr-auto">
                        
                    </form>
                    <ul class="navbar-nav ">
                        <li class="nav-item active">
                            <router-link class="nav-link" :to="{ path: '/principal/' }">
                                <i class="fa-solid fa-house"></i> Início 
                            </router-link>
                        </li>
                        <li class="nav-item active">
                            <router-link class="nav-link" :to="{ name: 'posts' }">
                                <i class="fa-solid fa-signs-post"></i> Meus Post 
                            </router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i> {{ user ? user.name : '' }}
                            </a>
                            <div class="dropdown-menu">
                                <router-link class="dropdown-item" :to="{ name: 'meus-dados' }">
                                    <i class="fa-solid fa-gear"></i> Meus Dados 
                                </router-link>
                                
                                <a class="dropdown-item" href="javascript:void(0)" @click.prevent="logout"><i class="fa fa-sign-out-alt"></i> Sair </a>
                            </div>
                        </li>
                    </ul>                    
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import axios from 'axios';
import { mapGetters } from 'vuex';

export default {
    name: 'NavbarComponent',
    computed: {
    ...mapGetters(['user', 'isLogged'])
    },
    methods: {
        async logout() {
            
            try {                
                await axios.get("logout", {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
                });
                
                localStorage.removeItem("token");

                this.$store.dispatch("user", {});
                localStorage.setItem("isLogged", false);
    
                this.$router.push({ name: 'login' });
            } catch (error) {
                this.forcarLogout()
            }
        },
        forcarLogout() {
            this.$swal("Algo aconteceu. Você foi deslogado. Caso queira continuar, favor efetuar login.");
            localStorage.removeItem("token");
            this.$store.dispatch("user", {});
            localStorage.setItem("isLogged", false);
            this.$router.push({ name: "login" });
        }
    }
    
}
</script>

<style lang="scss" scoped>

</style>