import { Component, OnInit } from '@angular/core';
import { UserService } from 'src/app/Components/content/users/user-service/user.service';
import { User } from 'src/app/Model/User';

@Component({
  selector: 'app-user-list',
  templateUrl: './user-list.component.html',
  styleUrls: ['./user-list.component.scss']
})
export class UserListComponent implements OnInit {
  
  public users : User[]= [];
  
  constructor(private userService: UserService) { }

  ngOnInit() {
    this.getAllUsers();
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

  updateUserList(searchTerm : string){
    this.userService.searchUser(searchTerm).subscribe(
      (users)=>{  
          this.users= users
      }
    );
  }

  goBack(){
    window.history.back()
  }

}
