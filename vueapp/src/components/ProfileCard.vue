<template>
    <div class="card-body p-4">
        <div class="d-flex text-black">
            <div class="flex-shrink-0">
                <router-link :to="`/github-users/${login}`" title="Ver Perfil">
                    <img :src="avatar_url" alt="User image" class="img-fluid" style="width: 180px; border-radius: 10px;">
                </router-link>
            </div>
            <div class="flex-grow-1 ms-3">
                <router-link :to="`/github-users/${login}`" title="Ver Perfil" class="nav-item nav-link"><h5 class="mb-1 text-left text-uppercase" style="font-weight: 500;">{{ name }}</h5></router-link>
                <p class="mb-2 pb-1 text-left" style="color: #2b2a2a;"><a class="mb-4" target="_blank" :href="`https://github.com/${login}`">{{ login }}</a></p>
                <div class="d-flex justify-content-around text-center rounded-3 p-2 mb-2" style="background-color: #efefef;">
                    <div>
                        <p class="small text-muted mb-1">Repositories</p>
                        <p class="mb-0">{{ total_repositories }}</p>
                    </div>
                    <div class="px-3">
                        <p class="small text-muted mb-1">Seguidores</p>
                        <p class="mb-0">{{ total_followers }}</p>
                    </div>
                    <div>
                        <p class="small text-muted mb-1">Seguindo</p>
                        <p class="mb-0">{{ total_following }}</p>
                    </div>
                </div>
                <div class="d-flex pt-1">
                    <button v-if="!hide_import_action" type="button" @click="$emit('handleImport', login)" class="btn btn-primary flex-grow-1">Importar</button>
                    <button v-if="!hide_delete_action" type="button" @click="$emit('handleDelete', login)" class="btn btn-danger flex-grow-1">Deletar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { defineProps} from 'vue'
    
    const props = defineProps({
                        user_id: Number,
                        avatar_url: String,
                        name: String,
                        login: String,
                        total_repositories: Number,
                        total_followers: Number,
                        total_following: Number,
                        hide_import_action: Boolean,
                        hide_delete_action: {
                            type: Boolean,
                            default: true 
                        }
                    });
</script>