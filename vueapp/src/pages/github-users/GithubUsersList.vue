<template>
    <div class="row d-flex justify-content-between">
        <SearchInput v-model="filterUserTerm" @input="filterUsers"></SearchInput>

        <template v-for="(user, index) in gitHubUsers" :key="index">
            <div class="col-lg-12 mb-2" v-if="!user.already_imported">
                <ProfileCard @handle-import="importUser" :user_id="user.id" :avatar_url="user.avatar_url" :name="user.name" :login="user.login" :total_repositories="user.total_repositories" :total_followers="user.total_followers" :total_following="user.total_following"></ProfileCard>
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
    import {alertStorage} from '../../storage/alertStorage'
    import ProfileCard from '../../components/ProfileCard.vue'
    import SearchInput from '../../components/SearchInput.vue'
    import { onMounted, ref } from 'vue'
    import BootstrapAlert from '../../components/BootstrapAlert.vue'

    const importedUsersRequest = new ImportedUsersRequest();
    const filterUserTerm = ref('');
    const githubDevsRequest = new GitHubUsersRequest();
    const githubUsersStore = githubUsersStorage();
    const alert = alertStorage();
    const gitHubUsers = ref([]);

    function filterUsers() {
        if(!filterUserTerm.value) {
            resetUserList();
            return;
        }

        gitHubUsers.value = gitHubUsers.value.filter((user) => {
            return user.name.toLowerCase().includes(filterUserTerm.value.toLowerCase()) || user.login.toLowerCase().includes(filterUserTerm.value.toLowerCase());
        })
    }

    function resetUserList() {
        gitHubUsers.value = githubUsersStore.users;
    }

    async function importUser(login) {
        let response = await importedUsersRequest.importUser(login);
        alert.showAlert(response.message, response.success? 'success' : 'danger');

        if(response.success) {
            githubUsersStore.setAlreadyImported(login, true);
        }
    }

    onMounted(async () => {
        if(!githubUsersStore.users.length) {
            let users = await githubDevsRequest.getAll();
            await githubUsersStore.setUsers(users.data);
        }
        
        gitHubUsers.value = await githubUsersStore.users;
    })
</script>