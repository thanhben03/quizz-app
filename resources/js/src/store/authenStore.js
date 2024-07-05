import { defineStore } from 'pinia'

export const authenStore = defineStore('authen', {
    state: () => {
        return {
            authenticated: window.localStorage.getItem('user') ? true : false,
            user: {

            }
        }
    },
    actions: {
        onSetAuthenticated(newState) {
            this.authenticated = newState
        },
        onSetUser(user) {
            this.user = user;
        },
    }

})
