import { Component, OnInit,Output, EventEmitter } from '@angular/core';
import {
  FormGroup,
  FormControl,
  Validators,
} from '@angular/forms';
import { AuthService } from "../../../Services/auth.service"
import { Router } from '@angular/router';
import { HttpErrorResponse } from '@angular/common/http';
import { User } from '../../../model/User';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  loginForm: FormGroup;
  email: FormControl;
  password: FormControl;
  isLoginError : boolean = false;
  @Output() triggerLog = new EventEmitter<boolean>();

  constructor(private auth: AuthService, private router: Router) {
    this.createFormControls();
    this.createForm();

  }

  ngOnInit() {

  }

  createFormControls() {
    this.email = new FormControl('', [
      Validators.required,
      Validators.pattern("[^ @]*@[^ @]*")
    ]);
    this.password = new FormControl('', [
      Validators.required,
      Validators.minLength(6)
    ]);
  }

  createForm() {
    this.loginForm = new FormGroup({
      email: this.email,
      password: this.password
    });
  }

  onSubmit() {
    
    if (this.loginForm.valid) {
      /*getRawValue() --> objeto json */
      this.auth.userAuthentication(this.loginForm.getRawValue())
      .subscribe((data)=>{
        localStorage.setItem('userToken',data.token);
        let user = new User(data.data.name,data.data.surname,data.data.email,data.data.username);
        localStorage.setItem("user",JSON.stringify(user));
        this.auth.isLogIn(true);
        this.router.navigate(['/home']);
      },
      (err : HttpErrorResponse)=>{
        console.error(err);
        this.isLoginError = true;
      });
      
    }
  }

}
