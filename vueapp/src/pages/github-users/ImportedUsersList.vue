<template>
    <div class="row d-flex justify-content-between">
        <SearchInput v-model="filterUserTerm" @input="filterUsers"></SearchInput>

        <template v-for="(user, index) in gitHubUsers" :key="index">
            <div class="col-lg-12 mb-2" v-if="user.already_imported">
                <ProfileCard @handle-delete="deleteUser" :hide_import_action="true" :hide_delete_action="false" :user_id="user.id" :avatar_url="user.avatar_url" :name="user.name" :login="user.login" :total_repositories="user.total_repositories" :total_followers="user.total_followers" :total_following="user.total_following"></ProfileCard>
            </div>
        </template>
        
        <template v-if="!gitHubUsers.length">
            <h4 class="text-center text-muted pt-2">Nenhum usuário encontrado</h4>
        </template>
    </div>
</template>
<script setup>
    import ImportedUsersRequest from '../../requests/ImportedUsersRequest.ts';
    import GitHubUsersRequest from '../../requests/GitHubUsersRequest.ts';
    import {githubUsersStorage} from '../../storage/githubUsersStorage'
    import ProfileCard from '../../components/ProfileCard.vue'
    import SearchInput from '../../components/SearchInput.vue'
    import {alertStorage} from '../../storage/alertStorage'
    import { onMounted, ref } from 'vue'

    const githubUsersRequest = new GitHubUsersRequest();
    const filterUserTerm = ref('');
    const importedUsersRequest = new ImportedUsersRequest();
    const githubUsersStore = githubUsersStorage();
    const gitHubUsers = ref([]);
    const alert = alertStorage();

    function filterUsers() {
        if(!filterUserTerm.value) {
            resetGitHubUsers();
            return;
        }

        gitHubUsers.value = gitHubUsers.value.filter((user) => {
            return user.name.toLowerCase().includes(filterUserTerm.value.toLowerCase()) || user.login.toLowerCase().includes(filterUserTerm.value.toLowerCase());
        })
    }

    async function deleteUser(login) {
        let response = await importedUsersRequest.deleteUser(login);
        alert.showAlert(response.message, response.success? 'success' : 'danger');

        if(response.success) {
            githubUsersStore.setAlreadyImported(login, false);
        }
    }

    async function resetGitHubUsers() {
        gitHubUsers.value = githubUsersStore.users
    }
    
    onMounted(async() => {
        let importedGitHubUsers = await importedUsersRequest.getAll();

        if(!githubUsersStore.users.length) {
            let users = await githubUsersRequest.getAll();
            githubUsersStore.setUsers(users.data);
        }       

        importedGitHubUsers.forEach(user => {
            githubUsersStore.setAlreadyImported(user.login, true);
        });

        gitHubUsers.value = githubUsersStore.users
    })
</script>