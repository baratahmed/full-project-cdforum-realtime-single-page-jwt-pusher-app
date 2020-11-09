class AppStorage{
    storeToken(token){
        localStorage.setItem('token', token);
    }
    storeUser(user){
        localStorage.setItem('username', user);
    }
    store(user,token){
        this.storeUser(user);
        this.storeToken(token);
    }
    clear(){
        localStorage.removeItem('token');
        localStorage.removeItem('username');
    }
    getToken(){
        return localStorage.getItem('token');
    }
    getUser(){
        return localStorage.getItem('username');
    }
}
export default AppStorage = new AppStorage();