import { Injectable } from '@angular/core';
import {Http, Headers} from '@angular/http';
import {Observable, of, BehaviorSubject} from 'rxjs';
import { map, catchError} from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
   
  /* apiRoot for use with xamp */
  apiRoot: string ="http://localhost/AldeaApp/GenericFrontAngular/src/fakeDB";

 
  private isLoggin  = new BehaviorSubject<boolean>(false);
  currentLoggin = this.isLoggin.asObservable();

  constructor(private http: Http) {
  }

  userAuthentication(jsonLogin) {
    let headers: Headers = new Headers();
    headers.append('Authorization','false');
    headers.append('Content-Type', 'application/json');   
    // return this.http.post(`${this.apiRoot}/auth/login_check`,jsonLogin,{headers:headers}).pipe(
    return this.http.post(`${this.apiRoot}/auth.json`,jsonLogin,{headers:headers}).pipe(
      map(res => { 
        return res.json()
      })
    );
  }

  loggedIn(): Observable<boolean> {
    const token = localStorage.getItem('userToken');
    if (token) {
          let headers: Headers = new Headers();
          headers.append('Content-Type', 'application/json');
          headers.append("Authorization", "Bearer " + localStorage.getItem('userToken'));

        const httpOptions = {
            headers
        };

          // return this.http.get(`${this.apiRoot}/auth/isAuthenticated`, httpOptions)
      return this.http.get(`${this.apiRoot}/isAuthenticated.json`, httpOptions)
        .pipe(map((res)=>{
          return res.status == 200
        }),catchError((e) => {
          return of(false);
      })
        
        );

    }
     return of(false);
}

logout(){
  this.isLogIn(false);
  // this method need go  to server side to logout  
  // return this.http.get(`${this.apiRoot}/api/logout`)
  
}

/*Este metodo es para que todas las paginas consuman si esta logeado*/
isLogIn(login: boolean){
  this.isLoggin.next(login);
}


}
