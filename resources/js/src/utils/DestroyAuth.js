import { authenStore } from "../store/authenStore";

export default function DestroyAuth () {
    const auth = authenStore();
    console.log('destroy auth');
    auth.onSetAuthenticated(false);
    auth.onSetUser({});
    window.localStorage.removeItem('user');
}
