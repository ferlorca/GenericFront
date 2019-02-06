import { Component, OnInit } from '@angular/core';
import {URLSearchParams} from '@angular/http';
import {
  FormGroup,
  FormControl,
  Validators,
} from '@angular/forms';
import {UserService} from "../../../Services/user.service"

@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.component.html',
  styleUrls: ['./sign-up.component.scss']
})
export class SignUpComponent implements OnInit {

  myform: FormGroup;
  name: FormControl;
  surname: FormControl;
  email: FormControl;
  password: FormControl;
  username:FormControl;
  
  constructor(private userService: UserService) {    
  }

  ngOnInit() {
    this.createFormControls();
    this.createForm();
  }

  createFormControls() {
    this.name = new FormControl('', Validators.required);
    this.surname = new FormControl('', Validators.required);
    this.username = new FormControl('', Validators.required);
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
    this.myform = new FormGroup({     
      name: this.name,
      surname: this.surname,     
      email: this.email,
      password: this.password,
      username: this.username
    });
  }

  onSubmit(){
    if(this.myform.valid){

      let search = new URLSearchParams();
      search.set('name',  this.myform.value.name);
      search.set('surname',  this.myform.value.surname);
      search.set('email',    this.myform.value.email);
      search.set('username',    this.myform.value.username);
      search.set('password',  this.myform.value.password);
     
      this.userService.signup(search).subscribe(
        res => {
          console.log(res);
        },    
        error=>{
          console.error(error)
        }
      );   
      this.myform.reset();
    }
  }

  getUsers(){   
      this.userService.getUsers().subscribe(res => {
        for(let user of res){
          console.log(user);
        }
      },    
      error=>{console.error(error)
      })
    ;       
  }

}
