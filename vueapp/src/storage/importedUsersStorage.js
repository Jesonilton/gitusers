import { defineStore } from 'pinia'

export const importedUsersStorage = defineStore('imported_users', {
  state: () => ({ users: [] }),
  getters: {
    hasUsers() {
        return this.users.length > 0;
    }
  },
  actions: {
    setUsers(users) {
      this.users = users;
    }
  },
})