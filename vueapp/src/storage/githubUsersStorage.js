import { defineStore } from 'pinia'

export const githubUsersStorage = defineStore('github_users', {
  state: () => ({ users: [], hasUsers: false }),
  actions: {
    setUsers(users) {
      this.users = users;
    },
    reset() {
      this.users = [];
      this.hasUsers = false;
    },
    setAlreadyImported(login, situation) {
      this.users.forEach(function(user) {
        if(user.login == login) {
          user.already_imported = situation;
        }
      });
    }
  },
})