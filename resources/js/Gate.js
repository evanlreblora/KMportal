export default class Gate {
    constructor(user) {
        this.user = user;
    }

    isAdmin(){
        return this.user.type === 'admin';
    }
    isAdminOrAuthor(){
        return this.user.type === "admin" || this.user.type === "author";
    }

    All(){
        return this.user.type === "admin" || this.user.type === "author" || this.user.type === "user";
    }

    isAuthor(){
        return this.user.type === 'author';
    }

    isUser(){
        return this.user.type === 'user';
    }
}
