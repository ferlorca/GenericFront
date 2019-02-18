import { Component, OnInit } from '@angular/core';
import { Route, ActivatedRoute, Router } from '@angular/router';
import { User } from 'src/app/Model/User';
import { UserService } from '../user-service/user.service';
import { FormControl, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-user-detail',
  templateUrl: './user-detail.component.html',
  styleUrls: ['./user-detail.component.scss']
})
export class UserDetailComponent implements OnInit {
  user: User;

  myform: FormGroup;
  name: FormControl;
  email: FormControl;
  username: FormControl;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private userService: UserService
  ) {
    this.createFormControls();
    this.createForm();
    this.route.params.subscribe(params => {
      console.log(params);
      if (params["id"]) {
        this.userService.getUser(params["id"]).subscribe(user => {
          this.user = user;
          this.updateFormControls(user);
        });
      }
    });
  }

  createForm() {
    this.myform = new FormGroup({
      name: this.name,
      email: this.email,
      username: this.username
    });
  }

  updateFormControls(user: User) {
    if (user != undefined && user != null) {
      this.name.setValue(user.name);
      this.username.setValue(user.username)
      this.email.setValue(user.email)
    }
  }

  createFormControls() {
    this.name = new FormControl('', Validators.required);
    this.username = new FormControl('', Validators.required);
    this.email = new FormControl('', [
      Validators.required,
      Validators.pattern("[^ @]*@[^ @]*")
    ]);
  }


  ngOnInit() {

  }

  goBack() {
    window.history.back()
  }

  onSubmit() {
    if (this.myform.valid) {
      if (this.user) {
        console.log("I need to go to userservice and UPDATE the user " + this.user.name + " id:" + this.user.id)
      } else {
        console.log("I need to go to userservice and CREATE the new user " + this.user.name)
      }
    }

  }

}
