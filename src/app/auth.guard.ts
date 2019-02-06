import { Injectable } from '@angular/core';
import { AuthService } from "../app/Services/auth.service";
import {Observable, of} from 'rxjs';
import { map, catchError } from 'rxjs/operators';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot,Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {
   constructor(private router : Router,private auth: AuthService ){}
 
  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<boolean>  {
      let self = this;
      return this.auth.loggedIn().pipe(
        map(e => {
          if (e) {
            self.auth.isLogIn(true);
            return true;
          } else {
            this.router.navigate(['/login']);
            return false;
          }
        }),
        catchError((err) => {
          this.router.navigate(['/login']);
          return of(false);
        })
      );
 
  }
}
