import { Component, OnInit } from '@angular/core';
import { UserService } from 'src/app/Services/user.service';
import { User } from 'src/app/Model/User';
import { FormControl } from '@angular/forms';
import { debounceTime, distinctUntilChanged, switchMap } from 'rxjs/operators';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent implements OnInit {
  searchField: FormControl;
  users : User[]= [];
  
  constructor(private userService: UserService) { }

  ngOnInit() {
    this.getAllUsers();
    this.searchField = new FormControl();
    this.searchField.valueChanges.pipe(
      debounceTime(400),
      distinctUntilChanged(),
      switchMap(term => this.userService.searchUser(term)),
    ).subscribe((users)=>{  
      this.users= users
    });
  }

  getAllUsers(){
    this.userService.getUsers().subscribe(
      (term)=> {
        this.users=term;
      },
        (err)=>{
          console.log(err)
        }
      );
  }

  goBack(){
    window.history.back()
  }

}
