export default{
    delete(user , model){
        return user.id === model.user_id;
    }
    
}