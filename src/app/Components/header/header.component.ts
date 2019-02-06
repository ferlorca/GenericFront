import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from "../../Services/auth.service";


@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {
  public isUserLoggedIn: boolean = false;
  constructor( private router: Router , private auth: AuthService) { }

  ngOnInit() {
    this.auth.currentLoggin.subscribe(islogginUser => this.isUserLoggedIn = islogginUser)
  }
  
  logout(){
    localStorage.clear();
    this.auth.logout();
    this.router.navigate(['login']);
  }

}
