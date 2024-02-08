<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">LibX</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="form-inline my-2 my-lg-0 mr-auto">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    <ul class="navbar-nav ">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Novo Post <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            Eu
                            </a>
                            <div class="dropdown-menu">
                                <router-link class="dropdown-item" :to="{ name: 'index' }">Meu Perfil</router-link>
                                <router-link class="dropdown-item" :to="{ name: 'index' }">Sair</router-link>
                            </div>
                        </li>
                    </ul>                    
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'NavbarComponent'
}
</script>

<style lang="scss" scoped>

</style>