<template>
    <div>
        <div class="row d-flex justify-content-center">
            <div class="col col-lg-9 col-xl-8">
                <div class="card">
                    <div class="rounded-top text-white d-flex flex-row" style="background-color: #007bff; height:200px;">
                        <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                            <img :src="user.avatar_url" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
                            <a type="button" target="_blank" :href="`https://github.com/${user.login}`" class="btn btn-outline-dark" data-mdb-ripple-color="dark" style="z-index: 1;">
                                Ver no GitHub
                            </a>
                        </div>
                        <div class="ms-3" style="margin-top: 130px;">
                            <h5>{{ user.name }}</h5>
                            <p>{{ user.location }}</p>
                        </div>
                    </div>
                    <div class="p-4 text-black" style="background-color: #f8f9fa;">
                        <div class="d-flex justify-content-end text-center py-1">
                            <div>
                                <p class="mb-1 h5">{{ user.public_repos }}</p>
                                <p class="small text-muted mb-0">Repositórios</p>
                            </div>
                            <div class="px-3">
                                <p class="mb-1 h5">{{ user.followers }}</p>
                                <p class="small text-muted mb-0">Seguidores</p>
                            </div>
                            <div>
                                <p class="mb-1 h5">{{ user.following }}</p>
                                <p class="small text-muted mb-0">Seguindo</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4 text-black">
                        <div class="mb-5">
                            <p class="lead fw-normal mb-1">Sobre</p>
                            <div class="p-4" style="background-color: #f8f9fa;">
                                <p class="font-italic mb-0">{{ user.bio }}</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <p class="lead fw-normal mb-0">Repositórios</p>
                            <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p>
                        </div>
                        <div class="row g-2">
                            <div class="card" style="border-radius: 15px;" v-for="repository in userRepositories">
                                <div class="card-body p-4">
                                    <h3 class="mb-3"><a :href="repository.html_url" style="text-decoration: none;">{{ repository.name }}</a></h3>
                                    <p class="small mb-0"><i class="fas fa-star fa-lg text-warning"></i> {{ repository.visibility }}
                                        <span class="mx-2">|</span> Ultima atualização: {{ formatarData(repository.updated_at) }}</p>
                                    <hr class="my-4">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <a :href="repository.html_url" target="_blank">
                                            <img src="../../assets/img/github.png" alt="avatar" class="img-fluid rounded-circle me-3" width="35">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { defineProps, ref, onMounted} from 'vue'

    import GitHubUsersRequest from '../../requests/GitHubUsersRequest.ts';

    const githubDevsRequest = new GitHubUsersRequest();
    const user = ref({});
    const userRepositories = ref([]);

    const props = defineProps({
        login: String,
    });

    function formatarData(data) {
        data = new Date(data);
        const dia = String(data.getDate()).padStart(2, '0');
        const mes = String(data.getMonth() + 1).padStart(2, '0'); // O mês começa de zero, então adicionamos 1
        const ano = data.getFullYear();

        return `${dia}/${mes}/${ano}`;
    }

    onMounted(async() => { 
        user.value = await githubDevsRequest.findUser(props.login);
        userRepositories.value = await githubDevsRequest.getUserRepositories(props.login);

        console.log(userRepositories.value);
    });
</script>