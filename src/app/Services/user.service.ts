import { Injectable } from '@angular/core';
import {Http,Headers, RequestOptions} from '@angular/http';
import {Observable, of} from 'rxjs';
import { map, catchError } from 'rxjs/operators';
import {User} from '../Model/User';
import { GeoLocation } from '../Model/GeoLocation';
import { Address } from '../Model/Adress';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  // apiRoot: string ="http://localhost/AldeaApp/GenericRestSymphony/public/index.php" ;
  apiRoot: string ="http://localhost/AldeaApp/GenericFrontAngular/src/fakeDB";

  constructor(private http: Http) {
  }

  signup(term):Observable<User>{
    let apiURL = `${this.apiRoot}/signup`;
    let headers: Headers = new Headers();
    headers.append('Authorization','false');
    let opts: RequestOptions = new RequestOptions();
    opts.headers = headers;
    opts.search = term;

    return this.http
    .post(apiURL,term,{headers:headers})
      .pipe(
        map(res => {
          return new User(
            res.json().name,
            res.json().surname,
            res.json().email,
            res.json().username
          )         
        })
      )
  }

  
  //you need to a post search to a server side by criteria..in this example we use a search 
  //into an array
  searchUser(term: string): Observable<User[]> {
    let apiURL = `${this.apiRoot}/user.json`;
    return this.http.get(apiURL).pipe(
      map(res => {
        let results=[];
        for(var i=0; i<res.json().length; i++) {
          for(let key in res.json()[i]) {
            if(key ==="name" || key ==="username"||key ==="email")
            if(res.json()[i][key].toLowerCase().includes(term)) {
              if(!results.find(function(element) { return element.username ===res.json()[i].username}))
                results.push(res.json()[i]);
            }
          }
        }
        return results.map(item => {
          return new User().generateUserByJson(item)
        });
      })
    );
  }

  getUsers(): Observable<User[]> {
    let apiURL = `${this.apiRoot}/user.json`;
    return this.http
    .get(apiURL)
      .pipe(
        map(res => {
          return res.json().map(item => {
            return new User().generateUserByJson(item)
          });
        }),
        catchError(
          err =>
           of( "error en el listado de usuarios" + err)
           
          ),
       )   
  }



}