import { defineStore } from 'pinia'

export const studentStore = defineStore('student', {
    state: () => {
        return {
            students: [

            ]
        }
    },
    // state: () => ({
    //     authenticated: false,
    //     token: window.sessionStorage.getItem('token') ? window.sessionStorage.getItem('token') : '',
    //     user: useLocalStorage('user', null)
    // }),

    actions: {
        onSetStudent(students) {
            this.students = students;
        }
    }

})
