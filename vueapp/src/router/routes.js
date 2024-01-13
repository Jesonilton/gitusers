import { createRouter, createWebHistory } from "vue-router";
import HomePage from '../pages/HomePage.vue'

const routes = [
    {
        path: '/',
        name: 'HomePage',
        component: HomePage
    },
    {
        path: '/github-users',
        name: 'GithubUsers',
        component: () => import('../pages/github-users/IndexPage.vue')
    },
    {
        path: '/github-users/:login',
        name: 'UserDetail',
        props: true,
        component: () => import('../pages/github-users/UserDetail.vue'),
    },
    {
        path: '/:catchAll(.*)*',
        component: () => import('../pages/ErrorNotFound.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;