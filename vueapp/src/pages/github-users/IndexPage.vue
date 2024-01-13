<template>

    <TabsComponent :tabs_title="['No GitHub', 'Importados']">
        <template v-slot:tab0>
            <GithubUsersList></GithubUsersList>
        </template>
        <template v-slot:tab1>
            <ImportedUsersList></ImportedUsersList>
        </template>
    </TabsComponent>

</template>
<script setup>
    import TabsComponent from '../../components/TabsComponent.vue';
    import GithubUsersList from './GithubUsersList.vue';
    import ImportedUsersList from './ImportedUsersList.vue';

</script>