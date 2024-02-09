<template>
    <div>
        <nav class="navbar navbar-light bg-light menu-superior">
            <div class="container">
                <a class="navbar-brand" href="#">LibX</a>
                <div class="navbar-nav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{ name: 'login' }">Acessar</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <div class="destaque">
                        <h4 class="text-primary text-center">Compartilhe atualizações
                        pessoais, projetos, ideias e curiosidades sobre liberalismo econômico!</h4>
                        <p class="mt-4">
                            "Liberalismo econômico é uma doutrina econômica que surgiu durante o século XVIII na Europa. Tendo como um de seus precursores o filósofo e economista escocês Adam Smith (1723-1790), o liberalismo econômico defende a não intervenção do Estado nas atividades econômicas, a autorregulação do mercado e a livre concorrência. Predominante durante todo o século XIX, o liberalismo econômico entrou em declínio com a Grande Depressão, como ficou conhecida a Crise de 1929."
                        </p>
                    </div>
                </div>
                <div class="col">
                    <p class="text-center">Ainda não faz parte do LibX? <br>Favor realizar o cadastro abaixo</p>
                    <div class="card">
                        <div class="card-body">
                            <form @submit.prevent="hundleSubmit">
                                <AlertError v-if="error" :error="error" />
                                <!-- <div v-if="error" class="alert alert-danger">
                                    {{ error }}
                                </div> -->
                                <div class="mb-3">
                                    <input type="text" class="form-control" v-model="name" name="name" placeholder="Nome">
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" v-model="email" name="email" placeholder="E-mail">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" v-model="password" name="password" placeholder="Senha">
                                </div>
                                <button class="btn btn-primary">Me inscrever</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "IndexComponent",
    data() {
        return {
            name: '',
            email: '',
            password: '',
            error: ''
        }
    },
    methods: {
        async hundleSubmit() {

            try {
                await axios.post('users', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                });                
            } catch (error) {
                console.error(error);
                this.error = 'Ocorreu um error';
            }
        }
    }
}
</script>

<style lang="scss" src="./style.scss" scoped></style>