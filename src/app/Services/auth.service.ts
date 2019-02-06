import { Injectable } from '@angular/core';
import {Http, URLSearchParams, Headers, RequestOptions} from '@angular/http';
import {Observable, of, BehaviorSubject} from 'rxjs';
import { map, catchError} from 'rxjs/operators';
import {User} from '../Model/User';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  //asi deberia ser en produccion 

  //apiRoot: string ="http://localhost/AldeaApp/GenericRestSymphony/public/index.php" ;
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


  // getUsers(): Observable<User[]> {
  //   let apiURL = `${this.apiRoot}/user/`;
  //   return this.http
  //   .get(apiURL)
  //     .pipe(
  //       map(res => {
  //         return res.json().map(item => {
  //           return new User(
  //               item.firstName,
  //               item.lastName,
  //               item.email,
  //               item.username
  //           );
  //         });
  //       }),
  //       catchError(
  //         err =>
  //          of( "error en el listado de usuarios" )
  //         ),
  //      )   
  // }

  
  // newUser(term):Observable<User>{
  //   let apiURL = `${this.apiRoot}/api/user`;
  //   let headers: Headers = new Headers();
  //   headers.append('Authorization','false');
  //   let opts: RequestOptions = new RequestOptions();
  //   opts.headers = headers;
  //   opts.search = term;

  //   return this.http
  //   .post(apiURL,opts)
  //     .pipe(
  //       map(res => {
  //         /*esto es porque solo se retorna un solo elemento*/
  //         return new User(
  //           res.json().firstName,
  //           res.json().lastName,
  //           res.json().email,
  //           res.json().username
  //         )         
  //       })
  //     )
  // }


}
