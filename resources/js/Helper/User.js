import Token from './Token'
import AppStorage from './AppStorage'
class User{

    login(form){
        axios.post('/api/auth/login', form)
            //.then(res => console.log(res.data))
            .then(res => this.responseAfterLogin(res))
            .catch(err => console.log(err.response.data))
    }


    responseAfterLogin(res){
        const token = res.data.access_token;
        const username = res.data.username;
        if (Token.isValid(token)) {
            AppStorage.store(username,token);
            window.location = '/forum';
        }
    }

    hasToken(){
        const storedToken = AppStorage.getToken();
        if (storedToken) {
            return Token.isValid(storedToken) ? true : this.logout();
        }
        return false;
    }

    loggedIn(){
        return this.hasToken();
    }
    
    logout(){
        AppStorage.clear()
    }

    name(){
        if (this.loggedIn()) {
            return AppStorage.getUser();
        }
    }

    id(){
        if (this.loggedIn()) {            
            const payload = Token.payload(AppStorage.getToken());
            return payload.sub;
        }
    }

    own(id){
        return this.id() == id ? true : false 
    }
    
    isAdmin(){
        return this.id() == 36 ? true : false;
    }
}

export default User = new User()