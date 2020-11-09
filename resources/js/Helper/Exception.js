import User from '../Helper/User'

class Exception{
    handle(error){
        this.isExpired(error.response.data.error)
    }
    isExpired(error){
        if (error == 'Token is Expired' || 'Token is Invalid' ) {
            User.logout()
        }
    }
}

export default Exception = new Exception()